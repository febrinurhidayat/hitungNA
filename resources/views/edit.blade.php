<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nilai</title>
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
    </style>
</head>
@include('partials.navbar')

<body class="bg-gray-100">
    <div class="container mx-auto p-4 flex justify-center">
        <div class="w-full max-w-2xl">
            <h1 class="text-2xl font-bold mb-6 text-center">Edit Nilai</h1>
            <form action="{{ route('nilai.update', ['id' => $nilai->id]) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                @csrf
                @method('PUT')

                <!-- Floating Labels -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="floating-label-group">
                        <input type="number" id="absen" name="absen" value="{{ old('absen', $nilai->absen) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="absen" class="floating-label">Nilai Absen</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="tugas" name="tugas" value="{{ old('tugas', $nilai->tugas) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="tugas" class="floating-label">Nilai Tugas</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="uts" name="uts" value="{{ old('uts', $nilai->uts) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="uts" class="floating-label">Nilai UTS</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="uas" name="uas" value="{{ old('uas', $nilai->uas) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="uas" class="floating-label">Nilai UAS</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="bobot_absen" name="bobot_absen" value="{{ old('bobot_absen', $nilai->bobot_absen * 100) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="bobot_absen" class="floating-label">Bobot Absen (%)</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="bobot_tugas" name="bobot_tugas" value="{{ old('bobot_tugas', $nilai->bobot_tugas * 100) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="bobot_tugas" class="floating-label">Bobot Tugas (%)</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="bobot_uts" name="bobot_uts" value="{{ old('bobot_uts', $nilai->bobot_uts * 100) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="bobot_uts" class="floating-label">Bobot UTS (%)</label>
                    </div>

                    <div class="floating-label-group">
                        <input type="number" id="bobot_uas" name="bobot_uas" value="{{ old('bobot_uas', $nilai->bobot_uas * 100) }}" step="0.01" min="0" required class="floating-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder=" ">
                        <label for="bobot_uas" class="floating-label">Bobot UAS (%)</label>
                    </div>
                </div>
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>