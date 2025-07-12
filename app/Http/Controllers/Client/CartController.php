<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();
        $cart = Cart::getOrCreateCart($userId, $sessionId);

        $cartItems = CartItem::with('product', 'product.category', 'product.brand')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($item) {
                $item->low_stock = $item->product->stock < 5;
                return $item;
            });

        // Tính tổng tiền
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item->price * $item->quantity;
        }

        return view('client.cart.index', compact('cartItems', 'cartTotal'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1'
        ]);

        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
        }

        $product = Product::where('product_id', $request->product_id)->firstOrFail();
        $userId = Auth::id();
        $sessionId = session()->getId();

        $cart = Cart::getOrCreateCart($userId, $sessionId);

        $item = $cart->items()
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->update([
                'quantity' => $item->quantity + $request->quantity
            ]);
        } else {
            $quantity = (int) $request->input('quantity', 1);
            if ($quantity < 1) $quantity = 1;
            
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $quantity,
                'price' => $product->discount_price ?? $product->price,
                'added_at' => now(),
                'user_id' => $userId,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
                'cart_count' => $cart->fresh()->item_count
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để cập nhật giỏ hàng!'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật giỏ hàng!');
        }

        $cartItem = CartItem::findOrFail($id);
        
        // Kiểm tra số lượng tồn kho
        $product = $cartItem->product;
        $newQuantity = (int) $request->quantity;
        
        if ($newQuantity > $product->stock) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá số lượng tồn kho có sẵn. Chỉ còn ' . $product->stock . ' sản phẩm!'
                ], 400);
            }
            return redirect()->back()->with('error', 'Số lượng vượt quá số lượng tồn kho có sẵn. Chỉ còn ' . $product->stock . ' sản phẩm!');
        }

        if ($newQuantity < 1) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng phải lớn hơn 0!'
                ], 400);
            }
            return redirect()->back()->with('error', 'Số lượng phải lớn hơn 0!');
        }

        // Kiểm tra xem cart item có thuộc về người dùng hiện tại không
        if ($cartItem->user_id !== Auth::id()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không được phép cập nhật sản phẩm này!'
                ], 403);
            }
            return redirect()->back()->with('error', 'Không được phép cập nhật sản phẩm này!');
        }

        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật giỏ hàng!'
            ]);
        }

        return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xóa sản phẩm khỏi giỏ hàng!');
        }

        // Tìm cart item cần xóa
        $cartItem = CartItem::findOrFail($id);
        
        // Kiểm tra xem cart item có thuộc về người dùng hiện tại không
        if ($cartItem->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Không được phép xóa sản phẩm này!');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xóa giỏ hàng!');
        }

        $userId = Auth::id();
        $sessionId = session()->getId();

        // Xóa giỏ hàng hiện tại
        Cart::where('user_id', $userId)
            ->where('session_id', $sessionId)
            ->where('status', 'pending')
            ->delete();

        // Tạo lại giỏ hàng mới
        Cart::getOrCreateCart($userId, $sessionId);

        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

    public function count()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('id', $userId)->first();
            $count = $cart ? $cart->items->count() : 0;
        } else {
            $cart = session('cart', []);
            $count = count($cart);
        }

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $cart = Cart::where('id', Auth::id())->first();
        $count = $cart ? $cart->items->sum('quantity') : 0;

        return response()->json(['count' => $count]);
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('id', $userId)->first();
            return $cart ? $cart->items->count() : 0;
        }

        $cart = session('cart', []);
        return count($cart);
    }
}