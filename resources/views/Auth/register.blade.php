<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fygness</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="main-container">
    <div class="gym-amico"></div>
    <div class="rectangle-register">
      <span class="register-your-account">Create an account to get started!</span>

      <!-- added function form for register -->
      <form id="registration-form" method="POST" action="{{ route('register') }}">
        @csrf 

        <!-- Display validation errors -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <span class="email-address1">Full Name</span>
        <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" value="{{ old('full_name') }}" required>

        <span class="email-address1">Phone Number</span>
        <input type="text" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="{{ old('phone_number') }}" required>

        <span class="email-address1">Email Address</span>
        <input type="text" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>

        <span class="password1">Password</span>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <span class="password1">Confirm Password</span>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>

        <button type="submit" class="register-btn"><span class="login-4">Register</span></button>
      </form>

      <div class="sign-up1">
        <span class="dont-have-account1">Have an account?</span>
        <a href="{{ route('login') }}" class="sign-up-5"> Log In</a>
      </div>
    </div>

    <div class="elevate-your-fitness">
      <span class="elevate-your">Elevate Your </span><span class="fitness">Fitness</span><span class="reach-new-heights">: Reach New Heights Every Day.</span>
    </div>
  </div>
</body>
</html>
