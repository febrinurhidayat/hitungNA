@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-500 text-white px-6 py-4 font-bold text-lg text-center  ">
                    {{ __('Verifikasi Alamat Email Anda') }}
                </div>
                <div class="px-6 py-4 text-center">
                    @if (session('resent'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ __('Tautan Verifikasi Baru Telah Dikirim Ke Alamat Email Anda.') }}
                        </div>
                    @endif
                    <p class="mb-4 text-gray-700">{{ __('Sebelum Melanjutkan, Periksa Email Anda Atau Folder Spam Untuk Tautan Verifikasi.') }}</p>
                    <p class="mb-4 text-gray-700">{{ __('Jika Anda Tidak Menerima Email') }}</p>
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Kirim Ulang Email') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
