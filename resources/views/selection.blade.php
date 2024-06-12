<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Selection</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Select Gym</h1>
        <div class="profiles">
            <!-- Display Added Gyms -->
            @foreach($gyms as $gym)
                <div class="profile">
                    <div class="gym">
                    <a href="{{ route('login') }}">
                        <img src="uploads/{{ $gym->logo }}" alt="Gym Logo">
                        <span>{{ $gym->name }}</span>
                        </a>

                    </div>
                </div>
            @endforeach

            <!-- Add Gym Button (conditionally rendered) -->
            @if(count($gyms) < 2)
                <div class="profile">
                    <div class="add-gym">
                        <a href="{{ route('gymcreate') }}">
                            <img src="images/round-add-button.png" alt="Add Gym" class="gray-img">
                            <span>Add Gym</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
