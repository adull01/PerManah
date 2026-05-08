@extends('layouts.admin')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Profil Admin</h2>
    <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru <small>(Kosongkan jika tidak ingin mengubah)</small></label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="mb-3">
            <label for="profile_photo" class="form-label">Foto Profil</label>
            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
            @if($user->profile_photo)
                <img src="{{ $user->profile_photo_url }}" alt="Foto Profil" width="80" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
