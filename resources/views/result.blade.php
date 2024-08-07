<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Nilai Akhir</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/remixicon@2.5.0/fonts/remixicon.css">
</head>

<body class="bg-gray-100">
    @include('partials.navbar') <!-- Include navbar jika sudah dibuat -->

    <div class="container mx-auto mt-4 p-4 max-w-4xl">
        <h1 class="text-2xl font-bold mb-4 text-center">Hasil Perhitungan Nilai Akhir</h1>

        <!-- Pencarian dan Tombol Hitung Lagi -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div class="flex flex-col md:flex-row">
                <!-- Tombol Hitung Lagi -->
                <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mb-4 md:mb-0 text-center">
                    Hitung lagi
                </a>
            </div>
            <!-- Form Pencarian -->
            <form action="{{ route('search') }}" method="GET" class="flex items-center w-full md:w-auto">
                <input type="text" name="query" placeholder="Cari Nama..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md ml-2">
                    Cari
                </button>
            </form>
        </div>

        <!-- Tabel Hasil -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="w-full bg-gray-900 text-left border-b border-gray-300 text-center">
                        <th class="py-1 px-4 text-white">Nama</th>
                        <th class="py-1 px-4 text-white">NIM</th>
                        <th class="py-1 px-4 text-white">Semester</th>
                        <th class="py-1 px-4 text-white">Mata Kuliah</th>
                        <th class="py-1 px-4 text-white">Nilai Akhir</th>
                        <th class="py-1 px-4 text-white">Grade</th>
                        <th class="py-1 px-4 text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $result)
                    <tr class="border-b border-gray-300 text-center">
                        <td class="py-1 px-4">{{ $result->nama }}</td>
                        <td class="py-1 px-4">{{ $result->nim }}</td>
                        <td class="py-1 px-4">{{ $result->smtr }}</td>
                        <td class="py-1 px-4">{{ $result->matkul }}</td>
                        <td class="py-1 px-4">{{ number_format($result->na, 2) }}</td>
                        <td class="py-1 px-4">{{ $result->grade }}</td>
                        <td class="py-1 px-4 flex justify-between">
                            <!-- Formulir ini digunakan untuk mengarahkan ke halaman edit -->
                            <form action="{{ route('nilai.edit', ['id' => $result->id]) }}" method="GET" class="flex items-center ml-1">
                                @csrf
                                <button type="submit" class="py-1">
                                    <svg class="text-blue-500" viewBox="0 0 24 24" width="20" height="20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                        <line x1="16" y1="5" x2="19" y2="8" />
                                    </svg>
                                </button>
                            </form>
                            <p>||</p>
                            <!-- hapus -->
                            <form action="{{ route('hapus', ['nilai_id' => $result->id]) }}" method="POST" class="flex items-center" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-1" style="color: red;">
                                    <svg class="text-red-500" viewBox="0 0 24 24" width="20" height="20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>