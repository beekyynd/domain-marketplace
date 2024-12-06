<div>

<x-slot name="header">

<h4 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

{{ __('My Domains') }}

</h4>

<form method="POST" action="{{ route('domains.store') }}"> 

<div class="flex flex-row gap-3 mt-6 mb-3">

@csrf

<input type="number" name="id" value="{{Auth::user()->id}}" hidden>

<input type="text" name="url" id="url" pattern="[a-z0-9.\-]+\.[a-z]{2,}$" placeholder="E.g 'xyz.com' without https://" 
class="w-full max-w-sm border-gray-300 text-sm text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"> 

<button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">

Add Domain

</button>

</div>

</form>

@if ($errors->any())
<div class="text-red-600">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

</x-slot>

<div class="px-4 py-6">

<div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

<div class="w-full md:w-1/2">

<form class="flex items-center">

<div class="relative w-full">

<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

<svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

<path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />

</svg>

</div>

<input wire:model.live="search" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search your domains" required>

</div>
</form>
</div>

<div>

<select wire:model.live="filter" class="rounded-md shadow-sm"> 

    <option value="" disabled selected>--Filters--</option>

    <option value="pending">Pending</option>

    <option value="sold">Sold</option>

    <option value="available">Available</option>

    <option value="suspended">Suspended</option>

</select>

</div>

</div>

@if (session('status') ==="updated")
<p
x-data="{ show: true }"
x-show="show"
x-transition
x-init="setTimeout(() => show = false, 2000)"
class="text-sm text-green-600 dark:text-green-600 text-center"
>{{ __('Domain Updated.') }}</p>
@endif

@if (session('status') ==="deleted")
<p
x-data="{ show: true }"
x-show="show"
x-transition
x-init="setTimeout(() => show = false, 2000)"
class="text-sm text-red-600 dark:text-red-600 text-center"
>{{ __('Domain Deleted.') }}</p>
@endif

<div class="overflow-x-auto">

<div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">

<div class="overflow-hidden">

<table class="min-w-full text-left text-sm font-light text-surface dark:text-white">

<thead class="border-b border-neutral-200 uppercase font-medium text-gray-800 dark:text-gray-100 dark:border-white/10">

<tr>

<th scope="col" class="px-6 py-4">Domain</th>
<th scope="col" class="px-6 py-4">Status</th>
<th scope="col" class="px-6 py-4">Price</th>
<th scope="col" class="px-6 py-4">Creation</th>
<th scope="col" class="px-6 py-4">Actions</th>

</tr>

</thead>

<tbody>

@forelse ($domains as $domain )

<tr class="border-b border-neutral-200 dark:border-white/10">

<td class="whitespace-nowrap px-6 py-4 font-medium">{{ $domain->url }}</td>

<td class="whitespace-nowrap px-6 py-4">

@if ($domain->verified ==="yes")

<span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg tiny-text">Complete</span>

@else

<span class="text-yellow-800 bg-yellow-300 px-2 py-1 rounded-lg tiny-text">Pending</span>

@endif

</td>

<td class="whitespace-nowrap px-6 py-4">&#8358;{{ number_format($domain->price) }}</td>

<td class="whitespace-nowrap px-6 py-4">{{ $domain->created_at }}</td>

<td class="whitespace-nowrap px-6 py-4 flex flex-row gap-3">

@if ($domain->status !="sold")

<a href="{{route('dashboard.domains')}}/{{$domain->url}}">

<button type="submit" class="inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">

Edit

</button>

</a>

<form method="POST" action="{{ route('domains.destroy', $domain->url) }}"> 

@csrf
@method('DELETE')

<button type="submit" onclick="return confirm('Delete {{ $domain->url }}?')" class="inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">

Drop

</button>

</form>

@else

<span class="text-gray-500 bold uppercase">Sold</span>

@endif

</td>

</tr>

@empty

<span class="text-red-600 italic">No records found</span>

@endforelse

</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="px-4 py-4">

{{ $domains->links() }}

</div>

<script>

function formFilter() {

let form = document.getElementById('form');

form.submit();
}

</script>

</div>