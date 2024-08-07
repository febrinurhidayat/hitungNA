<style>
    .floating-label-group {
        position: relative;
        margin-bottom: 16px;
    }

    .floating-label-group input,
    .floating-label-group label {
        transition: all 0.2s ease-in-out;
    }

    .floating-input:focus~.floating-label,
    .floating-input:not(:placeholder-shown)~.floating-label {
        top: -2px;
        left: 10px;
        font-size: 11px;
        opacity: 1;
        background: white;
        padding: 0 5px;
    }

    .floating-label-group label {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        padding-left: 0.75em;
    }

    .floating-label-group input {
        padding-top: 1.5em;
    }

    .password-toggle-icon,
    .confirm-password-toggle-icon {
        position: absolute;
        top: 12px;
        right: 0.75rem;
        display: flex;
        align-items: center;
        cursor: pointer;
    }
</style>
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        var icon = document.querySelector('.password-toggle-icon i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        }
    }

    function toggleConfirmPasswordVisibility() {
        var confirmPasswordField = document.getElementById('password-confirm');
        var icon = document.querySelector('.confirm-password-toggle-icon i');

        if (confirmPasswordField.type === 'password') {
            confirmPasswordField.type = 'text';
            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        } else {
            confirmPasswordField.type = 'password';
            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        }
    }
</script>
@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/remixicon@2.5.0/fonts/remixicon.css">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-500 text-white px-6 py-4 font-bold text-lg text-center">
                    {{ __('Reset Password') }}
                </div>
                <div class="px-6 py-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="py-1">
                            <!-- Email Input -->
                            <div class=" mb-4 floating-label-group">
                                <input id="email" type="email" placeholder=" " class="floating-input peer mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                                <label for="email" class="floating-label absolute top-1 left-3 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-placeholder-shown:translate-y-1/2 peer-focus:top-0 peer-focus:text-indigo-500 peer-focus:text-xs">Email Address</label>
                            </div>

                            <!-- Password Input -->
                            <div class=" mb-4 floating-label-group">
                                <input id="password" type="password" placeholder=" " class="floating-input peer mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password" minlength="8">
                                <label for="password" class="floating-label absolute top-1 left-3 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-placeholder-shown:translate-y-1/2 peer-focus:top-0 peer-focus:text-indigo-500 peer-focus:text-xs">Password</label>
                                <div class="password-toggle-icon" onclick="togglePasswordVisibility()">
                                    <i class="ri-eye-line"></i>
                                </div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class=" mb-4 floating-label-group">
                                <input id="password-confirm" type="password" placeholder=" " class="floating-input peer mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="password_confirmation" required autocomplete="new-password" minlength="8">
                                <label for="password-confirm" class="floating-label absolute top-1 left-3 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-placeholder-shown:translate-y-1/2 peer-focus:top-0 peer-focus:text-indigo-500 peer-focus:text-xs">Confirm Password</label>
                                <div class="confirm-password-toggle-icon" onclick="toggleConfirmPasswordVisibility()">
                                    <i class="ri-eye-line"></i>
                                </div>
                                @error('password')
                                <p class="text-red-500 text-xs italic mt-2">Konformasi Kata Sandi Tidak Cocok</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection