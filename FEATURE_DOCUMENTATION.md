# Dokumentasi Fitur: Account Verification System

## Ringkasan Fitur
Sistem verifikasi akun anggota yang baru mendaftar. Akun anggota tidak bisa login sampai disetujui oleh petugas. Petugas dapat menerima atau menolak permintaan pendaftaran dan mengirim email notifikasi otomatis.

---

## 1. SISTEM ANGGOTA (User)

### 1.1 Proses Pendaftaran
**File terlibat:**
- `app/Http/Controllers/AuthController.php` - Method `registerAnggota()`
- `resources/views/auth/anggota-register.blade.php`

**Alur:**
1. User mengisi form pendaftaran dengan data lengkap dan upload foto KTM
2. Sistem membuat akun baru dengan status `pending` 
3. User TIDAK langsung login
4. Redirect ke halaman login dengan pesan sukses dan modal notifikasi
5. Modal menampilkan bahwa akun sedang ditinjau petugas

**Validasi Input:**
- name: required, max 255
- nisn: required, max 20, unique
- email: required, unique
- password: required, min 8, confirmed
- phone: nullable
- address: nullable
- ktm_photo: required, image (jpg, jpeg, png), max 2MB

**Database:**
- Kolom baru di tabel `users`: 
  - `status` enum(pending, approved, rejected) - default: pending
  - `rejection_reason` text nullable
  - `rejection_date` timestamp nullable

### 1.2 Proses Login
**File terlibat:**
- `app/Http/Controllers/AuthController.php` - Method `loginAnggota()`
- `resources/views/auth/anggota-login.blade.php`

**Alur:**
1. User memasukkan email dan password
2. Sistem verifikasi kredensial
3. Jika status = pending:
   - Logout otomatis
   - Error: "Akun Anda masih dalam proses peninjauan. Silakan tunggu email konfirmasi dari petugas."
4. Jika status = rejected:
   - Logout otomatis
   - Error: "Akun Anda telah ditolak. Alasan: [alasan penolakan]"
5. Jika status = approved:
   - Login berhasil
   - Redirect ke dashboard anggota

### 1.3 Modal Notifikasi Pending
**File terlibat:**
- `resources/views/auth/anggota-login.blade.php`

**Fitur:**
- Modal bootstrap otomatis tampil saat register berhasil
- Menampilkan email yang terdaftar
- Menjelaskan proses verifikasi
- Info tunggu email konfirmasi dari petugas

---

## 2. SISTEM PETUGAS (Officer/Staff)

### 2.1 Dashboard Anggota Pending
**File terlibat:**
- `app/Http/Controllers/PetugasController.php` - Method `pendingUsers()`
- `resources/views/petugas/anggota/pending.blade.php`
- Route: `GET /petugas/anggota/pending` (nama: `petugas.anggota.pending`)

**Fitur:**
- Tabel daftar akun yang menunggu persetujuan
- Kolom: #, Nama, Email, NISN, No. Telepon, Tanggal Pendaftaran, Aksi
- Pagination (15 item per halaman)
- Filter search by nama atau email
- Badge menampilkan total akun pending

**Aksi per Anggota:**
1. **View Details** (button info)
   - Modal menampilkan semua info akun
   - Foto KTM dapat dilihat
   - Tanggal pendaftaran detail

2. **Approve** (button green)
   - Confirmation dialog
   - Update status menjadi `approved`
   - Kirim email otomatis ke user dengan:
     - Notifikasi akun disetujui
     - Detail login (email + temporary password)
     - Instruksi ubah password
     - Link login
   - Success message: "Akun [email] berhasil disetujui. Email notifikasi telah dikirim."

3. **Reject** (button red)
   - Modal dengan textarea untuk alasan penolakan
   - Validasi: minimal 10 karakter, maksimal 500 karakter
   - Update status menjadi `rejected`
   - Simpan rejection_reason dan rejection_date
   - Kirim email otomatis ke user dengan:
     - Notifikasi akun ditolak
     - Alasan penolakan (dari textarea)
     - Detail akun (nama, email, NISN)
     - Saran untuk perbaikan
   - Success message: "Akun [email] berhasil ditolak. Email notifikasi telah dikirim."

### 2.2 Daftar Anggota Terdaftar
**File terlibat:**
- `app/Http/Controllers/PetugasController.php` - Method `allMembers()`
- `resources/views/petugas/anggota/index.blade.php`
- Route: `GET /petugas/anggota/all` (nama: `petugas.anggota.all`)

**Fitur:**
- Tabel daftar anggota yang sudah disetujui (status = approved)
- Kolom: #, Nama, Email, NISN, No. Telepon, Tanggal Terdaftar, Aksi
- Pagination (15 item per halaman)
- Filter search by nama atau email
- Badge menampilkan total anggota
- Link ke menu anggota pending

**Aksi per Anggota:**
- View Details (info modal + statistik peminjaman)

### 2.3 Navigation Menu
**File terlibat:**
- `resources/views/layouts/petugas.blade.php`

**Menu Items baru:**
1. **Anggota Pending** (dengan badge warning menampilkan jumlah)
   - Route: `petugas.anggota.pending`
   - Icon: hourglass-half warning

2. **Daftar Anggota** (versi baru)
   - Route: `petugas.anggota.all`
   - Icon: users success

---

## 3. EMAIL NOTIFICATIONS

### 3.1 Account Approved Mail
**File terlibat:**
- `app/Mail/AccountApprovedMail.php`
- `resources/views/emails/account-approved.blade.php`

