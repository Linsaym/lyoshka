<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetWebhookCommand extends Command
{
    protected $signature = 'telegram:set-webhook
                            {url? : URL вебхука (если не указан, берётся из .env)}
                            {--c|certificate= : Путь к SSL-сертификату (опционально)}';

    protected $description = 'Установить или обновить вебхук для Telegram Bot API';

    public function handle()
    {
        //Не забудьте обновить кеширование env файла
        $url = $this->argument('url') ?? config('telegram.bots.lyoshka.webhook_url');

        if (empty($url)) {
            $this->error('URL вебхука не указан! Добавьте в .env TELEGRAM_WEBHOOK_URL или передайте аргументом.');
            return;
        }

        $params = ['url' => $url];

        // Если указан сертификат
        if ($certificate = $this->option('certificate')) {
            if (!file_exists($certificate)) {
                $this->error("Файл сертификата не найден: {$certificate}");
                return;
            }
            $params['certificate'] = $certificate;
            $this->info("Используется сертификат: {$certificate}");
        }

        // Устанавливаем вебхук
        try {
            $response = Telegram::setWebhook($params);
            $this->info("Вебхук установлен: {$url}");
            $this->line("Ответ API: " . json_encode($response));
        } catch (\Exception $e) {
            $this->error("Ошибка: " . $e->getMessage());
        }
    }
}
