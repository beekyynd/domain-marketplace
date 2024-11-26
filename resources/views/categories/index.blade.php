<x-app-layout>

<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800 dark:text-green-200 leading-tight">

{{ __('Categories') }}

</h2>

</x-slot>

<div class="py-12">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

<div class="p-6 text-gray-900 dark:text-gray-100">

    <a href="{{ route('categories.create') }}">Add new category</a> 

<table> 

<thead>

<tr>

<th>Name</th>

<th></th>

</tr>

</thead>

<tbody>

@if (count($categories))

@foreach($categories as $category)

<tr>

<td>{{ $category->name }}</td>

<td>

<div class="flex space-x-4 mb-6 text-sm font-medium">

<div class="flex-auto flex space-x-4">

<a href="{{ route('categories.edit', $category) }}">
    
<button class="h-10 px-6 font-semibold rounded-md bg-black text-white" type="submit">

Edit</button></a>

<form method="POST" action="{{ route('categories.destroy', $category) }}"> 

    @csrf
    @method('DELETE')

<button type="submit" class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 dark:text-green-200" onclick="return confirm('Delete {{ $category->name }}?')">Delete</button>

</form>

</div>

</div>

</td>


</tr>

@endforeach

@else

<br>There is no record

@endif

</tbody>

</table> 

</div>
</div>
</div>
</div>
</x-app-layout>
