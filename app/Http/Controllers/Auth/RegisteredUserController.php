<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Log::info('Registration attempt', ['email' => $request->email]);
            
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            $public_url = strstr($request->email, '@', true);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'public_url' => $public_url,
            ]);

            Log::info('User created', ['user_id' => $user->id]);

            event(new Registered($user));

            Auth::login($user);

            Log::info('Registration successful', ['user_id' => $user->id]);

            return redirect()->route('dashboard')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}