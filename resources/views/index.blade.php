
@include('layouts.header')

<!-- Find domains -->

<body>

<div class="to-green">

<div class="container">

<div class="to-green-content mx-auto">

<h3 class="mt-3 mb-3 text-center">Find the right domain suited for your brand</h3>

<h6 class="mt-3 mb-3">Put Nigeria's largest domain marketplace to work for you! Explore our collection of quality domain names.</h6>

<div class="t-space wdth-50 mx-auto">

    <form method="get" action="{{ route('domain.search') }}">

<div class="input-group mb-30">

  <input type="text" class="form-control all-shadow-lg userIn pd-sbox b-rad" name="search" placeholder="Search our collections of domains for sale" maxlength="11">

<button class="btn b-rad b-s all-shadow-lg" type="submit"><i class="fa fa-search"></i></button>

</div>

  </form>

  @if ($errors->has('search'))

  <h6 class="mt-3 mb-3"><i>{{ $errors->first('search') }}</i></h6>

  @endif


</div>

</div>

</div>

</div>

<!-- Hot domains -->

<section class="sec-hot">

<div class="container mb-2 mt-3">

<h4 class="hot-domains">Buy Domain Names in Easy Steps</h4>

<div class="row p-m-p">

<!-- Steps -->

<div class="col-lg-6 col-md-12 col-sm-12">

<img src="{{ asset('images/online-girl.png') }}" class="before-steps mx-auto">

</div>

<div class="col-lg-6 col-md-12 col-sm-12">

<div class="container">

<div class="row">

 <div class="col-lg-6 col-md-3 col-sm-12 mb-2">

<div class="sm-card">

<i class="fa fa-search primary-c-text"></i>

<h4 class="mt-2">Find your unique domain</h4>

<p>Search for that perfect domain to mark your presence in the digital world</p>

</div>
 </div>
 
 <div class="col-lg-6 col-md-3 col-sm-12 mb-2">

<div class="sm-card">

<span class="primary-c-text">&#8358;</span>

<h4 class="mt-2">Make payment to secure it</h4>

<p>You can pay using a debit card or bank transfer</p>

</div>
 </div>

 <div class="col-lg-6 col-md-3 col-sm-12">

<div class="sm-card">

<i class="fa-regular fa-envelope primary-c-text"></i>

<h4 class="mt-3">Wait for an agent to reach out</h4>

<p>An support agent will contact you to begin domain transfer</p>

</div>
 </div>

 <div class="col-lg-6 col-md-3 col-sm-12">

<div class="sm-card">

<i class="fa-regular fa-handshake primary-c-text"></i>

<h4 class="mt-3">Transfer of ownership</h4>

<p>Congrats! Your domain has been transferred to you</p>

</div>
 </div>
 

</div>
</div>
</div>
 

</div>

</div>

</section>

<!-- Domain box -->

<section class="sec-hot-2">

<h4 class="hot-domains mb-3">Popular Domain Names For Sale</h4>

<p class="text-muted text-center">These popular and catchy domain names for sale are a great way to create a 
  
  memorable brand that keeps your customers coming back. Buy the perfect brand name today.</p>

<div class="container mb-2">

<div class="row row-35 p-m-p">

@foreach ($domains as $domain )
    
<div class="col-lg-3 col-md-4 col-6">

<a href="domains/{{$domain->url}}">

<div class="name-box">

<div class="card b-rad">

    <div class="logo-box">

    <img src="/images/{{$domain->logo_url}}">

    </div>

    <div class="card-body">

    <div class="w-100 text-center">

<h6 class="domain-text text-center">{{$domain->url}}</h6>

<h6 class="domain-price text-center">&#8358;{{number_format($domain->price)}}</h6>

    </div>

    </div>

    </div>

</div>

</a>

</div>

@endforeach

</div>

<!-- More domains button -->

<a href="browse-domains.php">
    
    <button class="btn btn-dark btn-more p-3 no-rad mt-3 mx-auto">View More Popular Names 
        
    </button></a>

<!-- Close Container and Row -->

</div>
</div>

<!-- Short domains -->

<div class="container mt-5 mb-2">

<h4 class="hot-domains mb-3">Short Brand Names for sale</h4>

<p class="text-muted text-center">Purchase website names that are short and easy to remember. Short and catchy business names are a great strategy for creating a reliable brand. Explore our collection of short website names for sale.</p>

<div class="row row-35 p-m-p">

<!-- Domain box -->

@foreach ($domains as $domain )
    
<div class="col-lg-3 col-6">

<a href="domains/{{$domain->url}}">

<div class="name-box">

<div class="card b-rad">

    <div class="logo-box">

    <img src="/images/{{$domain->logo_url}}">

    </div>

    <div class="card-body">

    <div class="w-100 text-center">

<h6 class="domain-text text-center">{{$domain->url}}</h6>

<h6 class="domain-price text-center">&#8358;{{number_format($domain->price)}}</h6>

    </div>

    </div>

    </div>

</div>

</a>

</div>

@endforeach

</div>

<!-- More domains button -->

<a href="browse-domains.php?type=short">
  
  <button class="btn btn-outline-dark btn-more no-rad p-3 mt-3 mx-auto">View More Short Names</button></a>

<!-- Close Container and Row -->

</div>
</div>
</section>

<!-- Premium domains -->

<section class="sec-hot">

<div class="container">

<h4 class="hot-domains mb-3">Premium Domain Names For Sale</h4>

<p class="text-muted text-center">Hurry and Buy a premium name for your business before they are gone.</p>

<div class="row row-35 p-m-p">

<!-- Domain box -->

@foreach ($domains as $domain )
    
