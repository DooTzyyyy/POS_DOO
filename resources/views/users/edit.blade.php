@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold">Edit User</h3>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Role</label>
            <select name="role_id" class="form-select" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Update
            </button>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection