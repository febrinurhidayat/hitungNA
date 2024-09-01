<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menghitung Nilai Akhir</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

        .hidden {
            display: none;
        }

        /* Menghilangkan spinner di Chrome, Safari, Edge, dan Opera */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Menghilangkan spinner di Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    <script>
        function showStep(step) {
            document.querySelectorAll('[id^=step]').forEach(el => el.classList.add('hidden'));
            document.getElementById(step).classList.remove('hidden');
        }

        function toUpperCaseInput(element) {
            element.value = element.value.toUpperCase();
        }
    </script>
</head>
@include('partials.navbar')

<body class="bg-gray-100">
    <div class="container mx-auto p-4 flex justify-center">
        <div class="w-full max-w-sm">
            <h1 class="text-2xl font-bold mb-6 text-center">Program Menghitung Nilai Akhir</h1>
            <form action="{{ route('hitung_na') }}" method="post" class="bg-white p-6 rounded shadow-md">

                @csrf

                <!-- Step 1 -->
                <div id="step1">
                    <div class="floating-label-group">
                        <input type="text" name="nama" id="nama"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " oninput="toUpperCaseInput(this)" required aria-label="Nama">
                        <label for="nama" class="floating-label text-gray-700">Nama</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" name="nim" id="nim"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " oninput="toUpperCaseInput(this)" required aria-label="NIM">
                        <label for="nim" class="floating-label text-gray-700">NIM</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" name="matkul" id="matkul"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " oninput="toUpperCaseInput(this)" required aria-label="Mata Kuliah">
                        <label for="matkul" class="floating-label text-gray-700">Mata Kuliah</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="1" min="1" name="smtr" id="smtr"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Semester">
                        <label for="smtr" class="floating-label text-gray-700">Semester</label>
                    </div>
                    <div class="mb-4">
                        <button type="button" onclick="showStep('step2')"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md">Lanjut</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step2" class="hidden">
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="bobot_absen" id="bobot_absen"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Bobot Absen">
                        <label for="bobot_absen" class="floating-label text-gray-700">Bobot Absen %</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="bobot_tugas" id="bobot_tugas"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Bobot Tugas">
                        <label for="bobot_tugas" class="floating-label text-gray-700">Bobot Tugas %</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="bobot_uts" id="bobot_uts"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Bobot UTS">
                        <label for="bobot_uts" class="floating-label text-gray-700">Bobot UTS %</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="bobot_uas" id="bobot_uas"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Bobot UAS">
                        <label for="bobot_uas" class="floating-label text-gray-700">Bobot UAS %</label>
                    </div>
                    <div class="mb-4">
                        <button type="button" onclick="showStep('step1')"
                            class="w-full bg-gray-500 text-white py-2 px-4 rounded-md">Kembali</button>
                        <button type="button" onclick="showStep('step3')"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md mt-2">Lanjut</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step3" class="hidden">
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="absen" id="absen"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Nilai Absen">
                        <label for="absen" class="floating-label text-gray-700">Nilai Absen</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="tugas" id="tugas"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Nilai Tugas">
                        <label for="tugas" class="floating-label text-gray-700">Nilai Tugas</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="uts" id="uts"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Nilai UTS">
                        <label for="uts" class="floating-label text-gray-700">Nilai UTS</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="number" step="0.01" min="0" name="uas" id="uas"
                            class="floating-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder=" " required aria-label="Nilai UAS">
                        <label for="uas" class="floating-label text-gray-700">Nilai UAS</label>
                    </div>
                    <div class="mb-4">
                        <button type="button" onclick="showStep('step2')"
                            class="w-full bg-gray-500 text-white py-2 px-4 rounded-md">Kembali</button>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md mt-2">Selesai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>