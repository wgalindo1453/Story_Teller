// $(document).ready(function() {
//     $('#submit-prompt').on('click', function() {
//         var prompt = $('#prompt-input').val();

//         // AJAX call for story continuation
//         $.ajax({
//             url: '/story',
//             type: 'POST',
//             data: { prompt: prompt },
//             success: function(response) {
//                 // Update your story display
//                 $('#story-display').html(response.story);
//                 // Further actions can be added here
//             }
//         });
//         // Image AJAX
//         $.ajax({
//             url: '/image',
//             type: 'POST',
//             data: { prompt: prompt },
//             success: function(response) {
//                 // Update your image display
//                 // Example: Assuming response contains image URLs
//                 $('#image-display').html('<img src="' + response.imageUrl + '" alt="Generated Image">');
//             }
//         });


//             // TTS AJAX
//         $.ajax({
//             url: '/tts',
//             type: 'POST',
//             data: { prompt: prompt },
//             success: function(response) {
//                 // Update your audio player
//                 // Example: Assuming response contains audio file path
//                 $('#audio-player').attr('src', response.audioFilePath);
//             }
//         });

//     });
// });
// $(document).ready(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });


//     $('#submit-prompt').on('click', function() {
//         var prompt = $('#prompt-input').val();

//         if (!prompt) {
//             alert("Please enter a prompt.");
//             return;
//         }

//         // AJAX call for story continuation
//         $.ajax({
//             url: '/story',
//             type: 'POST',
//             data: { content: prompt },
//             success: function(response) {
//                 var story = response.story;
//                 $('#story-display').html(story);

//                 // Once the story is received, use it to generate an image
//                 generateImage(story);
//             },
//             error: function() {
//                 alert("Error in getting story.");
//             }
//         });
//     });

//     function generateImage(story) {
//         $.ajax({
//             url: '/image',
//             type: 'POST',
//             data: { prompt: story },
//             success: function(response) {
//                 var imageUrl = response.imageUrl;
//                 $('#image-display').html('<img src="' + imageUrl + '" alt="Generated Image">');

//                 // Once the image is received, use the story to generate audio
//                 generateTTS(story);
//             },
//             error: function() {
//                 alert("Error in generating image.");
//             }
//         });
//     }

//     function generateTTS(story) {
//         $.ajax({
//             url: '/tts',
//             type: 'POST',
//             data: { input: story },
//             success: function(response) {
//                 var audioFilePath = response.audioUrl; // Updated to match the key in the JSON response
//                 $('#audio-player').attr('src', audioFilePath);
//             },
//             error: function() {
//                 alert("Error in generating audio.");
//             }
//         });
//     }
// });

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submit-prompt').on('click', function() {
        var prompt = $('#prompt-input').val();

        if (!prompt) {
            alert("Please enter a prompt.");
            return;
        }

        // AJAX call for story continuation
        $.ajax({
            url: '/story',
            type: 'POST',
            data: { content: prompt },
            success: function(response) {
                var story = response.story;
                // Update the text of the card
                $('#story-display .card-text').text(story);

                // Once the story is received, use it to generate an image
                generateImage(story);
            },
            error: function() {
                alert("Error in getting story.");
            }
        });
    });

    function generateImage(story) {
        $.ajax({
            url: '/image',
            type: 'POST',
            data: { prompt: story },
            success: function(response) {
                var imageUrl = response.imageUrl;
                // Update the src of the image in the card
                $('#image-display img').attr('src', imageUrl);

                // Once the image is received, use the story to generate audio
                generateTTS(story);
            },
            error: function() {
                alert("Error in generating image.");
            }
        });
    }

    function generateTTS(story) {
        $.ajax({
            url: '/tts',
            type: 'POST',
            data: { input: story },
            success: function(response) {
                var audioFilePath = response.audioUrl; // Updated to match the key in the JSON response
                $('#audio-player').attr('src', audioFilePath);
            },
            error: function() {
                alert("Error in generating audio.");
            }
        });
    }
});
