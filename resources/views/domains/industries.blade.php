@include('layouts.header')

<!-- Find domains -->

<body>

<div class="to-indus">

<div class="container">

<div class="to-indus-content mx-auto">

<h3 class="mt-3 mb-3 text-center">Find the best <span class="text-capitalize text-light">{{ $tag }}</span> domain for your brand</h3>

<h6 class="mt-3 mb-3">Here, you will find all domain names listed under the <span class="text-capitalize">{{ $tag }}</span> industry that you can use to claim your space in the digital world</h6>

</div>

</div>

</div>

<!-- Domains -->

<section class="sec-hot-2">

<div class="container mb-5">

<div class="row row-35 p-m-p">

<h6 class="text-bl mb-5">Showing {{ $count }} Brand Names in the <span class="text-capitalize">{{ $tag }} Industry</span></h6>
        
<!-- Domain box -->

@forelse ($domains as $result )

<div class="col-lg-3 col-md-3 col-6">

<a href="">

<div class="name-box">

<div class="card b-rad">

    <div class="logo-box">

    <img src="{{asset('images')}}/{{ $result->logo_url }}">

    </div>

    <div class="card-body">

    <div class="w-100">

<h6 class="domain-text text-center">{{ $result->url }}</h6>

<h6 class="domain-price text-center">&#8358;{{ number_format($result->price) }}</h6>

    </div>

    </div>

    </div>

</div>

</a>

</div>

@empty

<h6 class="text-center text-dark">Sorry, no domain is listed under this industry yet</h6>

@endforelse


<!-- END -->

</div>
</div>
</section>

<!-- FAQ -->

<section class="sec-hot-3">

<div class="container">

<h4 class="hot-domains-2">Frequently Asked Questions</h4>

<div class="row p-3">

<div class="col-lg-7 col-md-7 col-sm-12 mx-auto">

    <!-- FAQ 1 -->

<div class="accordion accordion-flush" id="faq">

  <div class="accordion-item">

    <h2 class="accordion-header" id="faq1-h">

      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
        
      How will I get ownership of a domain I purchase?
      
    </button>

    </h2>

    <div id="faq1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faq">
      
    <div class="accordion-body">
      
  After your payment is confirmed, a support agent from our team will reach out to you with specific instructions on how to receive ownership of your domain. This process is usually fast and easy.  

</div></div>

  </div>

  <!-- FAQ 2 -->

  <div class="accordion-item">

    <h2 class="accordion-header" id="faq2-h">

      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
        
      What methods can I use to make payment?
      
    </button>

    </h2>

    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faq">
      
    <div class="accordion-body">
      
    We accept major payment methods like debit cards and bank transfer. However, if you wish to make use of another payment method not available via our payment provider, kindly reach out to our support team.
  
  </div></div>

  </div>

  <!-- FAQ 3 -->

  <div class="accordion-item">

    <h2 class="accordion-header" id="faq3-h">

      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
        
      Is there a refund policy?
      
    </button>

    </h2>

    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faq">
      
    <div class="accordion-body">
      
    If for any reason or reasons you wish to cancel a domain purchase, feel free to reach out to us, provided the following criterias are met:

      <br><p></p>

      <ul>

      <li>Domain was purchased within the last 24 hours</li>

      <li>No transfer of ownership has been carried out</li>

      <li>Acceptance to bear any cancellation fee that may arise</li>

      </ul>

</div></div>

  </div>


<!-- FAQ 4 -->

<div class="accordion-item">

<h2 class="accordion-header" id="faq4-h">

  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
    
  Is there any additional cost after I pay for a domain?
  
</button>

</h2>

<div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faq">
  
<div class="accordion-body">
  
After paying for a domain, we will not charge you for anything else. However, the only additional cost you may incur will be for the domain renewal. This transaction happens between you and the domain name registrar.

</div></div>

</div>












</div>

</div>



</div>

</div>

</section>


<!-- Shop by Industry -->

<section class="sec-hot-4">

<div class="container mb-5 mt-3">

<h4 class="hot-domains-2">Search Domains in Top Industries</h4>

<div class="row p-3">

<!-- Industry box -->

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/agriculture">

<div class="sm-card-3">

<img src="{{asset('images')}}/planting.png">

<h4 class="mt-2 mb-3">Agriculture</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/creativity">

<div class="sm-card-3">

<img src="{{asset('images')}}/creativity.png">

<h4 class="mt-2 mb-3">Creativity</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/business">

<div class="sm-card-3">

<img src="{{asset('images')}}/briefcase.png">

<h4 class="mt-2 mb-3">Business</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/government">

<div class="sm-card-3">

<img src="{{asset('images')}}/government-house.png">

<h4 class="mt-2 mb-3">Government</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/kids">

<div class="sm-card-3">

<img src="{{asset('images')}}/children.png">

<h4 class="mt-2 mb-3">Kids</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/health">

<div class="sm-card-3">

<img src="{{asset('images')}}/healthcare.png">

<h4 class="mt-2 mb-3">Health</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/finance">

<div class="sm-card-3">

<img src="{{asset('images')}}/stats.png">

<h4 class="mt-2 mb-3">Finance</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/entertainment">

<div class="sm-card-3">

<img src="{{asset('images')}}/cinema.png">

<h4 class="mt-2 mb-3">Entertainment</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/marketing">

<div class="sm-card-3">

<img src="{{asset('images')}}/megaphone.png">

<h4 class="mt-2 mb-3">Marketing</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/social">

<div class="sm-card-3">

<img src="{{asset('images')}}/social-media.png">

<h4 class="mt-2 mb-3">Social</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/media">

<div class="sm-card-3">

<img src="{{asset('images')}}/video.png">

<h4 class="mt-2 mb-3">Media</h4>

</div>

</a>

</div>

<div class="col-lg-2 col-md-4 col-sm-6 mb-2">

<a href="{{route('welcome')}}/industry/technology">

<div class="sm-card-3">

<img src="{{asset('images')}}/technology.png">

<h4 class="mt-2 mb-3">Technology</h4>

</div>

</a>

</div>

<!-- End Industry box -->

</div>

</div>

</section>

<script>

$(document).ready(function() {

$('#price_filter').on('click', function() {

    var from_price = $('#from_price').val();

    if(from_price ==="") {

        var from_price = 0;

    }

var to_price = $('#to_price').val();

if(Number(from_price) > Number(to_price)) {

    alert("Minimum price must be less than maximum price");

}

else {

$.ajax({

  url: "price_filter.php",

  type: "GET",

  data: "from="+from_price+'&to='+to_price,

  success: function(html) {

    $('#show_filter').html(html);

  }
})

}

})

});

$(document).ready(function() {

$('#remove_filter').on('click', function() {

    location.reload();

})

});


</script>

@include('layouts.footer')