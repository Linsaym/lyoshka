<?php

use App\Http\Controllers\TelegramBotController;
use Illuminate\Support\Facades\Route;

Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook'])
    ->name('telegram.webhook');

Route::get('/telegram/webhook', fn() => 'Вот ваш вебхук!');
