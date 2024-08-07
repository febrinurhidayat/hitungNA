<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Gaya umum untuk tautan */
        .nav-link {
            position: relative;
            text-decoration: none;
            color: #000000;
            padding: 0.5em;
            transition: color 0.3s, border-color 0.3s;
        }

        /* Garis bawah saat kursor diarahkan ke tautan */
        .nav-link:hover::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #3b82f6;
            transition: height 0.3s;
        }

        /* Garis bawah untuk tautan yang aktif */
        .nav-link.active-link::after {
            transition: width 0.3s ease;
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #3b82f6;
            transition: height 0.3s;
        }

        /* Container untuk menyesuaikan posisi garis bawah */
        .nav-link {
            display: inline-block;
            position: relative;
            padding-bottom: 4px;
        }

        /* Menampilkan tombol hamburger di perangkat desktop */
        @media (min-width: 768px) {
            .hamburger-menu {
                display: flex;
            }

            #mobile-menu {
                display: none;
            }

            #desktop-menu {
                display: flex;
            }
        }
        .download{
            font-size: 24px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- dekstop -->
    <nav class="bg-gray-100 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10">
                </a>
                <a href="/home" class="text-blue-500 text-lg font-bold ml-2">EBRI</a>
            </div>
            <div id="desktop-menu" class="hidden md:flex space-x-4 items-center">
                <a href="/home" class="nav-link px-3 py-2 rounded-md text-sm font-medium {{ request()->path() == 'home' ? 'active-link' : '' }}">Hitung Nilai Akhir</a>
                <a href="/result" class="nav-link px-3 py-2 rounded-md text-sm font-medium {{ request()->path() == 'result' ? 'active-link' : '' }}">History</a>
                <div class="relative">
                    <button onclick="toggleDropdown('desktop-profile-dropdown')" class="nav-link px-3 py-2 rounded-md text-sm font-medium focus:outline-none capitalize ">
                        {{ old('username', Auth::user()->username) }} 
                        <i class="ri-arrow-drop-down-fill download"></i>    
                    </button>
                    <div id="desktop-profile-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1">
                            <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm font-medium  text-gray-700 hover:bg-gray-100 flex items-center">
                                <svg class="h-5 w-5 text-blue-500 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Setting
                            </a>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 flex items-center">
                                <svg class="h-5 w-5 text-blue-500 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                </svg>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:hidden">
                <button id="menu-toggle" class="text-black focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- mobile -->
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="/home" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->path() == 'home' ? 'active-link' : '' }}">Hitung Nilai Akhir</a>
            <a href="/result" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->path() == 'result' ? 'active-link' : '' }}">History</a>
            <div class="relative">
                <button onclick="toggleDropdown('mobile-profile-dropdown')" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium focus:outline-none">
                    {{ old('username', Auth::user()->username) }}
                    <i class="ri-arrow-drop-down-fill download"></i>
                </button>
                <div id="mobile-profile-dropdown" class="hidden mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1">
                        <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm font-medium  text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg class="h-5 w-5 text-blue-500 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Setting
                        </a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg class="h-5 w-5 text-blue-500 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        // Menambahkan klik di luar untuk menutup menu dropdown
        window.addEventListener('click', function(e) {
            const desktopDropdown = document.getElementById('desktop-profile-dropdown');
            const mobileDropdown = document.getElementById('mobile-profile-dropdown');
            const profileButtonDesktop = document.querySelector('#desktop-menu button[onclick="toggleDropdown(\'desktop-profile-dropdown\')"]');
            const profileButtonMobile = document.querySelector('#mobile-menu button[onclick="toggleDropdown(\'mobile-profile-dropdown\')"]');

            if (!desktopDropdown.contains(e.target) && !profileButtonDesktop.contains(e.target)) {
                desktopDropdown.classList.add('hidden');
            }
            if (!mobileDropdown.contains(e.target) && !profileButtonMobile.contains(e.target)) {
                mobileDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>