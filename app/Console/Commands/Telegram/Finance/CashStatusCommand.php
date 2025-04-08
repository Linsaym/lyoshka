<?php

namespace App\Console\Commands\Telegram\Finance;

use Telegram\Bot\Commands\Command;

class CashStatusCommand extends Command
{
    protected string $name = 'cash_status';
    protected string $description = 'Проверить текущее состояние кассы';

    public function handle(): void
    {
        $chatId = $this->getUpdate()->getMessage()->getChat()->getId();

        // Логика (например, запрос в БД)
        $this->replyWithMessage([
            'chat_id' => $chatId,
            'text' => '💰 Текущий баланс кассы: 42 500 ₽',
        ]);
    }
}
