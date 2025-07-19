<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $message = $request->input('message');

        // Xử lý logic phản hồi tại đây (AI đơn giản hoặc theo keyword)
        $reply = $this->getBotReply($message);

        return response()->json([
            'reply' => $reply,
        ]);
    }

    private function getBotReply(string $message): string
{
    // Đường dẫn tuyệt đối đến file faq.json
    $faqFile = base_path('storage/app/public/faq.json');

    if (!file_exists($faqFile)) {
        return 'Xin lỗi, hiện không thể truy cập dữ liệu FAQ.';
    }

    $json = file_get_contents($faqFile);
    $faqList = json_decode($json, true);

    if (!$faqList) {
        return 'Dữ liệu FAQ không hợp lệ.';
    }

    $message = strtolower(trim($message));
    $bestScore = 0;
    $bestAnswer = 'Cảm ơn bạn đã nhắn tin! Shop sẽ phản hồi sớm nhất có thể.';

    foreach ($faqList as $faq) {
        $faqQuestion = strtolower(trim($faq['question']));
        similar_text($message, $faqQuestion, $percent);

        if ($percent > $bestScore) {
            $bestScore = $percent;
            $bestAnswer = $faq['answer'];
        }
    }

    if ($bestScore < 40) {
        return 'Cảm ơn bạn đã nhắn tin! Shop sẽ phản hồi sớm nhất có thể.';
    }

    return $bestAnswer;
}

}
