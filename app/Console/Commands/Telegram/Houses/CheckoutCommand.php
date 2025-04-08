<?php

namespace App\Console\Commands\Telegram\Houses;

use Telegram\Bot\Commands\Command;

class CheckoutCommand extends Command
{
    protected string $name = 'check_in';
    protected string $description = 'Заселение дома';

    public function handle(): void
    {
        $chatId = $this->getUpdate()->getMessage()->getChat()->getId();

        // Здесь можно добавить логику (например, запись в БД)
        $this->replyWithMessage([
            'chat_id' => $chatId,
            'text' => 'Дом заселён ебать!',
        ]);
    }
}
