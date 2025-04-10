<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<html>

<head>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, rgb(111, 0, 255) 0%, rgb(255, 143, 160) 100%);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .brand-text {
            color: #0a192f;
            font-size: 28px;
            font-weight: bold;
            line-height: 1;
        }

        h1 {
            color: #0a192f;
            font-size: 36px;
            margin-bottom: 30px;
            align-self: flex-start;
            margin-left: calc(50% - 175px);
            font-weight: normal;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 50px;
            border-radius: 30px;
        }

        .form-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <h1 class="text-center mb-3">Welcome Back!!</h1>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="block w-full mt-1 form-field" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input wire:model="form.password" id="password" class="block w-full mt-1 form-field"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        <div class="mt-4 text-sm text-center text-gray-600">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-900" wire:navigate>
                {{ __('Sign up') }}
            </a>
        </div>
    </div>
</body>

</html>