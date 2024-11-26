@include('layouts.header')

<!-- Domain info -->

<section class="sec-hot-3">

<div class="container">

<div class="row mt-2">

@if ($domain->status ==="sold")

<div class="col-lg-12 col-md-12 col-sm-12">

<h6 class="text-center"><strong>Sorry! This domain has been sold.</strong></h6>

</div>

</div>

</div>

</section>

@else

<!-- Second Column -->

<div class="col-lg-8 col-md-10 col-sm-12 mb-3">

@if($domain->logo_url =="")

<div class="logo-box-big">

<span>{{$domain->url}}</span>

</div>

<input id="get-like" value="{{$domain->domain_id}}" hidden>

<h4 class="text-da mt-3">{{$domain->url}} is for sale</h4>

@else

<img class="di-b shadow-sm" src="{{asset('images')}}/{{$domain->logo_url}}">

<input id="get-like" value="{{$domain->domain_id}}" hidden>

<h4 class="text-da mt-3">{{$domain->url}} is for sale</h4>

@endif

</div>

<!-- Third Column -->

<div class="col-lg-4 col-md-12 col-sm-12">

<div class="card h-100 shadow-light b-rad" id="buynow">

<div class="f-top">

<h4 class="buy-small">Make payment for {{$domain->url}}</h4>

</div>

<div class="buy-now">

<h5><strong>&#8358;{{number_format($domain->price)}}</strong></h5>

<h6 class="text-muted text-li">You will receive total ownership of this domain. We will reach out to you for further details after purchase.</h6>

</div>

<form method="POST" action="pay.php">

<input class="form-control-2 mx-auto" type="email" name="email" placeholder="Enter your email" required>

<input type="number" name="price" value="{{$domain->price}}" hidden>

<input type="number" name="id" value="{{$domain->domain_id}}" hidden>

<button class="btn btn-dark btn-more no-rad btn-class mx-auto mt-3 p-3" type="submit">Continue to payment <i class="fa fa-arrow-right"></i></button>

</form>

<div class="mt-5 mb-2">

<img src="{{asset('images/paystack.png')}}" class="paystack-image">

</div>

<div class="ask-us p-3 mt-1">

<span class="text-muted f-size-16">Listed by:</span>

<span><strong><a href="sellers.php?p_url=" class="text-main-color"></a></strong></span>

</div>

</div></div>

<!-- Features -->

<section class=" p-3 mt-3">

<div class="container">

<div class="row">

<div class="col-lg-8 col-md-12 col-sm-12">

<div class="container">

<div class="row">

<div class="col-lg-4 col-md-12 col-sm-12 mb-3">

<div class="sm-card-2">

<img src="{{asset('images/payment.png')}}">

<h5 class="mt-3 text-pay-features">Secure payment</h5>

<p>We use paystack for payment which guarantees safety</p>

</div>

</div>

<div class="col-lg-4 col-md-12 col-sm-12 mb-3">

<div class="sm-card-2">

<img src="{{asset('images/deadline.png')}}">

<h5 class="mt-3 text-pay-features">Fast domain transfer</h5>

<p>Our team do their best to speed up the transfer process</p>

</div></div>

<div class="col-lg-4 col-md-12 col-sm-12 mb-3">

<div class="sm-card-2">

<img src="{{asset('images/money-back.png')}}">

<h5 class="mt-3 text-pay-features">Money back guarantee</h5>

<p>Get what you paid for or we return your money</p>

</div></div>

</div></div></div>


<div class="col-lg-4 col-md-6 col-sm-12 mb-2">

<div class="sm-card-4">

<h6 class="mt-2 expect mb-3">What you will get:</h6>

<h6 class="included"><i class="fa fa-check-circle text-success"></i> Domain name: {{$domain->url}}</h6>

<h6 class="included"><i class="fa fa-check-circle text-success"></i> Logo added</h6>

<h6 class="included"><i class="fa fa-check-circle text-success"></i> Payment protection</h6>

<h6 class="included"><i class="fa fa-check-circle text-success"></i> Support services</h6>

</div>
 </div>

</div></div></div>

</section>


<!-- Domain Details -->

<section class="keywords p-1">

  <div class="container">

    <div class="row">

<div class="col-lg-8 col-md-12 col-sm-12 mt-2 d-details">

<strong><h4 class="text-ideas">About {{$domain->url}}</h4></strong>

<div class="ideas">

@php
  
  echo htmlspecialchars_decode($domain->ideas);

@endphp

</div>
</div>

    </div>

  </div>

 </section>

 <!-- Keywords -->

 <section class="keywords p-1">

<div class="container">

 <div class="row">

<div class="col-lg-12 col-md-12 col-sm-12" id="keywords">

<h4 class="key-text mt-3">Related Keywords</h4>

<div class="all-keywords mt-30 mb-3">

    <p>
    
   @php 
    
    $keys = explode(",", $domain->keywords);

  @endphp

  @foreach ($keys as $k)

  <span class='badge rounded-pill light-green text-dark p-2 me-2 text-capitalize'>{{$k}}</span>
    
  @endforeach

    </p>

</div>


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
        
      How will I get ownership of {{$domain->url}}?
      
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

@endif
 
<!-- Footer -->

@include('layouts.footer')