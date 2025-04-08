<?php

namespace App\Http\Controllers;

use App\Http\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    protected TelegramBotService $botService;

    public function __construct(TelegramBotService $botService)
    {
        $this->botService = $botService;
    }

    /**
     * Обработка входящего вебхука
     */
    public function handleWebhook(Request $request)
    {
        try {
            $this->botService->handleWebhookUpdate($request->all());
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::channel('telegram')->error('Webhook error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
