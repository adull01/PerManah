@extends('layouts.petugas')

@section('title', 'Profil Saya')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 16px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
        color: white;
        text-align: center;
    }

    .profile-photo-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .profile-info-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .profile-info-card h5 {
        font-weight: 700;
        margin-bottom: 25px;
        color: #059669;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .btn-primary {
        background: #10b981;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-secondary {
        background: #6b7280;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .info-item {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .info-label {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 1rem;
        color: #1f2937;
        font-weight: 500;
    }

    .photo-preview, .current-photo {
        margin-top: 15px;
        text-align: center;
    }

    .photo-preview img, .current-photo img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-photo-wrapper">
            <img src="{{ $user->profile_photo 
                ? asset('storage/' . $user->profile_photo) . '?v=' . ($user->updated_at?->timestamp ?? time()) 
                : asset('images/default-avatar.svg') }}" 
                 alt="Profile Photo" 
                 class="profile-photo"
                 id="headerProfilePhoto">
        </div>
        <h2 class="mb-2">{{ $user->name }}</h2>
        <p class="mb-0">
            <i class="fas fa-envelope me-2"></i>{{ $user->email }}
        </p>
        <div class="mt-3">
            <span class="badge bg-light text-dark px-3 py-2">
                <i class="fas fa-user-tie me-1"></i>Petugas
            </span>
            @if($user->membership_date)
            <span class="badge bg-light text-dark px-3 py-2 ms-2">
                <i class="fas fa-calendar me-1"></i>Bergabung sejak {{ $user->membership_date->format('d M Y') }}
            </span>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <!-- Edit Profile Form -->
        <div class="col-md-8">
            <div class="profile-info-card">
                <h5><i class="fas fa-user-edit me-2"></i>Edit Profil</h5>
                
                <form action="{{ route('petugas.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                               placeholder="08xxxxxxxxxx">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3" 
                                  placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" 
                               id="profile_photo" name="profile_photo" accept="image/*" onchange="previewPhoto(this)">
                        <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                        @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <!-- Foto saat ini -->
                        @if($user->profile_photo)
                        <div class="current-photo">
                            <p class="text-muted mb-2">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $user->profile_photo) . '?v=' . ($user->updated_at?->timestamp ?? time()) }}" 
                                 alt="Current Photo" class="img-thumbnail">
                        </div>
                        @endif
                        
                        <!-- Preview foto baru -->
                        <div class="photo-preview" id="photoPreview" style="display: none;">
                            <p class="text-muted mb-2">Preview foto baru:</p>
                            <img id="previewImage" src="" alt="Preview" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Ubah Password (tetap sama) -->
            <div class="profile-info-card">
                <h5><i class="fas fa-lock me-2"></i>Ubah Password</h5>
                <form action="{{ route('petugas.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- ... isi form password tetap sama ... -->
                    <div class="form-group">
                        <label for="current_password" class="form-label">Password Saat Ini *</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password" required>
                        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password Baru *</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        <small class="text-muted">Minimal 8 karakter</small>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru *</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar informasi (tetap sama) -->
        <div class="col-md-4">
            <div class="profile-info-card">
                <h5><i class="fas fa-info-circle me-2"></i>Informasi Akun</h5>
                <div class="info-item">
                    <div class="info-label">ID Petugas</div>
                    <div class="info-value">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Role</div>
                    <div class="info-value"><span class="badge bg-success">Petugas</span></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status</div>
                    <div class="info-value"><span class="badge bg-success">Aktif</span></div>
                </div>
                @if($user->membership_date)
                <div class="info-item">
                    <div class="info-label">Tanggal Bergabung</div>
                    <div class="info-value">{{ $user->membership_date->format('d F Y') }}</div>
                </div>
                @endif
                <div class="info-item">
                    <div class="info-label">Total Pengumuman</div>
                    <div class="info-value">{{ $user->announcements()->count() }} pengumuman</div>
                </div>
            </div>

            <div class="profile-info-card">
                <h5><i class="fas fa-shield-alt me-2"></i>Keamanan</h5>
                <p class="text-muted mb-3">Pastikan akun Anda tetap aman dengan:</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Gunakan password yang kuat</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Ubah password secara berkala</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Jangan bagikan password Anda</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Logout setelah selesai bekerja</li>
                </ul>
            </div>

            <div class="profile-info-card">
                <h5><i class="fas fa-tasks me-2"></i>Tugas Petugas</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Mengelola peminjaman</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Membuat pengumuman</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Memproses perpanjangan</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Mengecek laporan</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewPhoto(input) {
    const preview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');
    const headerPhoto = document.getElementById('headerProfilePhoto');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.style.display = 'block';
            headerPhoto.src = e.target.result + '?v=' + new Date().getTime(); // update header langsung
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endpush
@endsection