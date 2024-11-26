<section>
<header>
<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
{{ __('Banking Details') }}
</h2>

<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
{{ __("Update your bank account information.") }}
</p>
</header>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
@csrf
@method('patch')

<div>
<x-input-label for="bankname" :value="__('Bank Name')" />
<x-text-input id="bank" name="bank" type="text" class="mt-1 block w-full" :value="old('bank', $user->bank_name)" required autofocus/>
<x-input-error class="mt-2" :messages="$errors->get('bank')" />
</div>

<div>
<x-input-label for="acc" :value="__('Account Number')" />
<x-text-input id="acc" name="acc" type="number" class="mt-1 block w-full" :value="old('acc', $user->bank_acc)" required/>
<x-input-error class="mt-2" :messages="$errors->get('acc')" />

</div>

<div class="flex items-center gap-4">
<x-primary-button>{{ __('Save') }}</x-primary-button>

@if (session('status') === 'profile-updated')
<p
x-data="{ show: true }"
x-show="show"
x-transition
x-init="setTimeout(() => show = false, 2000)"
class="text-sm text-gray-600 dark:text-gray-400"
>{{ __('Saved.') }}</p>
@endif
</div>
</form>
</section>
