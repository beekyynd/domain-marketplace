<x-app-layout>

    @livewireScripts
    
<x-slot name="header">

<h4 class="italic text-base text-gren-700 dark:text-green-600">

@if (request()->query('view') ==='payouts')

{{ __('Money you have been paid by us will be shown here') }}

@else

{{ __('Money you have made from domain sales will be shown here') }}

@endif

</h4>


</x-slot>

<div class="flex flex-col px-4">

<form method="GET" id="form" action="{{ route('dashboard.finance') }}" onchange="formFilter()">

<div class="flex flex-row justify-center items-center mt-6 mb-3">

<select class="inline-flex rounded-md shadow-sm" name="view">

<option disabled selected>--Filters--</option>

<option value="payouts">Payouts</option>

<option value="earnings">Earnings</option>

</select>

</div>

</form>

<div class="overflow-x-auto">

<div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">

<div class="overflow-hidden">
    
<table class="min-w-full text-left text-sm font-light text-surface dark:text-white">

<thead class="border-b border-neutral-200 uppercase font-medium text-gray-800 dark:text-gray-100 dark:border-white/10">

<tr>

<th scope="col" class="px-6 py-4">Date</th>
<th scope="col" class="px-6 py-4">Description</th>
<th scope="col" class="px-6 py-4">Amount</th>
<th scope="col" class="px-6 py-4">Status</th>

</tr>

</thead>

<tbody>

@foreach ($finance as $result )

<tr class="border-b border-neutral-200 dark:border-white/10">

<td class="whitespace-nowrap px-6 py-4 font-medium">{{ $result->created_at }}</td>

<td class="whitespace-nowrap px-6 py-4">

    @if (request()->query('view') ==='earnings')

The sale of {{ $result->description }}

@else

{{ $result->description }}

@endif

</td>

<td class="whitespace-nowrap px-6 py-4">&#8358;{{ number_format($result->amount) }}</td>

<td class="whitespace-nowrap px-6 py-4">

    @if ($result->status ==="complete" || $result->status ==="paid")

<span class="text-green-800 bg-green-300 px-2 py-1 rounded-lg tiny-text">{{ $result->status }}</span>

@else

<span class="text-red-800 bg-red-300 px-2 py-1 rounded-lg tiny-text">{{ $result->status }}</span>

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

    {{ $finance->links() }}
    
    </div>

<script>

function formFilter() {

let form = document.getElementById('form');

form.submit();
}

</script>

</x-app-layout>