<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Story;
use App\Models\Audio;

class AudioController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    
    public function generateTTS(Request $request)
{
    // Log the input request
    \Log::info('TTS Input: ' . $request->input('input'));
    $inputText = $request->input('input');
    $apiKey = env('OPENAI_API_KEY');

    try {
        $response = $this->client->request('POST', 'https://api.openai.com/v1/audio/speech', [
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'model' => 'tts-1',
                'input' => $inputText,
                'voice' => 'alloy'
            ]
        ]);

        // Generate a unique name for the audio file
        $audioName = 'audio_' . time() . '.mp3';
        $audioPath = public_path('audio/' . $audioName);
        // Log the path where audio will be saved
        \Log::info('Saving audio to path: ' . $audioPath);
        // Save the audio data to a file
        file_put_contents($audioPath, $response->getBody());

        // Save the audio path to the database
        $story = Story::create(['content' => $inputText]);
        $story->audios()->create(['file_path' => $audioName]);

        return response()->json(['audioUrl' => asset('audio/' . $audioName)]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
// public function generateTTS(Request $request)
    // {
    //     $inputText = $request->input('input');
    //     $apiKey = env('OPENAI_API_KEY');

    //     try {
    //         $response = $this->client->request('POST', 'https://api.openai.com/v1/audio/speech', [
    //             'headers' => [
    //                 'Authorization' => "Bearer $apiKey",
    //                 'Content-Type' => 'application/json'
    //             ],
    //             'json' => [
    //                 'model' => 'tts-1',
    //                 'input' => $inputText,
    //                 'voice' => 'alloy'
    //             ]
    //         ]);

            
    //         $audioUrl = json_decode($response->getBody(), true)['audio']; // The URL from OpenAI

    //         // Save the audio path to the database
    //         $story = Story::create(['content' => $inputText]);
    //         $story->audios()->create(['url' => $audioUrl]);

    //         // Download and save the audio
    //         $audioName = 'audio_' . time() . '.mp3'; // Generate a unique name for the audio
    //         $audioPath = public_path('audio/' . $audioName);
    //         file_put_contents($audioPath, file_get_contents($audioUrl)); // Save the audio

    //         return response()->json(['audioUrl' => asset('audio/' . $audioName)]);

    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }