<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@Permanah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Petugas
        User::create([
            'name' => 'Petugas Staf',
            'email' => 'staf@permanah.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Petugas 2',
            'email' => 'petugas2@bookhive.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'phone' => '081234567891',
        ]);

        // Create Anggota
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Anggota ' . $i,
                'email' => 'anggota' . $i . '@bookhive.com',
                'password' => Hash::make('password'),
                'role' => 'anggota',
                'phone' => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'address' => 'Jl. Contoh No. ' . $i . ', Jakarta',
                'membership_date' => now()->subDays(rand(1, 365)),
                'status' => 'active', // Default active
            ]);
        }

        // Create Pending Anggota
        for ($i = 11; $i <= 13; $i++) {
            User::create([
                'name' => 'Anggota Pending ' . $i,
                'email' => 'anggota' . $i . '@bookhive.com',
                'password' => Hash::make('password'),
                'role' => 'anggota',
                'phone' => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'address' => 'Jl. Menunggu No. ' . $i . ', Jakarta',
                'status' => 'pending',
            ]);
        }

        // Create Books
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'isbn' => '978-979-3062-79-2',
                'publisher' => 'Bentang Pustaka',
                'year' => 2005,
                'stock' => 5,
                'available' => 5,
                'category' => 'Fiksi',
                'description' => 'Novel tentang kehidupan anak-anak di Belitung yang berjuang untuk mendapatkan pendidikan.',
                'cover_image' => 'images/books/laskar-pelangi.jpg',
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'isbn' => '978-602-03-0000-1',
                'publisher' => 'Lentera Dipantara',
                'year' => 1980,
                'stock' => 3,
                'available' => 3,
                'category' => 'Sejarah',
                'description' => 'Novel sejarah yang menceritakan kehidupan di Indonesia pada masa kolonial.',
                'cover_image' => 'images/books/bumi-manusia.jpg',
            ],
            [
                'title' => 'Sang Pemimpi',
                'author' => 'Andrea Hirata',
                'isbn' => '978-979-22-3280-0',
                'publisher' => 'Bentang Pustaka',
                'year' => 2006,
                'stock' => 4,
                'available' => 4,
                'category' => 'Fiksi',
                'description' => 'Kelanjutan dari Laskar Pelangi tentang perjuangan mengejar mimpi.',
                'cover_image' => 'images/books/sang-pemimpi.jpg',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '978-602-06-3096-7',
                'publisher' => 'Gramedia',
                'year' => 2018,
                'stock' => 6,
                'available' => 6,
                'category' => 'Pendidikan',
                'description' => 'Buku self-improvement tentang cara membentuk kebiasaan baik dan menghilangkan kebiasaan buruk.',
                'cover_image' => 'images/books/atomic-habits.jpg',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-602-03-2287-3',
                'publisher' => 'KPG',
                'year' => 2011,
                'stock' => 4,
                'available' => 4,
                'category' => 'Sejarah',
                'description' => 'Sejarah singkat tentang evolusi dan perkembangan manusia.',
                'cover_image' => 'images/books/sapiens.jpg',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0-13-235088-4',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'stock' => 3,
                'available' => 3,
                'category' => 'Teknologi',
                'description' => 'Panduan menulis kode yang bersih dan mudah dipelihara.',
                'cover_image' => 'images/books/clean-code.jpg',
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'isbn' => '978-602-250-088-0',
                'publisher' => 'Bentang Pustaka',
                'year' => 2010,
                'stock' => 5,
                'available' => 5,
                'category' => 'Non-Fiksi',
                'description' => 'Traktat militer kuno dari Tiongkok tentang strategi perang.',
                'cover_image' => 'images/books/art-of-war.jpg',
            ],
            [
                'title' => 'Harry Potter dan Batu Bertuah',
                'author' => 'J.K. Rowling',
                'isbn' => '978-602-020-284-8',
                'publisher' => 'Gramedia Pustaka Utama',
                'year' => 2000,
                'stock' => 8,
                'available' => 8,
                'category' => 'Fiksi',
                'description' => 'Petualangan seorang penyihir muda bernama Harry Potter.',
                'cover_image' => 'images/books/harry-potter.jpg',
            ],
            [
                'title' => 'Educated',
                'author' => 'Tara Westover',
                'isbn' => '978-602-06-2884-1',
                'publisher' => 'Gramedia',
                'year' => 2018,
                'stock' => 4,
                'available' => 4,
                'category' => 'Biografi',
                'description' => 'Memoir tentang seorang wanita yang tumbuh dalam keluarga survivalis dan mencari pendidikan.',
                'cover_image' => 'images/books/educated.jpg',
            ],
            [
                'title' => 'Dunia Sophie',
                'author' => 'Jostein Gaarder',
                'isbn' => '978-979-655-068-0',
                'publisher' => 'Mizan',
                'year' => 1991,
                'stock' => 3,
                'available' => 3,
                'category' => 'Pendidikan',
                'description' => 'Novel filosofis tentang sejarah filsafat.',
                'cover_image' => 'images/books/dunia-sophie.jpg',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Create Announcements
        Announcement::create([
            'title' => 'Selamat Datang di BookHive!',
            'content' => 'Perpustakaan Digital BookHive hadir untuk memberikan akses mudah ke ribuan koleksi buku. Daftar sekarang dan nikmati kemudahan meminjam buku secara digital!',
            'created_by' => 2,
            'is_active' => true,
        ]);

        Announcement::create([
            'title' => 'Jam Operasional Perpustakaan',
            'content' => 'Perpustakaan buka Senin - Jumat pukul 08.00 - 16.00 WIB. Sabtu-Minggu dan hari libur nasional tutup.',
            'created_by' => 2,
            'is_active' => true,
        ]);

        Announcement::create([
            'title' => 'Koleksi Buku Baru Telah Tiba!',
            'content' => 'Kami telah menambahkan 10 judul buku baru dalam berbagai kategori. Segera cek katalog buku kami!',
            'created_by' => 3,
            'is_active' => true,
        ]);

        // Create Some Borrowings
        $anggotaIds = User::where('role', 'anggota')->pluck('id');
        $bookIds = Book::pluck('id');

        // Approved borrowings
        for ($i = 0; $i < 5; $i++) {
            $book = Book::find($bookIds->random());
            if ($book->available > 0) {
                Borrowing::create([
                    'user_id' => $anggotaIds->random(),
                    'book_id' => $book->id,
                    'borrow_date' => now()->subDays(rand(1, 15)),
                    'due_date' => now()->addDays(rand(5, 20)),
                    'status' => 'approved',
                    'processed_by' => 2,
                ]);
                $book->decrement('available');
            }
        }

        // Pending borrowings
        for ($i = 0; $i < 3; $i++) {
            Borrowing::create([
                'user_id' => $anggotaIds->random(),
                'book_id' => $bookIds->random(),
                'borrow_date' => now(),
                'due_date' => now()->addDays(rand(7, 14)),
                'status' => 'pending',
                'terms_accepted' => true,
                'notified_at' => now()->subMinutes(rand(5, 120)), // Random notification time
            ]);
        }

        // Returned borrowings
        for ($i = 0; $i < 8; $i++) {
            Borrowing::create([
                'user_id' => $anggotaIds->random(),
                'book_id' => $bookIds->random(),
                'borrow_date' => now()->subDays(rand(20, 60)),
                'due_date' => now()->subDays(rand(10, 50)),
                'return_date' => now()->subDays(rand(1, 40)),
                'status' => 'returned',
                'processed_by' => 2,
            ]);
        }
    }
}
