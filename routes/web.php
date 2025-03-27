<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/send-message', function () {
    $chatId = 743206490; // Replace with your chat ID
    $message = 'Кассе пизда, всему пизда, мы увольняемся';

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    return 'Message sent to Telegram!';
});

Route::get('/get-updates', function () {
    $updates = Telegram::getUpdates();
    return $updates;
});

//Для прода
Route::get('/set-webhook', function () {
    Telegram::setWebhook([]);
    //curl "https://api.telegram.org/bot<YOUR_BOT_TOKEN>/setWebhook?url=<YOUR_DOMAIN>/webhook"
});


//Для локальной разработки
Route::get('/poll-updates', function () {
    $updates = Telegram::getUpdates();
    foreach ($updates as $update) {
        // Обработка каждого обновления
        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();
        if ($text === '/cash_status')
        {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Выберите действие:',
                'reply_markup' => json_encode([
                    'keyboard' => [
                        [['text' => 'Кнопка 1'], ['text' => 'Кнопка 2']],
                        [['text' => 'Закрыть']]
                    ],
                    'resize_keyboard' => true
                ])
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Получил ваше сообщение: ' . $update->getMessage()->getText()
            ]);
        }
    }
    return 'Updates processed';
});


require __DIR__.'/auth.php';
