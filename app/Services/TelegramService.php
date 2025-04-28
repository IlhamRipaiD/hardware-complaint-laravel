<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\MultipartStream;

class TelegramService
{
    protected $client;
    protected $token;
    protected $chatId;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
    }

    public function sendMessage($message)
    {
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";

        try {
            $response = $this->client->post($url, [
                'form_params' => [
                    'chat_id' => $this->chatId,
                    'text' => $message,
                ]
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new \Exception("Gagal mengirim pesan ke Telegram: {$e->getMessage()}");
        }
    }

    public function sendPhoto($message, $photoPath)
    {
        $url = "https://api.telegram.org/bot{$this->token}/sendPhoto";

        try {
            $multipart = new MultipartStream([
                [
                    'name' => 'chat_id',
                    'contents' => $this->chatId,
                ],
                [
                    'name' => 'caption',
                    'contents' => $message,
                ],
                [
                    'name' => 'photo',
                    'contents' => fopen($photoPath, 'r'),
                ],
            ]);

            $response = $this->client->post($url, [
                'headers' => [
                    'Content-Type' => 'multipart/form-data; boundary=' . $multipart->getBoundary(),
                ],
                'body' => $multipart,
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new \Exception("Gagal mengirim foto ke Telegram: {$e->getMessage()}");
        }
    }
}
