<?php

namespace App\Http\Controllers;

use App\Services\SmsNotificationService;

class SmsNotificationController extends Controller
{
    protected $smsNotificationService;

    public function __construct(SmsNotificationService $smsNotificationService)
    {
        $this->smsNotificationService = $smsNotificationService;
    }

    public function sendSmsNotification()
    {
        // Logic to send sms notification
        $this->smsNotificationService->sendSmsNotification();

        return response()->json(['message' => 'Sms notification sent']);
    }
}
