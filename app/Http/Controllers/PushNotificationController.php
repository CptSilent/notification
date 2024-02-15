<?php

namespace App\Http\Controllers;

use App\Services\PushNotificationService;

class PushNotificationController extends Controller
{
    protected $pushNotificationService;

    public function __construct(PushNotificationService $pushNotificationService)
    {
        $this->pushNotificationService = $pushNotificationService;
    }

    public function sendPushNotification()
    {
        // Logic to send push notification
        $this->pushNotificationService->sendPushNotification();

        return response()->json(['message' => 'Push notification sent']);
    }
}
