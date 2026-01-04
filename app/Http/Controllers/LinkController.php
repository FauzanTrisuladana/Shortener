<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;
use App\Http\Controllers\VisitorController;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $query = Link::where('id_user', auth()->id());

        // Search by name, custom alias, or original URL
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('new_link', 'like', "%{$search}%")
                  ->orWhere('true_link', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->get('status') !== 'all') {
            if ($request->get('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->get('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $links = $query->orderBy('created_at', 'desc')->get();
        return view('links', compact('links'));
    }

    public function analytics($id)
    {
        // TODO: tampilkan analytics untuk link tertentu
        return view('link-analytics', compact('id'));
    }

    public function shorten(Request $request)
    {
        try {
            $link = $request->validate([
                'target_url' => 'required|url',
                'custom_alias' => 'nullable|alpha_dash|unique:links,new_link',
            ], [
                'target_url.required' => 'URL tujuan wajib diisi.',
                'target_url.url' => 'Format URL tujuan tidak valid.',
                'custom_alias.alpha_dash' => 'Alias khusus hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
                'custom_alias.unique' => 'Alias khusus sudah digunakan. Silakan pilih yang lain.',
            ]);

            $result = self::storeshorten(
                $link['target_url'],
                $link['custom_alias'] ?? null,
            );

            if (!$result['success']) {
                throw new \Exception('Gagal memperpendek URL.');
            }

            return redirect()->route('home')->with('success', 'URL berhasil diperpendek!')->with('short_url', $result['short_url']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('home')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['form' => "Terjadi kesalahan: " . $e->getMessage() . ". Silakan coba lagi."])->withInput();
        }
    }

    public function shortenwaccount(Request $request)
    {
        try {
            $link = $request->validate([
                'target_url' => 'required|url',
                'custom_alias' => 'nullable|alpha_dash|unique:links,new_link',
                'name' => 'required|string|max:255',
                'is_active' => 'nullable|boolean',
            ], [
                'target_url.required' => 'URL tujuan wajib diisi.',
                'target_url.url' => 'Format URL tujuan tidak valid.',
                'custom_alias.alpha_dash' => 'Alias khusus hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
                'custom_alias.unique' => 'Alias khusus sudah digunakan. Silakan pilih yang lain.',
                'name.required' => 'Nama link wajib diisi.',
                'name.string' => 'Nama link harus berupa teks.',
                'name.max' => 'Nama link maksimal 255 karakter.',
                'is_active.boolean' => 'Status link tidak valid.',
            ]);

            $userId = auth()->check() ? auth()->id() : null;

            $result = self::storeshorten(
                $link['target_url'],
                $link['custom_alias'] ?? null,
                $link['is_active'] ?? false,
                $link['name'],
                $userId
            );

            if (!$result['success']) {
                throw new \Exception('Gagal memperpendek URL.');
            }

            return back()->with('success', 'URL berhasil diperpendek!')->with('short_url', $result['short_url']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors(), 'new')->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['form' => "Terjadi kesalahan: " . $e->getMessage() . ". Silakan coba lagi."], 'new')->withInput();
        }
    }

    public static function storeshorten($true_link, $new_link=null, $is_active=true, $name=null, $id_user=null)
    {
        try {
            $new_link = $new_link ?? Str::random(6);
            while (Link::where('new_link', $new_link)->exists()) {
                $new_link = Str::random(6);
            }
            Link::create([
                'id_user' => $id_user,
                'name' => $name ?? 'Guest Link',
                'true_link' => $true_link,
                'new_link' => $new_link,
                'is_active' => $is_active,
            ]);
            return [
                'short_url' => url('/' . $new_link),
                'success' => true,
            ];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'target_url' => 'required|url',
                'custom_alias' => 'required|alpha_dash|unique:links,new_link,' . $id . ',id_link',
                'name' => 'required|string|max:255',
                'is_active' => 'nullable|boolean',
            ], [
                'target_url.required' => 'URL tujuan wajib diisi.',
                'target_url.url' => 'Format URL tujuan tidak valid.',
                'custom_alias.required' => 'Alias wajib diisi.',
                'custom_alias.alpha_dash' => 'Alias khusus hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
                'custom_alias.unique' => 'Alias khusus sudah digunakan. Silakan pilih yang lain.',
                'name.required' => 'Nama link wajib diisi.',
                'name.string' => 'Nama link harus berupa teks.',
                'name.max' => 'Nama link maksimal 255 karakter.',
                'is_active.boolean' => 'Status link tidak valid.',
            ]);

            $existingLink = Link::where('id_link', $id)
                ->where('id_user', auth()->id())
                ->firstOrFail();

            $existingLink->true_link = $validated['target_url'];
            $existingLink->new_link = $validated['custom_alias'];
            $existingLink->name = $validated['name'];
            $existingLink->is_active = $validated['is_active'] ?? false;
            $existingLink->save();

            return back()->with('success', 'Link berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('id', $id)->withErrors($e->errors(), 'edit');
        } catch (\Exception $e) {
            return back()->with('id', $id)->withErrors(['form' => "Terjadi kesalahan: " . $e->getMessage() . ". Silakan coba lagi."], 'edit');
        }
    }

    public function destroy($id)
    {
        try {
            $link = Link::where('id_link', $id)
                ->where('id_user', auth()->id())
                ->firstOrFail();


            // Soft delete
            $link->delete();

            return back()->with('success', 'Link berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['delete' => "Terjadi kesalahan: " . $e->getMessage() . ". Silakan coba lagi."]);
        }
    }

    public function redirect(Request $request, $new_link)
    {
        try {
            $link = Link::where('new_link', $new_link)
                ->where('is_active', true)
                ->firstOrFail();

            // Log visitor info
            VisitorController::logVisitor($request, $link->id_link);

            return redirect()->away($link->true_link);
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['form' => "Link tidak ditemukan atau tidak aktif."]);
        }
    }
}
