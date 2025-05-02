@extends('adminlte::page')

@section('title', 'User Management')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content_header')
    <h1>Users List</h1>
@stop

@section('content')
    <div class="card p-3">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('usermanagement.create') }}" class="btn btn-primary">Add User</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($usermanagement->count() > 0)
                    @foreach($usermanagement as $rs)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->id }}</td>
                            <td class="align-middle">{{ $rs->name }}</td>
                            <td class="align-middle">{{ $rs->email }}</td>
                            <td class="align-middle">{{ $rs->role }}</td>
                            <td class="align-middle">
                                <a href="{{ route('usermanagement.show', $rs->id) }}" class="btn btn-sm btn-secondary" title="Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('usermanagement.edit', $rs->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($rs->role !== 'admin')
                                <form action="{{ route('usermanagement.destroy', $rs->id) }}" method="POST" class="delete-form d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="6">No User Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- SweetAlert delete confirmation --}}
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to delete this user?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </div>
@stop
