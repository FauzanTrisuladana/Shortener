<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $user->id_user . ',id_user',
            ], [
                'name.required' => 'Nama wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan pengguna lain.',
            ]);

            $user->update($validated);
            return back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['form' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = auth()->user();

            $rules = [
                'newPassword' => 'required|string|min:8|confirmed',
            ];

            $messages = [
                'newPassword.required' => 'Kata sandi baru wajib diisi.',
                'newPassword.min' => 'Kata sandi minimal 8 karakter.',
                'newPassword.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
            ];

            // Jika user sudah punya password, harus verifikasi password lama
            if ($user->password) {
                $rules['currentPassword'] = 'required|string';
                $messages['currentPassword.required'] = 'Kata sandi saat ini wajib diisi.';
            }

            $validated = $request->validate($rules, $messages);

            // Verifikasi password lama jika user punya password
            if ($user->password && !Hash::check($request->currentPassword, $user->password)) {
                return back()->withErrors(['currentPassword' => 'Kata sandi saat ini tidak sesuai.']);
            }

            $user->update(['password' => bcrypt($validated['newPassword'])]);
            return back()->with('success', 'Kata sandi berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['form' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = auth()->user();

            $request->validate([
                'confirm' => 'required|accepted',
            ], [
                'confirm.required' => 'Anda harus mengkonfirmasi penghapusan akun.',
                'confirm.accepted' => 'Anda harus mengkonfirmasi penghapusan akun.',
            ]);

            auth()->logout();
            $user->delete();

            return redirect('/login')->with('success', 'Akun berhasil dihapus permanen.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['form' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function uploadPhoto(Request $request)
    {
        try {
            $user = auth()->user();

            $validated = $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
            ], [
                'profile_image.required' => 'Foto wajib dipilih.',
                'profile_image.image' => 'File harus berupa gambar.',
                'profile_image.mimes' => 'Format gambar harus JPG, PNG, atau GIF.',
                'profile_image.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            // Delete old photo if exists
            if ($user->profile_image && !Str::startsWith($user->profile_image, ['http://', 'https://'])) {
                $oldPath = public_path($user->profile_image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Store new photo
            $path = $request->file('profile_image')->store('profile-photos', 'public');
            $user->update(['profile_image' => '/storage/' . $path]);

            return back()->with('success', 'Foto profil berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['form' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
