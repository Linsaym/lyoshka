<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Services\Telegram\TelegramBotService;

// Если используется сервисный слой

class TelegramBotController extends Controller
{
    /**
     * Обработка входящего вебхука от Telegram.
     */
    public function handleWebhook(Request $request)
    {
        // Верификация секретного токена (если настроен)
        if (env('TELEGRAM_WEBHOOK_SECRET') &&
            $request->header('X-Telegram-Bot-Api-Secret-Token') !== env('TELEGRAM_WEBHOOK_SECRET')) {
            abort(403, 'Invalid token');
        }

        // Логирование входящего запроса
        \Log::channel('telegram')->debug('Webhook received:', $request->all());

        // Основная обработка
        try {
            $update = Telegram::commandsHandler(true);

            // Дополнительная логика (например, сохранение в БД)
            // $this->processUpdate($update);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            \Log::channel('telegram')->error('Webhook error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    /**
     * Пример метода для обработки обновлений.
     */
    protected function processUpdate($update)
    {
        // Ваша логика (разбор сообщений, кнопок и т.д.)
    }

    /**
     * Дополнительные методы (например, для ручной отправки сообщений).
     */
    public function sendMessage($chatId, $text)
    {
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }
}
