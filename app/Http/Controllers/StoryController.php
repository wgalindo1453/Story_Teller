<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Story;

class StoryController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getStory(Request $request)
    {
        $userInput = $request->input('content');
        $apiKey = env('OPENAI_API_KEY');

        try {
            $response = $this->client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => "Bearer $apiKey",
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'model' => 'gpt-4-1106-preview',
                    'messages' => [
                        ['role' => 'user', 'content' => $userInput]
                    ],
                    'temperature' => 1,
                    'max_tokens' => 256,
                    'top_p' => 1,
                    'frequency_penalty' => 0,
                    'presence_penalty' => 0
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            // Save story content to database
            $story = Story::create(['content' => $userInput]);

            return response()->json(['story' => $body['choices'][0]['message']['content']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
