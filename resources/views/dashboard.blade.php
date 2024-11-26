<x-app-layout>

@livewireScripts

<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

{{ __('Account Overview') }}

</h2>

</x-slot>

@php
    
    $forSale = $stats->whereIn('status', ['available', 'pending'])->count();

    $listed = $stats->where('listed','yes')->where('status','available')->count();

    $notListed = $stats->where('listed','no')->where('status','available')->count();

    $soldCount = $stats->where('status','sold')->count();

    $soldValue = $stats->where('status','sold')->sum('price');

    $commissions = $stats->where('status','available')->sum('commission');

    $onsaleValue = $stats->where('status','available')->sum('price');

    $portfolio = $onsaleValue - $commissions;

@endphp

<div class="grid bg-white dark:bg-gray-900 px-6 grid-cols-1 sm:grid-cols-2 gap-4 content-start mt-6 py-6">

<!-- Card -->

<div class='rounded-lg shadow-lg px-6 py-6 bg-white dark:bg-gray-800 text-gray-800 dark:text-white text-2xl border-r border-r-8 border-r-gray-800 dark:border-r-gray-100'>

<h4 class="mb-3 text-base sm:text-lg">Domains for sale</h4>

<h4 class="mb-3"><span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg">{{$forSale}}</span></h4>

<p class="mb-3-info text-base">Number of domains you currently have for sale.</p>

</div>

<!-- Card -->

<div class='rounded-lg shadow-lg px-6 py-6 bg-white dark:bg-gray-800 text-gray-800 dark:text-white text-2xl border-r border-r-8 border-r-gray-800 dark:border-r-gray-100'>

<h4 class="mb-3 text-base sm:text-lg">Portfolio Value</h4>

<h4 class="mb-3 text-base font-semibold">&#8358;{{number_format($portfolio)}}</h4>

<p class="mb-3-info text-base">Total value of all of your listed domains, minus commission.</p>

</div>

<!-- Card -->

<div class='rounded-lg shadow-lg px-6 py-6 bg-white dark:bg-gray-800 text-gray-800 dark:text-white text-2xl border-r border-r-8 border-r-gray-800 dark:border-r-gray-100'>

<h4 class="mb-3 text-base sm:text-lg">Listed Domains</h4>

<h4 class="mb-3"><span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg">{{$listed}}</span></h4>

<p class="mb-3-info text-base">Total domains that have been listed.</p>

</div>

<!-- Card -->

<div class='rounded-lg shadow-lg px-6 py-6 bg-white dark:bg-gray-800 text-gray-800 dark:text-white text-2xl border-r border-r-8 border-r-gray-800 dark:border-r-gray-100'>

<h4 class="mb-3 text-base sm:text-lg">Unlisted Domains</h4>

<h4 class="mb-3"><span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg">{{$notListed}}</span></h4>

<p class="mb-3-info text-base">Total domains that have not been listed.</p>

</div>

<!-- Card -->

<div class='rounded-lg shadow-lg px-6 py-6 bg-white dark:bg-gray-800 text-gray-800 dark:text-white text-2xl border-r border-r-8 border-r-gray-800 dark:border-r-gray-100'>

<h4 class="mb-3 text-base sm:text-lg">Sold Domains</h4>

<h4 class="mb-3"><span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg">{{$soldCount}}</span></h4>

<p class="mb-3-info text-base">Number of your domains sold.</p>

</div>

<!-- Card -->

<div class='rounded-lg shadow-lg px-6 py-6 bg-white dark:bg-gray-800 text-gray-800 dark:text-white text-2xl border-r border-r-8 border-r-gray-800 dark:border-r-gray-100'>

<h4 class="mb-3 text-base sm:text-lg">Total Value of Sold Domains</h4>

<h4 class="mb-3 text-base font-semibold">&#8358;{{number_format($soldValue)}}</h4>

<p class="mb-3-info text-base">Total value of all your domains sold.</p>

</div>



</div>

</x-app-layout>
