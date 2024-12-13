<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $url = '';

    public function __construct()
    {
        $this->prepareBaseUrl();
    }

    private function prepareBaseUrl(): void
    {
        $token = config('services.telegram.token');
        $this->url = "https://api.telegram.org/bot$token/";
    }

    public function sendMessage(
        string $text,
        int $chatId,
        ?array $replyMarkup = null,
        string $parseMode = 'html',
    ): void {
        $data = [
            'text' => $text,
            'parse_mode' => $parseMode,
            'chat_id' => $chatId,
        ];

        if ($replyMarkup) {
            $query['reply_markup'] = $replyMarkup;
        }

        $res = Http::post("{$this->url}/sendMessage", $data);
    }
}