**Konten Email:**
- Header: "🎉 Akun Anda Telah Disetujui"
- Welcome message
- Verifikasi berhasil notification
- **Detail Login:**
  - Email
  - Password Sementara (generated random 12 char)
  - Nama Lengkap
  - No. NISN
- **Warning:** Ubah password setelah login
- **Langkah Selanjutnya:**
  1. Login ke akun
  2. Update profil jika diperlukan
  3. Ubah password
  4. Mulai meminjam buku
- Button: "Login Sekarang"

### 3.2 Account Rejected Mail
**File terlibat:**
- `app/Mail/AccountRejectedMail.php`
- `resources/views/emails/account-rejected.blade.php`

**Konten Email:**
- Header: "⛔ Pendaftaran Ditolak"
- Notifikasi penolakan
- **Detail Akun:**
  - Email
  - Nama Lengkap
  - No. NISN
- **Alasan Penolakan:** (dari input petugas)
- **Saran Perbaikan:**
  - Cek kembali informasi
  - Pastikan dokumen KTM jelas
  - Hubungi petugas untuk info lebih lanjut
  - Bisa mendaftar kembali dengan data lengkap

---

## 4. DATABASE CHANGES

### Migration: `2025_12_22_000005_add_status_to_users_table.php`

**Kolom ditambahkan:**
```sql
ALTER TABLE users ADD COLUMN status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'
ALTER TABLE users ADD COLUMN rejection_reason TEXT NULL
ALTER TABLE users ADD COLUMN rejection_date TIMESTAMP NULL
```

**Model Update: `app/Models/User.php`**
- Fillable: tambah `status`, `rejection_reason`, `rejection_date`
- Casts: tambah `rejection_date` => `datetime`

---

## 5. ROUTES

**Authentication Routes:**
- POST `/anggota/register` → `AuthController@registerAnggota`
- POST `/anggota/login` → `AuthController@loginAnggota` (with status check)

**Petugas Routes:**
```php
Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->group(function () {
    // User Approval Management
    Route::get('/anggota/pending', 'PetugasController@pendingUsers')->name('petugas.anggota.pending');
    Route::post('/anggota/{id}/approve', 'PetugasController@approveUser')->name('petugas.anggota.approve');
    Route::post('/anggota/{id}/reject', 'PetugasController@rejectUser')->name('petugas.anggota.reject');
    Route::get('/anggota/all', 'PetugasController@allMembers')->name('petugas.anggota.all');
});
```

---

## 6. TESTING CHECKLIST

### User Registration Flow
- [ ] User dapat register dengan semua data valid
- [ ] Foto KTM validasi (hanya image, max 2MB)
- [ ] Email/NISN unique validation berfungsi
- [ ] Akun dibuat dengan status `pending`
- [ ] User redirect ke login dengan modal
- [ ] Modal menampilkan email yang terdaftar

### User Login Flow
- [ ] User dengan status pending tidak bisa login (error message muncul)
- [ ] User dengan status rejected tidak bisa login (show rejection reason)
- [ ] User dengan status approved bisa login normal
- [ ] Session regenerate setelah login

### Petugas Approval Flow
- [ ] Petugas bisa akses menu "Anggota Pending"
- [ ] Daftar pending menampilkan semua akun dengan status pending
- [ ] Filter search berfungsi
- [ ] Dapat view detail dengan foto KTM
- [ ] Approval button mengubah status ke approved
- [ ] Email approval terkirim dengan detail login
- [ ] Reject button membuka modal
- [ ] Modal reject validasi alasan min 10 char
- [ ] Reject mengubah status dan kirim email penolakan

### Petugas Members Flow
- [ ] Menu "Daftar Anggota" menampilkan approved users saja
- [ ] Filter search berfungsi
- [ ] Statistik peminjaman tampil di detail modal
- [ ] Pagination berfungsi

### Email Templates
- [ ] Email approval formatting rapi dan readable
- [ ] Email rejection formatting rapi dan readable
- [ ] Link login bekerja
- [ ] Styling responsive untuk mobile

### Dashboard Navigation
- [ ] Menu petugas menampilkan "Anggota Pending" dan "Daftar Anggota"
- [ ] Badge pending count akurat
- [ ] Active menu indicator bekerja

---

## 7. TEKNOLOGI YANG DIGUNAKAN

- **Framework:** Laravel 11
- **Database:** MySQL
- **Mail:** Laravel Mail (configurable SMTP/Mailtrap)
- **Frontend:** Bootstrap 5.3, FontAwesome 6.4
- **Session:** Laravel Session Management

---

## 8. CATATAN PENTING

1. **Temporary Password:** Generated random 12 character, user harus ubah saat first login
2. **Rejection Reason:** Disimpan di database dan dapat dilihat user saat login
3. **Email Configuration:** Pastikan `.env` sudah config MAIL_* untuk pengiriman email
4. **Migration:** Jalankan `php artisan migrate` untuk apply database changes
5. **Existing Users:** Existing users akan memiliki status NULL, perlu manual update atau migration helper

---

## 9. FUTURE ENHANCEMENTS

- [ ] Email verification link untuk confirm email
- [ ] Approval deadline reminder untuk petugas
- [ ] Batch approval/rejection
- [ ] Notification bell di dashboard petugas
- [ ] Reapply button untuk rejected users
- [ ] Approval history log
- [ ] SMS notification untuk user
