<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatherEmailInfo extends Controller
{
    public function index()
    {
        // 
    }

    public function store(Request $request)
    {
        try {
            $sender = $request->input('sender');
            $receiver = $request->input('receiver');
            $subject = $request->input('subject');
            $body = $request->input('body');
            $bodyType = $request->input('body_type', 'html');
            $attachment = $request->file('attachment');

            // Create an associative array with variable names as keys and values
            $data = compact('sender', 'receiver', 'subject', 'body', 'bodyType', 'attachment');

            foreach ($data as $key => $value) {
                // Adjust the JSON payload based on your requirements
                $jsonPayload = $this->generateJsonPayload($key, $value);

                // Send a POST request using Laravel's HTTP client
                $response = Http::post('http://ipordomain/erp-services/RestWS/runJson', $jsonPayload);

                // Process the JSON response
                $responseData = $response->json();
            }

            // Storing the data in database

            return response()->json(['message' => 'Email information stored']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function generateJsonPayload($key, $value)
    {
        // Adjust the JSON payload based on your requirements
        switch ($key) {
            case 'sender':
                return [
                    'request' => [
                        // sender json
                    ]
                ];
            case 'receiver':
                return [
                    'request' => [
                        // receiver json
                    ]
                ];
            case 'subject':
                return [
                    'request' => [
                        // subject json
                    ]
                ];
            case 'body':
                return [
                    'request' => [
                        // body json
                    ]
                ];
            case 'bodyType':
                return [
                    'request' => [
                        // bodytype json
                    ]
                ];
            case 'attachment':
                return [
                    'request' => [
                        // attachment json
                    ]
                ];

            default:
                return [
                    'request' => [
                        // default json
                    ]
                ];
        }
    }
}
