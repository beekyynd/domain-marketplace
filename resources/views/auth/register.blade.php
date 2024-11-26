<x-guest-layout>

<form method="POST" action="{{ route('register') }}">
@csrf

<!-- Name -->
<div>
<x-input-label for="name" :value="__('Name')" />
<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
<x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="mt-4">
<x-input-label for="email" :value="__('Email')" />
<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Phone -->
<div class="mt-4">
    <x-input-label for="phone" :value="__('Mobile Number')" />
    <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autocomplete="phone" />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

<!-- Bank Name -->
<div class="mt-4">
    <x-input-label for="bankname" :value="__('Bank Name')" />
    <x-text-input id="bankname" class="block mt-1 w-full" type="text" name="bankname" :value="old('bankname')" required/>
    <x-input-error :messages="$errors->get('bankname')" class="mt-2" />
    </div>

<!-- Bank Account -->
<div class="mt-4">
    <x-input-label for="acc" :value="__('Account Number')" />
    <x-text-input id="acc" class="block mt-1 w-full" type="text" name="acc" :value="old('acc')" required/>
    <x-input-error :messages="$errors->get('acc')" class="mt-2" />
    </div>

<!-- Password -->
<div class="mt-4">
<x-input-label for="password" :value="__('Password')" />

<x-text-input id="password" class="block mt-1 w-full"
type="password"
name="password"
required autocomplete="new-password" />

<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
<x-input-label for="password_confirmation" :value="__('Confirm Password')" />

<x-text-input id="password_confirmation" class="block mt-1 w-full"
type="password"
name="password_confirmation" required autocomplete="new-password" />

<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
{{ __('Already registered?') }}
</a>

<x-primary-button class="ms-4">
{{ __('Register') }}
</x-primary-button>
</div>
</form>
</x-guest-layout>
