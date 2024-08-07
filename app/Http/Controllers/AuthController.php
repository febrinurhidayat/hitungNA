<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kirimkan email verifikasi
        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silahkan cek email untuk verifikasi.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Email atau Password salah');
        }
    }

    // Menampilkan form permintaan reset password
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    // Mengirimkan email reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', __($response))
            : back()->withErrors(['email' => __($response)]);
    }

    // Menampilkan form reset password
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->query('email')]);
    }

    // Memperbarui password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($response));
        } else {
            return back()->withErrors(['email' => [__($response)]]);
        }
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password', 'token');
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }

    public function home()
    {
        return view('home'); // Pastikan view home ada dan sesuai
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showSettingsForm()
    {
        $user = Auth::user();
        return view('settings', ['user' => $user]);
    }


    public function updateSettings(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|max:2048',
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Update data lainnya
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        // Update password jika diinputkan dan sesuai validasi
        if ($request->filled('password')) {
            // Validasi sandi saat ini
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }

            // Ubah sandi pengguna
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan pengguna
        $user->save();

        return redirect()->route('settings')->with('success', 'Settings updated successfully.');
    }

    // Metode untuk menampilkan form konfirmasi penghapusan akun
    public function showDeleteAccountForm()
    {
        return view('settings');
    }

    // Metode untuk menangani penghapusan akun
    public function deleteAccount(Request $request)
    {
        // Validasi input
        $request->validate([
            'password' => 'required|string',
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah password yang diberikan cocok
        if (!Hash::check($request->input('password'), $user->password)) {
            // Jika password tidak cocok, kembali ke halaman formulir dengan pesan kesalahan
            return redirect()->route('delete-account-form')->withErrors(['password' => 'Password tidak cocok.']);
        }

        // Menghapus akun dari database dalam transaksi
        DB::transaction(function () use ($user) {
            $user->delete(); // Menghapus pengguna
        });

        // Logout pengguna setelah penghapusan
        Auth::logout();

        // Redirect ke halaman utama atau halaman yang sesuai
        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
