<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Story;
use App\Models\Image;

class ImageController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function generateImage(Request $request)
    {
        $prompt = $request->input('prompt');
        $apiKey = env('OPENAI_API_KEY');

        try {
            $response = $this->client->request('POST', 'https://api.openai.com/v1/images/generations', [
                'headers' => [
                    'Authorization' => "Bearer $apiKey",
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'model' => 'dall-e-3',
                    'prompt' => $prompt,
                    'n' => 1,
                    'size' => '1024x1024'
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            // Save image URL to database
            $story = Story::create(['content' => $prompt]);
            $imageUrl = $body['data'][0]['url']; // The URL from OpenAI

            // Download and save the image
            $imageName = 'image_' . time() . '.png'; // Generate a unique name for the image
            $imagePath = public_path('images/' . $imageName);
            file_put_contents($imagePath, file_get_contents($imageUrl)); // Save the image
    
            // Save the image path to the database
            $story = Story::create(['content' => $prompt]);
            $story->images()->create(['url' => $imageName]);
    
            return response()->json(['imageUrl' => asset('images/' . $imageName)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
