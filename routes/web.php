<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AudioController;

Route::get('/', function () {
    return view('story');
});

Route::post('/story', [StoryController::class, 'getStory']);
Route::post('/image', [ImageController::class, 'generateImage']);
Route::post('/tts', [AudioController::class, 'generateTTS']);
