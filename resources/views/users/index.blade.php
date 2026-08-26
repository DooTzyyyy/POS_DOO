@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="container">

    <h4 class="mb-3 fw-bold">
        Halaman Users
    </h4>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="d-flex justify-content-between mb-3">

        <a href="{{ route('admin.users.create') }}" 
           class="btn btn-primary btn-sm">
            Tambah User 
        </a>


        <form method="GET" 
              action="{{ route('admin.users.index') }}" 
              class="d-flex">

            <input type="text" 
                   name="search"
                   class="form-control form-control-sm me-2"
                   placeholder="Search username atau email"
                   value="{{ request('search') }}">

            <button class="btn btn-outline-secondary btn-sm">
                Search
            </button>

        </form>

    </div>



    <table class="table table-bordered table-sm">

        <thead class="table-light">

            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th width="180">
                    Aksi
                </th>
            </tr>

        </thead>


        <tbody>


        @forelse($users as $index => $user)

            <tr>

                <td>
                    {{ $users->firstItem() + $index }}
                </td>


                <td>
                    {{ $user->name }}
                </td>


                <td>
                    {{ $user->email }}
                </td>


                <td>
                    {{ $user->role->name ?? '-' }}
                </td>


                <td>


                    <a href="{{ route('admin.users.edit',$user->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>



                    <form action="{{ route('admin.users.destroy',$user->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')


                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus user ini?')">

                            Hapus

                        </button>


                    </form>


                </td>


            </tr>


        @empty

            <tr>

                <td colspan="5" 
                    class="text-center text-muted">

                    Data tidak ada

                </td>

            </tr>


        @endforelse


        </tbody>


    </table>



    <div class="mt-3">

        {{ $users->links() }}

    </div>


</div>


@endsection