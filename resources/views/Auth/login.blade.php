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
    <div class="rectangle">
      <span class="login-your-account">Login your account</span>

      <!-- added function form for login -->
      <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf 

        <span class="email-address">Email Address</span>
        <input type="text" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>

        <span class="password">Password</span>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

        <div class="flex-row">
          <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}/>
          <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="login-btn"><span class="login-4">Login</span></button>
      </form>

      <div class="sign-up">
        <span class="dont-have-account">Don't have an account?</span>
        <a href="{{ route('register') }}" class="sign-up-5"> Sign Up</a>
        <br>
        <br>
        <a href="{{ route('password.request') }}">Forgot Password?</a>
      </div>


      <!-- <div class="login-qr-code">
        <span class="login-6">Login </span><span class="qr-code">QR CODE</span>
      </div> -->
    </div>

    <div class="elevate-your-fitness">
      <span class="elevate-your">Elevate Your </span><span class="fitness">Fitness</span><span class="reach-new-heights">: Reach New Heights Every Day.</span>
    </div>
  </div>
</body>
</html>
