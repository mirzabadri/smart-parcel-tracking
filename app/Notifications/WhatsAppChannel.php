<?php

namespace App\Notifications\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        $client = new Client();

        $response = $client->post('https://api.example.com/whatsapp', [
            'headers' => [
                'Authorization' => 'Bearer YOUR_API_KEY',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'phone' => $message['phone'],
                'message' => $message['message'],
            ],
        ]);

        // Handle the response as needed
    }
}
