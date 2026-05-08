# QUICK REFERENCE - ACCOUNT VERIFICATION SYSTEM

## 🚀 QUICK START

### 1. Apply Migration
```bash
php artisan migrate
```

### 2. Configure Email (in `.env`)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bookhive.local
MAIL_FROM_NAME=BookHive
```

### 3. Test Registration
```
http://localhost/skripsi/anggota/register
→ Fill form + upload KTM
→ Should see modal on login page
```

### 4. Test Approval
```
Login as petugas → Anggota Pending → Approve → Check email
```

---

## 📍 KEY ROUTES

```
# User Registration & Login
POST  /anggota/register              registerAnggota()
POST  /anggota/login                 loginAnggota()

# Petugas Approval System
GET   /petugas/anggota/pending       pendingUsers()
POST  /petugas/anggota/{id}/approve  approveUser($id)
POST  /petugas/anggota/{id}/reject   rejectUser($id)
GET   /petugas/anggota/all           allMembers()
```

---

## 🎯 KEY CLASSES & METHODS

### AuthController
```php
registerAnggota()      // Create user with status='pending'
loginAnggota()         // Check status before login
```

### PetugasController
```php
pendingUsers()         // Get pending users (paginated)
approveUser($id)       // Approve & send email
rejectUser($id)        // Reject & send email with reason
allMembers()           // Get approved users
```

### Mailable
```php
AccountApprovedMail    // Email sent when approved
AccountRejectedMail    // Email sent when rejected
```

---

## 📊 USER STATUS STATES

| Status | Can Login? | Description | Email Sent |
|--------|-----------|-------------|-----------|
| pending | ❌ No | Waiting for approval | No |
| approved | ✅ Yes | Account approved | Yes |
| rejected | ❌ No | Account rejected | Yes |

---

## 💻 CODE SNIPPETS

### Check User Status Before Login
```php
if ($user->status !== 'approved') {
    Auth::logout();
    return back()->withErrors(['email' => 'Akun belum disetujui']);
}
```

### Send Approval Email
```php
\Mail::send(new AccountApprovedMail($user, $tempPassword));
```

### Send Rejection Email
```php
\Mail::send(new AccountRejectedMail($user, $rejectionReason));
```

### Create User with Pending Status
```php
$user = User::create([
    // ... other fields
    'status' => 'pending',
]);
```

---

## 🔍 DATABASE QUERIES

### Get Pending Users
```php
$pending = User::where('status', 'pending')->get();
```

### Get Approved Users
```php
$approved = User::where('status', 'approved')->get();
```

### Count Pending
```php
$count = User::where('status', 'pending')->count();
```

### Update Status
```php
$user->update(['status' => 'approved']);
```

---

## 📧 EMAIL VARIABLES

### Approval Email
```blade
{{ $user->name }}                    // User name
{{ $user->email }}                   // User email
{{ $temporaryPassword }}             // Temp password
{{ $user->nisn }}                    // User NISN
```

### Rejection Email
```blade
{{ $user->name }}                    // User name
{{ $user->email }}                   // User email
{{ $rejectionReason }}               // Reason from petugas
{{ $user->nisn }}                    // User NISN
```

---

## 🎨 VIEW ROUTES

```
/petugas/anggota/pending    → resources/views/petugas/anggota/pending.blade.php
/petugas/anggota/all        → resources/views/petugas/anggota/index.blade.php
/anggota/login              → resources/views/auth/anggota-login.blade.php
```

---

## 🔧 COMMON TASKS

### Add New Field to User
1. Create migration: `php artisan make:migration add_field_to_users`
2. Add column in migration
3. Add to fillable in User model
4. Add to casts if needed (datetime, boolean, etc)
5. Run: `php artisan migrate`

### Test Email Sending
```bash
php artisan tinker
>>> Mail::raw('Test', function($m) { $m->to('test@example.com'); });
```

### Update All Pending to Approved
```bash
php artisan tinker
>>> User::where('status', 'pending')->update(['status' => 'approved']);
```

### Clear Cache
```bash
php artisan config:cache
php artisan view:clear
php artisan cache:clear
```

---

## ⚡ PERFORMANCE TIPS

1. Add index on `status` column:
```php
// In migration
$table->enum('status', [...])->index();
```

2. Use eager loading:
```php
$users = User::with('borrowings')->where('status', 'approved')->get();
```

3. Paginate large results:
```php
$users = User::where('status', 'pending')->paginate(15);
```

---

## 🐛 DEBUGGING

### Check User Status
```bash
php artisan tinker
>>> User::find(1)->status
```

### Check Email Config
```php
config('mail.mailer')    // Should be 'smtp'
config('mail.from')      // Should have 'address' & 'name'
```

### Check Migration Status
```bash
php artisan migrate:status
```

### View Logs
```bash
tail -f storage/logs/laravel.log
```

---

## 📱 RESPONSIVE DESIGN

### Breakpoints Used
- Mobile: < 576px (xs)
- Tablet: 576px - 768px (sm)
- Desktop: > 768px (md+)

### Key Classes
- `.table-responsive` - For scrollable tables
- `.btn-group` - For grouped buttons
- `.d-flex` - Flexbox container

---

## 🔐 SECURITY CHECKLIST

- [x] Input validation on all forms
- [x] CSRF token on all state-changing requests
- [x] Password hashing with Hash::make()
- [x] Status validation before grant access
- [x] Role-based access with middleware
- [x] Unique constraints on sensitive fields
- [x] SQL injection prevention (Eloquent)

---

## 📋 VALIDATION RULES

### Registration
```php
'name' => 'required|string|max:255',
'nisn' => 'required|string|max:20|unique:users',
'email' => 'required|email|unique:users',
'password' => 'required|string|min:8|confirmed',
'ktm_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
```

### Rejection Reason
```php
'rejection_reason' => 'required|string|min:10|max:500',
```

---

## 🚨 COMMON ERRORS & SOLUTIONS

| Error | Solution |
|-------|----------|
| Email not sent | Check SMTP config in .env |
| User can't login when pending | Check status validation in loginAnggota() |
| Migration fails | Check if column already exists |
| Modal not showing | Check Bootstrap JS is loaded |
| 404 on petugas routes | Check if user has 'petugas' role |

---

## 📞 NEED HELP?

1. Check **FEATURE_DOCUMENTATION.md** - Full feature details
2. Check **SETUP_GUIDE.md** - Installation & config
3. Check **IMPLEMENTATION_CHECKLIST.md** - Testing guide
4. Check **README_FEATURES.md** - Overview summary

---

**Last Updated:** 22 December 2025
**Version:** 1.0
**Framework:** Laravel 11
