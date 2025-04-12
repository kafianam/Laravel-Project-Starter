@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
<h1 class="mb-0">Profile</h1>
<hr />

<form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile.update') }}">
    @csrf
    @method('POST')

    <div class="row">
        <div class="col-md-4 text-center">
            <!-- Profile Image Upload -->
            <div class="mb-3">
                <img id="profilePreview" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('default-avatar.png') }}" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px;">
                <input type="file" name="profile_image" class="form-control mt-2" id="profileImageInput">
                @error('profile_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="First name" value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="email" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone', auth()->user()->phone) }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="labels">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', auth()->user()->address) }}" placeholder="Address">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript for Profile Image Preview -->
<script>
document.getElementById('profileImageInput').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('profilePreview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>

@endsection
