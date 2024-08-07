<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/remixicon@2.5.0/fonts/remixicon.css">
    <style>
        .floating-label-group {
            position: relative;
            margin-bottom: 16px;
        }

        .floating-label-group input,
        .floating-label-group label {
            transition: all 0.2s ease-in-out;
        }

        .floating-input {
            padding: 1.5em 0.75em 0.5em 0.75em;
            /* Adjust padding to ensure label position */
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }

        .floating-label {
            position: absolute;
            top: 50%;
            left: 0.75em;
            transform: translateY(-50%);
            transition: all 0.2s ease-in-out;
            font-size: 16px;
            color: #4a5568;
            background: white;
            padding: 0 0.25em;
            pointer-events: none;
        }

        .floating-input:focus~.floating-label,
        .floating-input:not(:placeholder-shown)~.floating-label {
            top: -2px;
            /* Adjust to fit the layout */
            left: 0.75em;
            font-size: 12px;
            color: #4a5568;
        }

        .password-toggle-icon,
        .confirm-password-toggle-icon {
            position: absolute;
            top: 10px;
            right: 0.75rem;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">
    @include('partials.navbar')
    <div class="container mx-auto p-4 flex justify-center">
        <div class="w-full max-w-sm">
            <h1 class="text-2xl font-bold mb-4 text-center">Setting Profil
                <p class="text-green-500 capitalize">{{ old('username', Auth::user()->username) }}</p>
            </h1>
            <form action="{{ route('update-settings') }}" method="POST" enctype="multipart/form-data" class="bg-white mb-4 p-4 rounded-lg shadow-md max-w-md mx-auto">
                <div class="container mx-auto p-4 justify-center">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 mb-4 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 mb-4 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @csrf

                    <!-- Email Input -->
                    <div class="floating-label-group">
                        <input type="email" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" " id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required readonly>
                        <label for="email" class="floating-label text-gray-500">Email</label>
                    </div>

                    <!-- Username Input -->
                    <div class="floating-label-group">
                        <input type="text" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" " id="username" name="username" value="{{ old('username', Auth::user()->username) }}" maxlength="20" required>
                        <label for="username" class="floating-label text-gray-500">Username</label>
                    </div>

                    <!-- Current Password Input -->
                    <div class="floating-label-group">
                        <input type="password" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" " id="current_password" name="current_password">
                        <label for="current_password" class="floating-label text-gray-500">Kata Sandi Saat Ini</label>
                    </div>

                    <!-- New Password Input -->
                    <div class="floating-label-group">
                        <input type="password" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" " id="password" name="password">
                        <label for="password" class="floating-label text-gray-500">Kata Sandi Baru</label>
                        <div class="password-toggle-icon" onclick="togglePasswordVisibility()">
                            <i class="ri-eye-line"></i>
                        </div>
                    </div>

                    <!-- Confirm New Password Input -->
                    <div class="floating-label-group">
                        <input type="password" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" " id="password_confirmation" name="password_confirmation">
                        <label for="password_confirmation" class="floating-label text-gray-500">Konfirmasi Password Baru</label>
                        <div class="confirm-password-toggle-icon" onclick="toggleConfirmPasswordVisibility()">
                            <i class="ri-eye-line"></i>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Perbarui Pengaturan</button>
                </div>
            </form>

            <!-- Form to Delete Account -->
            <div class="container mx-auto justify-center">
                <form action="{{ route('delete-account') }}" method="POST" class="bg-white mb-2 p-4 rounded-lg shadow-md max-w-md mx-auto">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-semibold mb-4">Hapus Akun Anda!</h2>

                    <!-- Password Input for Deleting Account -->
                    <div class="floating-label-group">
                        <input type="password" class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder=" " id="delete_password" name="password" required>
                        <label for="delete_password" class="floating-label text-gray-500">Kata Sandi Saat Ini</label>
                    </div>

                    <!-- Delete Account Button -->
                    <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">Hapus Akun</button>
                </form>
            </div>
        </div>
    </div>
</body>
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

</html>