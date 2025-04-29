@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            <img id="profilePreview"
                                src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('default-avatar.png') }}"
                                class="img-thumbnail rounded-circle mb-2"
                                style="width: 150px; height: 150px;">
                            <input type="file" name="profile_image" class="form-control" id="profileImageInput">
                            @error('profile_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', auth()->user()->name) }}" placeholder="Your Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', auth()->user()->phone) }}" placeholder="Phone Number">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', auth()->user()->address) }}" placeholder="Address">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Image Preview Script --}}
    <script>
        document.getElementById('profileImageInput').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profilePreview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@stop
