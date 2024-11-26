
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

<title>Laravel</title>

<!-- Script -->

<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>

window.onscroll = function() {

scrollFunction();

}

function scrollFunction() {

if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {

document.getElementById("myBtn").style.display = "block";

}

else {

document.getElementById("myBtn").style.display = "none";
}
}


function topButton() {

document.body.scrollTop = 0; // SAFARI BROWSERS

document.documentElement.scrollTop = 0; // CHROME, IE AND FIREFOX

}

</script>

</head>

<!-- Navigation -->

<nav class="navbar navbar-expand-lg bg-light">

<div class="container-fluid">

<a class="navbar-brand" href="{{route('welcome')}}"><img src="{{asset('images/g4.png')}}" class="logo-image"></a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<form class="d-flex mt-2" role="search" method="get" action="#">

<input class="form-control me-2" name="search" type="search" placeholder="Type keyword" aria-label="Search">

<button class="btn btn-more no-rad" type="submit">Search</button>

</form>

<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

<li class="nav-item ms-3">

<a class="nav-link" aria-current="page" href="{{route('welcome')}}/login">Login</a>

</li>

<li class="nav-item ms-3">

<a class="nav-link" href="{{route('welcome')}}/register">Become a Seller</a>

</li>

<li class="nav-item ms-3">

<a class="nav-link" href="#">FAQs</a>

</li>

</ul>


</div>
</div>
</nav>
