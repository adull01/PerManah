# SETUP & IMPLEMENTATION GUIDE

## 📦 SUMMARY PERUBAHAN

Sistem Account Verification telah berhasil diimplementasikan untuk platform BookHive. Berikut adalah ringkasan lengkap perubahan yang dilakukan:

---

## ✅ FILES YANG DIBUAT

### 1. Database Migration
- **File:** `database/migrations/2025_12_22_000005_add_status_to_users_table.php`
- **Fungsi:** Menambahkan 3 kolom ke tabel users:
  - `status` (enum: pending, approved, rejected) - default: pending
  - `rejection_reason` (text, nullable)
  - `rejection_date` (timestamp, nullable)

### 2. Mailable Classes
- **File:** `app/Mail/AccountApprovedMail.php`
  - Mengirim email notifikasi saat akun disetujui
  - Includes temporary password dan instruksi login
  
- **File:** `app/Mail/AccountRejectedMail.php`
  - Mengirim email notifikasi saat akun ditolak
  - Includes alasan penolakan dari petugas

### 3. Email Templates
- **File:** `resources/views/emails/account-approved.blade.php`
  - Template HTML untuk email approval
  - Format profesional dengan styling
  - Informasi login dan instruksi ubah password
  
- **File:** `resources/views/emails/account-rejected.blade.php`
  - Template HTML untuk email rejection
  - Display alasan penolakan
  - Saran perbaikan untuk reapply

### 4. Views Petugas
- **File:** `resources/views/petugas/anggota/pending.blade.php`
  - Halaman daftar anggota menunggu approval
  - Fitur view detail, approve, reject
  - Modal untuk input rejection reason
  
- **File:** `resources/views/petugas/anggota/index.blade.php`
  - Halaman daftar anggota terdaftar (approved)
  - Statistik dan detail anggota
  - Pagination dan search

---

## 📝 FILES YANG DIMODIFIKASI

### 1. Controllers

**`app/Http/Controllers/AuthController.php`**
- ✏️ `registerAnggota()` - Ubah untuk create user dengan status pending (tidak langsung login)
- ✏️ `loginAnggota()` - Tambah validasi status user sebelum login
  - Pending: error "akun sedang ditinjau"
  - Rejected: error + tampil alasan
  - Approved: login normal

**`app/Http/Controllers/PetugasController.php`**
- ➕ `pendingUsers()` - List anggota dengan status pending (paginated)
- ➕ `approveUser($id)` - Approve akun + kirim email approval
- ➕ `rejectUser($id)` - Reject akun + kirim email rejection
- ➕ `allMembers()` - List anggota approved saja

### 2. Models

**`app/Models/User.php`**
- ➕ Tambah 3 field ke `$fillable`:
  - `status`
  - `rejection_reason`
  - `rejection_date`
- ➕ Tambah casting untuk `rejection_date` ke datetime

### 3. Views

**`resources/views/auth/anggota-login.blade.php`**
- ➕ Tambah modal untuk notifikasi pending account
- ➕ Script untuk show modal saat register berhasil
- Menampilkan email yang terdaftar di modal

**`resources/views/layouts/petugas.blade.php`**
- ➕ Tambah 2 menu item baru di sidebar:
  - "Anggota Pending" (dengan badge count)
  - "Daftar Anggota" (untuk approved users)
- Active indicator untuk route matching

### 4. Routes

**`routes/web.php`**
- ➕ Route group baru untuk user approval:
  ```php
  Route::get('/anggota/pending', 'pendingUsers')->name('petugas.anggota.pending');
  Route::post('/anggota/{id}/approve', 'approveUser')->name('petugas.anggota.approve');
  Route::post('/anggota/{id}/reject', 'rejectUser')->name('petugas.anggota.reject');
  Route::get('/anggota/all', 'allMembers')->name('petugas.anggota.all');
  ```

---

## 🚀 SETUP INSTRUCTIONS

### Step 1: Run Migration
```bash
php artisan migrate
```
Status: ✅ SUDAH DIJALANKAN