<div class="col-lg-3 col-6">

<a href="domains/{{$domain->url}}">

<div class="name-box">

<div class="card b-rad">

    <div class="logo-box">

    <img src="/images/{{$domain->logo_url}}">

    </div>

    <div class="card-body">

    <div class="w-100 text-center">

<h6 class="domain-text text-center">{{$domain->url}}</h6>

<h6 class="domain-price text-center">&#8358;{{number_format($domain->price)}}</h6>

    </div>

    </div>

    </div>

</div>

</a>

</div>

@endforeach

</div>

<!-- More domains button -->

<a href="browse-domains.php"><button class="btn btn-outline-dark p-3 btn-more no-rad mt-3 mx-auto">View More Premium Names 
  </button></a>

</div>

</section>

<!-- Sellers Hero -->

<div class="container mb-5">

<div class="row p-3">

 <div class="col-lg-11 col-md-12 col-sm-12 mt-2 seller-hero mx-auto">

 <div class="container">

 <div class="row p-5">

 <div class="col-lg-5 col-md-5 col-sm-12">

 <h6 class="s-hero-text"><strong>Become</strong> a seller.</h6>

 <h4 class="big-2">Start selling your domain names in <span>seconds</span></h4>

 <a href="register"><button class="btn btn-dark mt-3 text-main-font">Register now</button></a>

 </div>

 <div class="col-lg-7 col-md-12 col-sm-12 steps">

 <div class="d-inline-flex">

 <div class="sm-card-2">

 <span class="badge bg-dark">1</span>

<h4 class="mt-3">Register Account</h4>

</div>

<div class="sm-card-2">

<span class="badge bg-dark">2</span>

<h4 class="mt-3">Add Domain</h4>

</div>

<div class="sm-card-2">

<span class="badge bg-dark">3</span>

<h4 class="mt-3">Verify Ownership</h4>

</div>


 </div>
 </div>


 </div>
 </div>
 </div>



<!-- Close Container and Row -->

</div>
</div>

<!-- Shop by Industry -->

<div class="container mb-5 mt-3">

<h4 class="hot-domains-2">Find Domains in Top Industries</h4>

<div class="row p-3">

<!-- Industry box -->

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/agriculture">

<div class="sm-card-3">

<img src="{{ asset('images/planting.png') }}">

<h4 class="mt-2 mb-3">Agriculture</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/creativity">

<div class="sm-card-3">

<img src="{{ asset('images/creativity.png') }}">

<h4 class="mt-2 mb-3">Creativity</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/business">

<div class="sm-card-3">

<img src="{{ asset('images/briefcase.png') }}">

<h4 class="mt-2 mb-3">Business</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/government">

<div class="sm-card-3">

<img src="{{ asset('images/government-house.png') }}">

<h4 class="mt-2 mb-3">Government</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/kids">

<div class="sm-card-3">

<img src="{{ asset('images/children.png') }}">

<h4 class="mt-2 mb-3">Kids</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/health">

<div class="sm-card-3">

<img src="{{ asset('images/healthcare.png') }}">

<h4 class="mt-2 mb-3">Health</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/finance">

<div class="sm-card-3">

<img src="{{ asset('images/stats.png') }}">

<h4 class="mt-2 mb-3">Finance</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/entertainment">

<div class="sm-card-3">

<img src="{{ asset('images/cinema.png') }}">

<h4 class="mt-2 mb-3">Entertainment</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/marketing">

<div class="sm-card-3">

<img src="{{ asset('images/megaphone.png') }}">

<h4 class="mt-2 mb-3">Marketing</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/social">

<div class="sm-card-3">

<img src="{{ asset('images/social-media.png') }}">

<h4 class="mt-2 mb-3">Social</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/media">

<div class="sm-card-3">

<img src="{{ asset('images/video.png') }}">

<h4 class="mt-2 mb-3">Media</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="industry/technology">

<div class="sm-card-3">

<img src="{{ asset('images/technology.png') }}">

<h4 class="mt-2 mb-3">Technology</h4>

</div>

</a>

</div>

<!-- End Industry box -->

</div>

</div>

</section>

<!-- FAQ -->

<section class="sec-hot-2">

<div class="container">

<h4 class="hot-domains-2">Frequently Asked Questions</h4>

<div class="row p-3">

<div class="col-lg-7 col-md-7 col-sm-12 mx-auto">

    <!-- FAQ 1 -->

<div class="accordion accordion-flush" id="accordionFlushExample">

  <div class="accordion-item">

    <h2 class="accordion-header" id="flush-headingOne">

      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        
      What is domainer.ng?
      
    </button>

    </h2>

    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      
    <div class="accordion-body">
      
    Domainer.ng is a platform that connects domain name sellers to buyers. On our platform, people willing to let go of their domain names can list it for sale and anyone interested in the name will purchase it.</div>
    
</div>

  </div>

  <!-- FAQ 2 -->

  <div class="accordion-item">

    <h2 class="accordion-header" id="flush-headingTwo">

      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        
      How long do I need to wait for domain approval?
      
    </button>

    </h2>

    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      
    <div class="accordion-body">As a domain seller, your domain is approved immediately you verify domain ownership and complete the listing information.</div>
    
</div>

  </div>

  <!-- FAQ 3 -->

  <div class="accordion-item">

    <h2 class="accordion-header" id="flush-headingThree">

      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        
      When will I get my domain after paying for it?
      
    </button>

    </h2>

    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      
    <div class="accordion-body">After your payment is confirmed, an agent from our team will contact you and the domain will be transferred to you within 24 hours.</div>
    
</div>

  </div>

</div>

</div>



</div>

</div>

</section>

@include('layouts.footer')