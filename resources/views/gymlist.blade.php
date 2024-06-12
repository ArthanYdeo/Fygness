<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Listing</title>
    <!-- Link to CSS stylesheet -->
    <link rel="stylesheet" href="list.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .gym-map {
            margin-left: 50px; /* Add margin to the top of the gym map */
        }
        .gym-logo img {
            width: 100px; /* Set a fixed width */
            height: 100px; /* Set a fixed height */
            object-fit: cover; /* Maintain aspect ratio and cover the container */
        }
        .white-text {
            color: white;
        }

        .no-decoration {
            text-decoration: none;
            color: inherit; /* Inherit color from parent */
        }

        .no-decoration:hover {
            text-decoration: none; /* Remove underline when hovering */
        }
    </style>
</head>
<body>

    <!-- Navigation and Header -->
    <header>
        <nav>
        <a href="{{ route('getstarted') }}" class="no-decoration"><h2 class="white-text">FYGNESS</h2></a>

        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Search form -->
        <form action="{{ route('findgym') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Search gyms...">
            <button type="submit">Search</button>
        </form>

        <!-- Gym Listings -->
        <section class="gym-listings">
            @if($gyms->isEmpty())
                <p>No gyms found.</p>
            @else
                @foreach ($gyms as $gym)
                    <div class="gym-card">
                        <div class="gym-logo">
                            <img src="uploads/{{ $gym->logo }}" alt="Gym Logo">
                        </div>
                        <div class="gym-details">
                            <h4>{{ $gym->name }}</h4>
                            <p><strong>Owner:</strong> {{ $gym->owner }}</p>
                            <p><strong>Address:</strong> {{ $gym->address }}</p>
                            <p><strong>Inclusions:</strong> {{$gym -> inclusion}}</p>
                            <p><strong><i>₱ 300 / Month</p></i></strong>

                            <button class="btn btn-primary" onclick="window.open('https://www.google.com/maps/search/?api=1&query={{ urlencode($gym->address) }}', '_blank')">View on Google Maps</button>
                        </div>
                       
                        <!-- Google Maps iframe -->
                        <div class="gym-map">
                            <iframe 
                                src="https://www.google.com/maps?q={{ urlencode($gym->address) }}&output=embed"
                                width="600" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </main>

    <!-- JavaScript code for image resizing -->
    <script>
        function resizeImage(file, maxWidth, maxHeight, callback) {
            var img = document.createElement("img");
            var canvas = document.createElement("canvas");
            var ctx = canvas.getContext("2d");

            img.onload = function() {
                var width = img.width;
                var height = img.height;

                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }

                canvas.width = width;
                canvas.height = height;
                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob(function(blob) {
                    callback(blob);
                }, file.type);
            };

            img.src = URL.createObjectURL(file);
        }

        // Example usage
        var fileInput = document.getElementById('logo-input');
        fileInput.addEventListener('change', function(event) {
            var file = event.target.files[0];
            resizeImage(file, 100, 100, function(resizedBlob) {
                // Upload the resized image (resizedBlob)
            });
        });
    </script>

</body>
</html>