### Step 2: Configure Email (PENTING!)
Edit file `.env` dan set SMTP configuration:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bookhive.local
MAIL_FROM_NAME="BookHive"
```

Alternatif: Gunakan Mailtrap (https://mailtrap.io) untuk testing

### Step 3: Verify Routes
```bash
php artisan route:list | grep anggota
```

### Step 4: Clear Cache (Optional but Recommended)
```bash
php artisan config:cache
php artisan view:clear
```

---

## 🧪 TESTING MANUAL

### Test User Registration
1. Buka http://localhost/skripsi/anggota/register
2. Isi semua field dengan valid
3. Upload foto KTM (jpg/png, max 2MB)
4. Klik "Daftar"
5. ✅ Harus redirect ke login dengan modal pending
6. ✅ Modal harus menampilkan email yang terdaftar
7. Cek database: User status harus = "pending"

### Test User Login with Pending Status
1. Buka http://localhost/skripsi/anggota/login
2. Masukkan email & password yang baru terdaftar
3. ✅ Harus error: "Akun Anda masih dalam proses peninjauan..."
4. Tidak boleh login

### Test Petugas Approval Flow
1. Login sebagai petugas
2. Klik menu "Anggota Pending"
3. Harus muncul list anggota dengan status pending
4. Badge menampilkan jumlah pending
5. **Test Approve:**
   - Klik tombol approve
   - Confirm dialog
   - ✅ Success message
   - ✅ Email dikirim ke user
   - User status berubah jadi "approved"
6. **Test Reject:**
   - Klik tombol reject
   - Modal muncul untuk input alasan
   - Isi alasan minimal 10 karakter
   - Klik "Tolak & Kirim Email"
   - ✅ Success message
   - ✅ Email dikirim ke user
   - User status berubah jadi "rejected"
   - rejection_reason dan rejection_date tersimpan

### Test User Login with Approved Status
1. Setelah petugas approve
2. User bisa login dengan email & password
3. ✅ Harus berhasil & redirect ke dashboard anggota

### Test User Login with Rejected Status
1. Coba login dengan akun yang ditolak
2. ✅ Harus error dengan message menampilkan alasan ditolak

### Test Email Received
1. Gunakan Mailtrap untuk melihat email terkirim
2. Email approval harus include:
   - Notifikasi sukses disetujui
   - Detail login (email & password sementara)
   - Instruksi ubah password
   - Link login
3. Email rejection harus include:
   - Notifikasi ditolak
   - Alasan penolakan
   - Detail akun
   - Saran perbaikan

---

## 📊 DATABASE STRUCTURE

### Tabel Users - Kolom Baru
```sql
ALTER TABLE users ADD COLUMN status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending';
ALTER TABLE users ADD COLUMN rejection_reason TEXT NULL;
ALTER TABLE users ADD COLUMN rejection_date TIMESTAMP NULL;
```

### Default Values
- **Existing Users:** Status akan NULL (perlu manual update)
- **New Users:** Status = 'pending' (otomatis)

---

## 🔒 SECURITY CONSIDERATIONS

1. **Password Hashing:** Sudah menggunakan Hash::make()
2. **Status Validation:** Login check status sebelum grant access
3. **CSRF Protection:** Semua form pakai @csrf
4. **Temporary Password:** Generated random 12 character
5. **Email Validation:** Unique check pada registration
6. **Role-based Access:** Routes protected dengan middleware 'role:petugas'

---

## 📧 EMAIL CONFIGURATION

### Setting Email untuk Development
**Option 1: Mailtrap (Recommended)**
1. Signup di https://mailtrap.io
2. Dapatkan SMTP credentials
3. Update .env dengan credentials Mailtrap
4. Test dengan mengirim email

**Option 2: Gmail**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_specific_password
MAIL_ENCRYPTION=tls
```

**Option 3: Local Development (Mailhog)**
```bash
# Install Mailhog
# https://github.com/mailhog/MailHog

.env:
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
```

---

## 📱 RESPONSIVE DESIGN

- ✅ Modal responsive untuk mobile
- ✅ Table dengan horizontal scroll untuk mobile
- ✅ Email template responsive
- ✅ Bootstrap 5 grid system

---

## 🐛 TROUBLESHOOTING

### Email tidak terkirim?
1. Check `.env` MAIL_* configuration
2. Test SMTP connection:
   ```bash
   php artisan tinker
   >>> Mail::raw('Test', function($m) { $m->to('test@test.com'); });
   ```
3. Check log di `storage/logs/laravel.log`

### User masih bisa login dengan status pending?
1. Run migration: `php artisan migrate`
2. Check database kolom `status`
3. Login check di `loginAnggota()` method

### Modal notifikasi tidak muncul?
1. Check session 'show_pending_modal'
2. Check Bootstrap JS loading
3. Check browser console untuk error JavaScript

### Kolom status tidak ada di database?
```bash
# Check migration status
php artisan migrate:status

# Run pending migrations
php artisan migrate

# Verify columns
php artisan tinker
>>> \DB::connection()->getSchemaBuilder()->getColumnListing('users')
```

---

## 📈 PERFORMANCE CONSIDERATIONS

1. **Pagination:** 15 items per page (optimized)
2. **Database Indexes:** Consider adding pada kolom `status` untuk query speed
3. **Email Queue:** Bisa implement queue untuk email yg delayed (optional)

---

## 🔄 FUTURE IMPROVEMENTS

1. Queue email pengiriman (async)
2. Email verification link
3. Approval deadline reminder
4. Bulk approval/rejection
5. Approval history logging
6. SMS notification
7. Dashboard widget untuk pending count
8. Approval automation rules

---

## 📞 SUPPORT

Untuk bantuan atau pertanyaan:
1. Check FEATURE_DOCUMENTATION.md untuk detail fitur
2. Check kode di routes, controller, model
3. Check email templates di resources/views/emails/

---

**Status:** ✅ READY FOR PRODUCTION
**Last Updated:** 22 December 2025
**Version:** 1.0
