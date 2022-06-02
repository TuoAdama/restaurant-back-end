<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public static function send(Personnel $personnel)
    {
        $token = $personnel->notification_token;

        Http::post('https://exp.host/--/api/v2/push/send', [
            'to' => $token,
            'title' => 'TAB001',
            'body' => 'Je suis Tuo Demsi'
        ]);
    }
}
