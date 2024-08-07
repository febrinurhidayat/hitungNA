<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/remixicon@2.5.0/fonts/remixicon.css">
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

        .password-toggle-icon,.confirm-password-toggle-icon {
            position: absolute;
            top: 10px;
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
            var confirmPasswordField = document.getElementById('password_confirmation');
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

</head>

<body class="bg-gray-100">
    <div class="content flex items-center justify-center p-4">
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-4xl">
            <div class="w-full md:w-1/2 bg-image"></div>
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-2xl font-bold mb-2 text-gray-800">Register</h2>
                <p class="text-gray-600 mb-6">Buat Akun Baru Untuk Login</p>

                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    @foreach ($errors->all() as $error)
                    <span class="block sm:inline">{{ $error }}</span>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4 floating-label-group">
                        <input type="username" id="username" name="username" value="{{ old('username') }}" required class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" ">
                        <label for="username" class="floating-label text-gray-500">Username</label>
                    </div>

                    <div class="mb-4 floating-label-group">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" ">
                        <label for="email" class="floating-label text-gray-500">Email</label>
                    </div>

                    <div class="mb-6 floating-label-group">
                        <input type="password" name="password" id="password" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 " placeholder=" " required>
                        <label for="password" class="floating-label text-gray-500">Password</label>
                        <div class="password-toggle-icon" onclick="togglePasswordVisibility()">
                        <i class="ri-eye-line"></i>
                        </div>
                    </div>

                    <div class="mb-6 floating-label-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" ">
                        <label for="password_confirmation" class="floating-label text-gray-500">Confirm Password</label>
                        <div class="confirm-password-toggle-icon" onclick="toggleConfirmPasswordVisibility()">
                        <i class="ri-eye-line"></i>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
                </form>

                <div class="mt-4 text-center">
                    <span class="text-gray-600">OR</span>
                </div>
                <p class="mt-4 text-center text-gray-600">Sudah Punya Akun? <a href="{{ route('login') }}" class="text-blue-500">Login Disini</a></p>
            </div>
        </div>
    </div>
    <footer class="footer">
        @include('partials.copyright')
    </footer>
</body>

</html>