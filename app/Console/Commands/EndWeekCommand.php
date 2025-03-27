<?php

namespace App\Console\Commands;

use Telegram\Bot\Commands\Command;

class EndWeekCommand extends Command
{
    protected string $name = 'end_week';
    protected string $description = 'Закончить рабочую неделю и подвести итоги';

    public function handle()
    {
        $chatId = $this->getUpdate()->getMessage()->getChat()->getId();

        // Логика (например, подсчет прибыли)
        $this->replyWithMessage([
            'chat_id' => $chatId,
            'text' => '📊 Неделя завершена! Прибыль: 150 000 ₽. Все свободны!',
        ]);
    }
}
