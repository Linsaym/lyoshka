<?php

namespace App\Http\Services;

use Telegram\Bot\Api;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramSDKException;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;

class TelegramBotService
{
    protected Api $telegram;

    /**
     * @throws TelegramSDKException
     */
    public function __construct()
    {
        $this->telegram = new Api(config('telegram.bots.lyoshka.token'));
        $this->registerCommands(); // Регистрация команд бота
    }

    /**
     * Основной метод обработки вебхука
     */

    protected function registerCommands(): void
    {
        $commandClasses = glob(app_path('Console/Commands/Telegram/*.php'));

        $commands = [];
        foreach ($commandClasses as $file) {
            $className = 'App\\Console\\Commands\\Telegram\\' . basename($file, '.php');
            if (class_exists($className) && is_subclass_of($className, Command::class)) {
                $commands[] = $className;
            }
        }

        $this->telegram->addCommands($commands);
    }

    public function handleWebhookUpdate(array $updateData): void
    {
        $update = new Update($updateData);

        Log::channel('telegram')->debug('Update:', $update->toArray());

        // Если это команда - обрабатываем через commandsHandler
        if ($this->isCommand($update)) {
            $this->telegram->commandsHandler(true);
            return;
        }

        // Обработка обычных сообщений
        $this->processMessage($update);
    }

    /**
     * Обработка текстовых сообщений
     */
    protected function processMessage(Update $update): void
    {
        $message = $update->getMessage();
        $chatId = $message->chat->id;
        $text = $message->text;

        // Пример обработки
        $responseText = "Вы написали: " . $text;

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $responseText
        ]);
    }

    /**
     * Обработка команд
     */
    protected function processCommand(Update $update): void
    {
        $this->telegram->commandsHandler(true, $update);
    }

    /**
     * Проверка, является ли сообщение командой
     */
    protected function isCommand(Update $update): bool
    {
        // Получаем текст сообщения с защитой от null
        $messageText = $update->getMessage()?->text;

        // Проверяем, что текст есть и начинается с '/'
        return $messageText !== null && str_starts_with($messageText, '/');
    }
}
