<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    // Menampilkan form penghitungan nilai akhir
    public function showHitungNaForm()
    {
        return view('hitung_na');
    }

    // Proses penghitungan nilai akhir
    public function hitungNa(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string',
            'smtr' => 'required|integer|min:1',
            'matkul' => 'required|string',
            'absen' => 'required|numeric|min:0',
            'tugas' => 'required|numeric|min:0',
            'uts' => 'required|numeric|min:0',
            'uas' => 'required|numeric|min:0',
            'bobot_absen' => 'required|numeric|min:0',
            'bobot_tugas' => 'required|numeric|min:0',
            'bobot_uts' => 'required|numeric|min:0',
            'bobot_uas' => 'required|numeric|min:0',
        ]);

        // Hitung nilai akhir (NA)
        $na = ($validated['absen'] * ($validated['bobot_absen'] / 100))
            + ($validated['tugas'] * ($validated['bobot_tugas'] / 100))
            + ($validated['uts'] * ($validated['bobot_uts'] / 100))
            + ($validated['uas'] * ($validated['bobot_uas'] / 100));

        // Tentukan grade
        if ($na >= 85) {
            $grade = 'A';
        } elseif ($na >= 80) {
            $grade = 'A-';
        } elseif ($na >= 75) {
            $grade = 'B+';
        } elseif ($na >= 70) {
            $grade = 'B';
        } elseif ($na >= 65) {
            $grade = 'B-';
        } elseif ($na >= 60) {
            $grade = 'C+';
        } elseif ($na >= 55) {
            $grade = 'C';
        } elseif ($na >= 50) {
            $grade = 'C-';
        } elseif ($na >= 45) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        // Simpan data ke database
        $nilai = new Nilai();
        $nilai->nama = $validated['nama'];
        $nilai->nim = $validated['nim'];
        $nilai->smtr = $validated['smtr'];
        $nilai->matkul = $validated['matkul'];
        $nilai->absen = $validated['absen'];
        $nilai->tugas = $validated['tugas'];
        $nilai->uts = $validated['uts'];
        $nilai->uas = $validated['uas'];
        $nilai->bobot_absen = $validated['bobot_absen'] / 100;
        $nilai->bobot_tugas = $validated['bobot_tugas'] / 100;
        $nilai->bobot_uts = $validated['bobot_uts'] / 100;
        $nilai->bobot_uas = $validated['bobot_uas'] / 100;
        $nilai->na = $na;
        $nilai->grade = $grade;
        $nilai->user_id = Auth::id(); // Set user_id dengan ID user yang sedang login
        $nilai->save();

        return redirect()->route('result')->with('success', 'Data nilai berhasil disimpan.');
    }

    // Menampilkan hasil perhitungan nilai
    public function showResult()
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $history = Nilai::where('user_id', $userId)->get(); // Ambil data nilai milik pengguna ini

        return view('result', compact('history'));
    }

    // Mencari hasil berdasarkan nama
    public function search(Request $request)
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $query = $request->input('query');
        $history = Nilai::where('user_id', $userId)
            ->where('nama', 'like', '%' . $query . '%')
            ->get();

        return view('result', compact('history'));
    }

    //MengEdit data nilai
    public function edit($id)
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $nilai = Nilai::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail(); // Pastikan data milik pengguna ini

        return view('edit', compact('nilai'));
    }

    // Memperbarui data nilai
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'absen' => 'required|numeric|min:0',
            'tugas' => 'required|numeric|min:0',
            'uts' => 'required|numeric|min:0',
            'uas' => 'required|numeric|min:0',
            'bobot_absen' => 'required|numeric|min:0',
            'bobot_tugas' => 'required|numeric|min:0',
            'bobot_uts' => 'required|numeric|min:0',
            'bobot_uas' => 'required|numeric|min:0',
        ]);

        // Temukan data berdasarkan ID
        $nilai = Nilai::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail(); // Pastikan data milik pengguna ini

        // Hitung nilai akhir (NA)
        $na = ($validated['absen'] * ($validated['bobot_absen'] / 100))
            + ($validated['tugas'] * ($validated['bobot_tugas'] / 100))
            + ($validated['uts'] * ($validated['bobot_uts'] / 100))
            + ($validated['uas'] * ($validated['bobot_uas'] / 100));

        // Tentukan grade
        if ($na >= 85) {
            $grade = 'A';
        } elseif ($na >= 80) {
            $grade = 'A-';
        } elseif ($na >= 75) {
            $grade = 'B+';
        } elseif ($na >= 70) {
            $grade = 'B';
        } elseif ($na >= 65) {
            $grade = 'B-';
        } elseif ($na >= 60) {
            $grade = 'C+';
        } elseif ($na >= 55) {
            $grade = 'C';
        } elseif ($na >= 50) {
            $grade = 'C-';
        } elseif ($na >= 45) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        // Perbarui data
        $nilai->absen = $validated['absen'];
        $nilai->tugas = $validated['tugas'];
        $nilai->uts = $validated['uts'];
        $nilai->uas = $validated['uas'];
        $nilai->bobot_absen = $validated['bobot_absen'] / 100;
        $nilai->bobot_tugas = $validated['bobot_tugas'] / 100;
        $nilai->bobot_uts = $validated['bobot_uts'] / 100;
        $nilai->bobot_uas = $validated['bobot_uas'] / 100;
        $nilai->na = $na;
        $nilai->grade = $grade;
        $nilai->save();

        return redirect()->route('result')->with('success', 'Data nilai berhasil diperbarui.');
    }

    // Menghapus data nilai
    public function hapus($nilai_id)
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $nilai = Nilai::where('id', $nilai_id)
            ->where('user_id', $userId)
            ->firstOrFail(); // Pastikan data milik pengguna ini

        $nilai->delete();

        return redirect()->back()->with('success', 'Data nilai berhasil dihapus.');
    }
    //shows data

}
