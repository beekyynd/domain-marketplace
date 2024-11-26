<x-app-layout>

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

<form method="GET" id="form" action="{{ route('dashboard.domains') }}" onchange="formFilter()">

    <div class="flex flex-row justify-center items-center mt-6 mb-3">

        <select class="inline-flex rounded-md shadow-sm" name="filter">

            <option disabled selected>--Filters--</option>

            <option value="setup">Pending</option>

            <option value="sold">Sold</option>

            <option value="available">Available</option>

        </select>

    </div>

</form>
        
<div class="overflow-x-auto">
    
<div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">

<div class="overflow-hidden">

<table class="min-w-full text-left text-sm font-light text-surface dark:text-white">

<thead class="border-b border-neutral-200 uppercase font-medium text-gray-800 dark:text-gray-100 dark:border-white/10">
         
<tr>

<th scope="col" class="px-6 py-4">Domain</th>
<th scope="col" class="px-6 py-4">Setup</th>
<th scope="col" class="px-6 py-4">Price</th>
<th scope="col" class="px-6 py-4">Actions</th>

</tr>

</thead>

<tbody>

@foreach ($domains as $domain )

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

@endforeach

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

</x-app-layout>