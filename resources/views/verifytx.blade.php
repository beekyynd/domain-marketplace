@include('layouts.header')

<section class="sec-hot">

    <div class="container mb-5 mt-3">
    
    <div class="row p-3">

        @if ($findRef == 1)
    
    <div class="alert alert-success mx-auto mt-5 text-center">

    This transaction <strong>#{{ $reference }}</strong> is already completed. Thank you!

    </div>

        @else

    <div class="alert alert-success mx-auto mt-5 text-center">
    
    <span>Thank you for your payment with Reference <strong>#{{ $reference }}</strong> . We will contact you using your payment email to begin transfer of ownership. Thank you!</span>
    
    </div>

    @endif
    
    </div>
    
    </div>
    
    </section>
     
<!-- Footer -->

@include('layouts.footer')