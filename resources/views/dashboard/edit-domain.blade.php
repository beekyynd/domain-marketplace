<x-app-layout>

  @livewireScripts
  
<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-3">

{{ __('Finish the setup of ') }} {{$domain->url}}

</h2>

<span class="font-semibold text-md text-red-600 dark:text-red-600 leading-tight mt-3">

  <i>{{ __('NOTICE: Ideas will be generated automatically') }}</i>
  
</span>

</x-slot>

<!-- 

Parent container 

-->

<div class="py-6">

<!-- Ownership verification -->

<div class="container mt-6 mx-auto rounded-lg bg-white shadow-lg dark:bg-neutral-900 dark:text-white text-surface">

<div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">

Verify Ownership

</div>

<div class="p-6">

<h5 class="mb-2 text-xl font-medium leading-tight">

Configure Nameservers

</h5>

<p class="mb-4 text-base">Make sure your domain nameservers points to us, <strong>ns1.domainer.ng</strong> and 

<strong>ns2.domainer.ng</strong>.</p>

<div class="flex justify-center">

<button type="submit" class="px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-900 focus:ring-indigo-500 transition ease-in-out duration-150">

Verify

</button>

</div>

</div>
</div>

@if ($errors->any())
<div class="bg-neutral-100 dark:bg-neutral-800 text-red-600">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="post" enctype="multipart/form-data" class="f-c" action="{{ route('domains.update', $domain->url) }}">

    @csrf
    @method('PATCH')

<!-- Tags -->

<div class="container mt-6 mx-auto rounded-lg bg-white shadow-lg dark:bg-neutral-900 dark:text-white text-surface">

<div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">

Tags <span class="red-text text-sm">*required</span>

</div>

<div class="p-6">

<p class="mb-4 text-base">

Choose between 1 to 3 <strong>industries</strong> for this domain. These help your domain get discovered by buyers.</p>

@if ($domain->tags !="")

<p class="mt-4 mb-4">Current:
    
    @php 
    
    $keys = explode(",", $domain->tags);

  @endphp

  @foreach ($keys as $k)

  <span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg tiny-text">{{$k}}</span>
    
  @endforeach

</p>

  @endif

</p>

<div class="form-check mt-4">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="agric" id="agric">

<label class="form-check-label" for="agriculture">

Agriculture

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="business" id="business">

<label class="form-check-label" for="business">

Business

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="entertainment" id="entertainment">

<label class="form-check-label" for="entertainment">

Entertainment

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="creative" id="creative">

<label class="form-check-label" for="creative">

Creative

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="kids" id="kids">

<label class="form-check-label" for="kids">

Kids

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="finance" id="finance">

<label class="form-check-label" for="finance">

Finance

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="government" id="government">

<label class="form-check-label" for="government">

Government

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="media" id="media">

<label class="form-check-label" for="media">

Media

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="health" id="health">

<label class="form-check-label" for="health">

Health

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="social" id="social">

<label class="form-check-label" for="social">

Social

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="technology" id="technology">

<label class="form-check-label" for="technology">

Technology

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="marketing" id="marketing">

<label class="form-check-label" for="marketing">

Marketing

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="transport" id="transport">

<label class="form-check-label" for="transport">

Transport

</label>

</div>

<div class="form-check">

<input class="border-gray-300 rounded-sm shadow-sm" type="checkbox" name="tag[]" value="shopping" id="shopping">

<label class="form-check-label" for="shopping">

Shopping

</label>

</div>

</div></div>


<!-- Logo upload -->

<div class="container mt-6 mx-auto rounded-lg bg-white shadow-lg dark:bg-neutral-900 dark:text-white text-surface">

<div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">

Logo Upload

</div>

<div class="p-6">

<input
class="relative m-0 block w-full sm:max-w-sm min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
type="file"
name="logo"
id="formFile" />

<div id="file-info" class="mt-3">

<h6>Current Logo</h6>

<img src="{{asset('public/storage')}}/{{ $domain->logo_url }}" class="mt-2 w-32 h-32"/>

</div>
</div>
</div>

<!-- 

Grid layout

-->

<!-- Keywords -->

<div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 gap-4 content-start py-6">

<div class="mt-6 rounded-lg bg-white shadow-lg dark:bg-neutral-900 dark:text-white text-surface">

<div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">

Keywords <span class="red-text text-sm">*required</span>

</div>

<div class="p-6">

<p>You can optionally add custom keywords, seperated by commas.</p>

@if ($domain->keywords !="")

<p class="mt-4 mb-4">Current:
    
    @php 
    
    $keys = explode(",", $domain->keywords);

  @endphp

  @foreach ($keys as $k)

  <span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg tiny-text">{{$k}}</span>
    
  @endforeach

</p>

@endif

<input type="text" name="keywords" id="keywords" value="{{$domain->keywords}}"
class="w-full border-gray-300 text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required> 


</div>
</div>

<!-- Pricing -->

<div class="mt-6 rounded-lg bg-white shadow-lg dark:bg-neutral-900 dark:text-white text-surface">

<div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">

Price (&#8358;)

</div>

<div class="p-6">

<p>You can change the list price of this domain before it is listed for sale. Once it is listed you can't change the price.</p>

<div class="mt-3">

    @if ($domain->price !="")

<input type="text" name="price" id="price" value="&#8358;{{number_format($domain->price)}}" 
class="w-full border-gray-300 bg-neutral-100 dark:bg-neutral-500 text-gray-800 dark:text-gray-200 rounded-md shadow-sm" disabled> 

@else

<input type="text" name="price" id="price" class="w-full border-gray-300 text-gray-800 rounded-md shadow-sm" required> 

@endif

</div>
</div> 

</div>

</div>

<div class="flex justify-center">

<button type="submit" class="px-4 mt-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-800 focus:ring-indigo-500 transition ease-in-out duration-150">

Save Changes

</button>

</div>

</form>

<!-- End all divs -->

</div>

<!-- Js to limit tags -->

<script>

document.addEventListener('DOMContentLoaded', function () {
const maxSelections = 3;

// Select all checkboxes with the name 'category[]'
const checkboxes = document.querySelectorAll('input[name="tag[]"]');

checkboxes.forEach((checkbox) => {
checkbox.addEventListener('change', function () {
// Count how many checkboxes are checked
const checkedBoxes = document.querySelectorAll('input[name="tag[]"]:checked');
if (checkedBoxes.length > maxSelections) {
alert(`You can only select up to ${maxSelections} tags.`);
this.checked = false; // Undo the selection
}
});
});
});
</script>

</x-app-layout>