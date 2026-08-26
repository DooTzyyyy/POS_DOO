@extends('layouts.app')

@section('title', 'Users')

@section('content')

<style>
    .users-page {
        padding: 28px 0 40px;
    }

    .page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .page-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #172033;
        letter-spacing: -0.4px;
    }

    .page-subtitle {
        margin: 5px 0 0;
        color: #7a8496;
        font-size: 14px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 0;
        border-radius: 8px;
        background: #2563eb;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s;
    }

    .btn-add:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-1px);
    }

    .users-card {
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(20, 32, 55, .04);
        overflow: hidden;
    }

    .users-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 18px 20px;
        border-bottom: 1px solid #edf0f4;
    }

    .users-count {
        color: #5f6b7c;
        font-size: 14px;
    }

    .search-form {
        display: flex;
        gap: 8px;
        width: 330px;
    }

    .search-input {
        height: 38px;
        border: 1px solid #dfe3e9;
        border-radius: 7px;
        padding: 0 13px;
        font-size: 13px;
        outline: none;
        transition: .2s;
    }

    .search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
    }

    .btn-search {
        height: 38px;
        padding: 0 15px;
        border: 1px solid #d8dde5;
        border-radius: 7px;
        background: #fff;
        color: #344054;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-search:hover {
        background: #f7f8fa;
    }

    .table-wrap {
        overflow-x: auto;
    }

    .users-table {
        margin: 0;
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead th {
        background: #f8f9fb;
        color: #667085;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 13px 20px;
        border-bottom: 1px solid #e9edf2;
        white-space: nowrap;
    }

    .users-table tbody td {
        padding: 14px 20px;
        color: #344054;
        font-size: 14px;
        border-bottom: 1px solid #edf0f4;
        vertical-align: middle;
    }

    .users-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .users-table tbody tr {
        transition: background .15s;
    }

    .users-table tbody tr:hover {
        background: #fafbfc;
    }

    .number {
        width: 55px;
        color: #98a2b3 !important;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .avatar {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eaf1ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
    }

    .user-name {
        color: #1d2939;
        font-weight: 600;
    }

    .email {
        color: #667085;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #475467;
        font-size: 12px;
        font-weight: 600;
    }

    .role-admin {
        background: #eef4ff;
        color: #2457c5;
    }

    .role-kasir {
        background: #ecfdf3;
        color: #087443;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-edit,
    .btn-delete {
        border: 0;
        border-radius: 6px;
        padding: 6px 11px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #fff7e6;
        color: #b76e00;
    }

    .btn-edit:hover {
        background: #ffedbd;
        color: #965900;
    }

    .btn-delete {
        background: #fff0f0;
        color: #d92d20;
    }

    .btn-delete:hover {
        background: #ffe0df;
    }

    .empty-state {
        padding: 45px 20px !important;
        text-align: center;
        color: #98a2b3 !important;
    }

    .pagination-wrapper {
        padding: 16px 20px;
        border-top: 1px solid #edf0f4;
    }

    .alert-success-custom {
        border: 0;
        border-radius: 8px;
        background: #ecfdf3;
        color: #087443;
        font-size: 14px;
        margin-bottom: 18px;
    }

    @media (max-width: 768px) {
        .page-header,
        .users-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .search-form {
            width: 100%;
        }

        .page-header {
            gap: 14px;
        }

        .btn-add {
            width: fit-content;
        }
    }
</style>

<div class="container users-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Pengguna</h1>
            <p class="page-subtitle">
                Kelola akun pengguna dan hak akses sistem.
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn-add">
            <span>+</span>
            Tambah User
        </a>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success-custom">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="users-card">

        {{-- TOOLBAR --}}
        <div class="users-toolbar">

            <div class="users-count">
                Total <strong>{{ $users->total() }}</strong> pengguna
            </div>

            <form method="GET"
                  action="{{ route('admin.users.index') }}"
                  class="search-form">

                <input
                    type="text"
                    name="search"
                    class="search-input form-control"
                    placeholder="Cari nama atau email..."
                    value="{{ request('search') }}">

                <button type="submit" class="btn-search">
                    Cari
                </button>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="table-wrap">

            <table class="users-table">

                <thead>
                    <tr>
                        <th class="number">#</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($users as $index => $user)

                    @php
                        $initial = strtoupper(substr($user->name, 0, 1));
                        $roleName = strtolower($user->role->name ?? '');
                    @endphp

                    <tr>

                        <td class="number">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="user-info">

                                <div class="avatar">
                                    {{ $initial }}
                                </div>

                                <div class="user-name">
                                    {{ $user->name }}
                                </div>

                            </div>
                        </td>

                        <td class="email">
                            {{ $user->email }}
                        </td>

                        <td>

                            <span class="role-badge
                                {{ $roleName === 'admin' ? 'role-admin' : '' }}
                                {{ $roleName === 'kasir' ? 'role-kasir' : '' }}">

                                {{ $user->role->name ?? '-' }}

                            </span>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.users.destroy', $user->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-delete"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="empty-state">
                            Tidak ada data pengguna.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($users->hasPages())
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
