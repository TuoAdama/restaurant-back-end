<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public static function send(Personnel $personnel, $table)
    {
        $token = $personnel->notification_token;

        Http::post('https://exp.host/--/api/v2/push/send', [
            'to' => $token,
            'title' => $table,
            'body' => "$table est PRET"
        ]);
    }
}
