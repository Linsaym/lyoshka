<?php

namespace App\Console\Commands\Telegram\Core;

use Telegram\Bot\Commands\Command;

class StartWeekCommand extends Command
{
    protected string $name = 'start_week';
    protected string $description = 'Начать новую рабочую неделю';

    public function handle(): void
    {
        $chatId = $this->getUpdate()->getMessage()->getChat()->getId();

        // Здесь можно добавить логику (например, запись в БД)
        $this->replyWithMessage([
            'chat_id' => $chatId,
            'text' => '✅ Неделя начата! Касса обнулена. Всем работать!',
        ]);
    }
}
