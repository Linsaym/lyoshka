# Телеграм-бот для **Серёжи**

*(Возможно в будущем перерастёт в полноценное приложение для Ladoga Home)*

## 🚀 Быстрый старт

1. Клонировать репозиторий:

```bash
   git clone <repo-url>
   cd <project-folder>
```

2. Установить зависимости:

```bash
    composer install
```

3. Скопировать .env и сгенерировать ключ:

```bash
    cp .env.example .env
    php artisan key:generate
```

4. Настроить .env (БД, Telegram и прочее)

```dotenv
# БД
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Telegram
TELEGRAM_BOT_TOKEN=your_bot_token
TELEGRAM_WEBHOOK_URL=https://your-domain.com/webhook
```

5. Примините миграции

```bash
    php artisan migrate
```

6. Установить вебхук для Telegram:

```bash
    php artisan telegram:set-webhook
```

P.s для локальной разработки можете использовать tuna.aw или ngrock

```bash
    php artisan serve --port=8000
    tuna http 8000  # Получите URL
    php artisan telegram:set-webhook "https://ваш-туннель.ru.tuna.am/webhook"
```
