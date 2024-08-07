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
</style>
@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-500 text-white px-6 py-4 text-lg font-semibold text-center">
                    {{ __('Reset Password') }}
                </div>
                <div class="px-6 py-4">
                    @if (session('status'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                    Kami telah mengirimkan tautan pengaturan ulang kata sandi Anda melalui email.
                    </div>
                    @endif
                    <!-- placeholder -->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="floating-label-group mb-4">
                            <input id="email" type="email" placeholder=" " class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email" class="floating-label block text-sm font-medium text-gray-500">{{ __('Email Address') }}</label>
                            @error('email')
                            <p class="text-red-500 text-xs italic mt-2">Kami tidak dapat menemukan pengguna dengan alamat email tersebut.</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection