<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-image {
            background-image: url("{{ asset('images/bg-login.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1 0 auto;
        }

        .footer {
            flex-shrink: 0;
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
        }

        .floating-label-group {
            position: relative;
        }

        .floating-label {
            position: absolute;
            pointer-events: none;
            left: 12px;
            top: 11px;
            transition: 0.2s ease all;
        }

        .floating-input:focus~.floating-label,
        .floating-input:not(:placeholder-shown)~.floating-label {
            top: -10px;
            left: 10px;
            font-size: 11px;
            opacity: 1;
            background: white;
            padding: 0 5px;
        }
    </style>
    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.onkeydown = function(e) {
            if (e.key === "F12" || (e.ctrlKey && e.shiftKey && e.key === "I") || (e.ctrlKey && e.shiftKey && e.key === "J") || (e.ctrlKey && e.key === "U")) {
                return false;
            }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="content flex items-center justify-center p-4">
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-4xl">
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-2xl font-bold mb-2 text-gray-800">Login</h2>
                <p class="text-gray-600 mb-6">Jika Kamu Sudah Punya Akun, Silahkan Login!</p>

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-4 floating-label-group">
                        <input type="email" id="email" name="email" required class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" ">
                        <label for="email" class="floating-label text-gray-500">Email</label>
                    </div>
                    <div class="mb-6 floating-label-group">
                        <input type="password" id="password" name="password" required class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" ">
                        <label for="password" class="floating-label text-gray-500">Password</label>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
                </form>
                <div class="mt-4 text-center">
                    <span class="text-gray-600">OR</span>
                </div>
                <div class="container mt-6 justify-beetwen text-sm text-gray-600">
                    <p class="text-center">Belum Punya Akun? <a href="{{ route('register') }}" class="text-blue-500">Buat Disini</a></p>
                </div>
                <div class="container mt-6 justify-beetwen text-sm text-gray-600">
                    <p class="text-center"> <a href="{{ route('password.request') }}" class="text-blue-500">Lupa Password?</a></p>
                </div>
            </div>
            <div class="w-full md:w-1/2 bg-image"></div>
        </div>
    </div>
    <footer class="footer">
        @include('partials.copyright')
    </footer>
</body>

</html>