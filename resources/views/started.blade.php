<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fygness</title>
  <link rel="stylesheet" href="getstarted.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
</head>
<body>
<div id="page">	
<header id="fh5co-header" class="cover js-fullheight" role="banner"  style="background-image:url(images/bg.jpg);" data-stellar-background-ratio="0.5">
<div class="overlay"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent flex-column">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('findgym') }}">FIND GYM</a>
      </li>
      </ul>
    </div>
    <a href="{{ route('login') }}" class="btnlogin" style="text-align: center;">LOG IN</a> 
  </div>
</nav>

<div class="container">
    <section id="gyms" class="container">
        <div class="row">
            @foreach($gyms as $gym)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="gym-card">
                        <img src="{{ asset('uploads/' . $gym->logo) }}" alt="{{ $gym->name }} Logo">
                        <h3>{{ $gym->name }}</h3>
                        <p><strong>Inclusion:</strong> {{ $gym->inclusion }}</p>
                        <p><strong>Owner:</strong> {{ $gym->owner }}</p>
                        <p><strong>Location:</strong> {{ $gym->address }}</p>
                        <p><strong>Subscribed Members:</strong> {{ $gym->subscribed_members }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>


</header>

<!-- About -->
<section class="about" id="about">
<div class="main-container">
<div class="n"></div>
      <div class="rectangle">
        <div class="gym-amico"></div>
        <span class="about-us">ABOUT US</span>
        <span class="lorem-ipsum-dolor">
         
"Fygness Go: Find Your Gym and Fitness Goal! Navigate effortlessly to your ideal gym and work on your fitness objectives with precision. Let Fygness Go be the way to find     your ultimate fitness destination!"

        </span>
</section>





  <!-- Go to top button -->
	<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
	</div>


<footer class="footer">
  <div class="container">
  <span class="text-muted">&copy; FYGNESS GO </span>
  </div>
</footer>

   <!-- JS -->
	<script src="js/jquery.min.js"></script>
  <script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
  <script src="js/main.js"></script>

</body>
</html>

