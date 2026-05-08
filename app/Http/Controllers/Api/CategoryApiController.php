<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    // GET: Menampilkan semua kategori
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'message' => 'Berhasil mengambil semua data kategori',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error get categories API: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    // POST: Menyimpan data kategori
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            $category = Category::create($validated);

            Log::info('Menambah data kategori', [
                'category' => $category
            ]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!!',
                'data' => $category,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah kategori', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal menambah kategori'], 500);
        }
    }

    // GET: Menampilkan data by ID
    public function show(int $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Kategori berhasil diambil',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal mengambil data kategori'], 500);
        }
    }

    // PUT/PATCH: Mengupdate kategori
    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $id,
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diupdate!',
                'data' => $category
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Error update category API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengupdate kategori'], 500);
        }
    }

    // DELETE: Menghapus kategori
    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            // Check if category has products
            if ($category->products()->count() > 0) {
                return response()->json([
                    'message' => 'Kategori tidak dapat dihapus karena masih memiliki produk terkait'
                ], 400);
            }

            $category->delete();

            return response()->json([
                'message' => 'Kategori berhasil dihapus!'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error delete category API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus kategori'], 500);
        }
    }
}
