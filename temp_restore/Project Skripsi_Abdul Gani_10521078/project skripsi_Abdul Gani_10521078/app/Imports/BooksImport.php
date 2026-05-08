<?php

namespace App\Imports;

use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $stock = $row['stok'] ?? $row['stock'] ?? 0;
        return new Book([
            'title' => $row['judul_buku'] ?? $row['title'] ?? '',
            'author' => $row['penulis'] ?? $row['author'] ?? '',
            'isbn' => $row['isbn'] ?? '',
            'publisher' => $row['penerbit'] ?? $row['publisher'] ?? '',
            'year' => $row['tahun'] ?? $row['year'] ?? '',
            'stock' => $stock,
            'available' => $stock,
            'category' => $row['kategori'] ?? $row['category'] ?? '',
            'description' => $row['deskripsi'] ?? $row['description'] ?? '',
            'cover_image' => 'covers/default.jpg', // Default image to prevent SQL error
        ]);
    }
}
