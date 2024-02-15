<?php

// app/Http/Controllers/EmailController.php
namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function sendEmail(Request $request): JsonResponse
    {
        try {
            $requesterDomain = $request->input('domain');
            $requesterId = $request->input('id');

            $smtpConfig = [
                'driver' => 'smtp',
                'host' => $request->input('smtp_host', 'your-smtp-host'),
                'port' => $request->input('smtp_port', 587),
                'from' => [
                    'address' => $request->input('smtp_from_address', 'your-email@example.com'),
                    'name' => $request->input('smtp_from_name', 'Your Name'),
                ],
                'encryption' => $request->input('smtp_encryption', 'tls'),
                'username' => $request->input('smtp_username', 'your-smtp-username'),
                'password' => $request->input('smtp_password', 'your-smtp-password'),
            ];

            // Gather all inputs in an array
            $notificationInfo = compact($requesterDomain, $requesterId);

            // Call gatherEmailInfo method from another controller
            app(GatherEmailInfoController::class)->gatherEmailInfo($notificationInfo);

            // Send email using EmailService
            $this->emailService->sendEmail($sender, $receiver, $subject, $body, $bodyType, $attachment, $smtpConfig);

            return response()->json(['message' => 'Email sent']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
