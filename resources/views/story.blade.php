<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Teller</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { padding-top: 20px; }
        .card { margin-bottom: 20px; }
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
        .card.shadow {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="container">
    <div class="row">
        <div class="col-lg-12">
            <textarea id="prompt-input" class="form-control mb-3"></textarea>
            <button id="submit-prompt" class="btn btn-primary mb-3">Submit</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <!-- Story Card with Shadow -->
            <div id="story-display" class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Story:</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Image Card with Shadow -->
            <div id="image-display" class="card shadow">
                <img src="" class="card-img-top img-fluid" alt="Generated Image"> <!-- img-fluid class added here -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <audio id="audio-player" controls class="w-100 mt-3"></audio>
        </div>
    </div>
    <script src="{{ asset('js/story.js') }}"></script>
    <!-- Include jQuery and add AJAX logic here -->
</body>
</html>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Story Teller</title>
    <!-- Head content 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div>
        <textarea id="prompt-input"></textarea>
        <button id="submit-prompt">Submit</button>
    </div>
    <div id="story-display"></div>
    <div id="image-display"></div>
    <audio id="audio-player" controls></audio>
    <script src="{{ asset('js/story.js') }}"></script>
    <!-- Include jQuery and add AJAX logic here 
</body>
</html> -->