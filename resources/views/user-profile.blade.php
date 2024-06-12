@extends('layout')
@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row space justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-12 col-xxl-4">
                    <div class="border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-2">
                                <a href="#!" id="profile-image-link">
                                    @if ($user->image)
                                        <img id="profile-image-preview" src="{{ asset($user->image) }}" alt="Profile Image"
                                            width="150" height="150" style="border-radius: 50%">
                                    @else
                                        <img id="profile-image-preview"
                                            src="{{ asset('assetes/image/profile-image1.png') }}"
                                            alt="Default Profile Image" width="150" height="150"
                                            style="border-radius: 50%">
                                    @endif
                                </a>
                            </div>
                            <div class="text-center mb-3">
                                <!-- Replace Image Button -->
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" id="image" style="display: none;" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button class="btn btn-sm btn-primary" type="button"
                                    onclick="document.getElementById('image').click();">Replace Image</button>

                                <!-- Remove Image Button -->
                                <form method="POST" action="{{ route('remove-user-profile-image') }}"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Remove Image</button>
                                </form>
                            </div>
                            <!-- Hidden form for image upload -->
                            <form method="POST" action="{{ route('upload-user-profile-image') }}" id="image-upload-form"
                                enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type="file" name="image" id="hidden-image-input">
                            </form>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Update Profile</h2>
                            <form method="POST" action="{{ route('post-user-profile-edit') }}">
                                @csrf

                                @session('error')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $value }}
                                    </div>
                                @endsession

                                <div class="row gy-2 overflow-hidden">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    value="{{ old('first_name', $user->first_name) }}" name="first_name"
                                                    id="first_name" placeholder="name@example.com">
                                                <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                                            </div>
                                            @error('first_name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    value="{{ old('last_name', $user->last_name) }}" name="last_name"
                                                    id="last_name" placeholder="name@example.com">
                                                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                            </div>
                                            @error('last_name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mb-3 mr-5">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email', $user->email) }}" id="email"
                                                    placeholder="name@example.com">
                                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                            </div>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3 mr-5">
                                                <input type="number"
                                                    class="form-control @error('mobile_number') is-invalid @enderror"
                                                    name="mobile_number"
                                                    value="{{ old('mobile_number', $user->mobile_number) }}"
                                                    id="mobile_number" placeholder="name@example.com">
                                                <label for="mobile_number"
                                                    class="form-label">{{ __('Mobile Number') }}</label>
                                            </div>
                                            @error('mobile_number')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mb-3 mr-5">
                                                <input type="date"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    name="date_of_birth"
                                                    value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                                    id="date_of_birth" placeholder="name@example.com">
                                                <label for="date_of_birth"
                                                    class="form-label">{{ __('Date of Birth') }}</label>
                                            </div>
                                            @error('date_of_birth')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3 mr-5">
                                                <select id="gender" name="gender"
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"
                                                        {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>
                                                        Female
                                                    </option>
                                                    <option value="Other"
                                                        {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>
                                                        Other</option>
                                                </select>
                                            </div>
                                            @error('gender')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" value="{{ old('password') }}" id="password"
                                                    value="" placeholder="Password">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                            </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation"
                                                    value="{{ old('password_confirmation') }}" id="password_confirmation"
                                                    value="" placeholder="password_confirmation">
                                                <label for="password_confirmation"
                                                    class="form-label">{{ __('Confirm Password') }}</label>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                    placeholder="Address" valu="{{ $user->address ?? '' }}">{{ $user->address ?? '' }}</textarea>
                                                <label for="address" class="form-label">{{ __('Address') }}</label>
                                            </div>
                                            @error('address')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-grid my-3">
                                                <button class="btn btn-primary btn-lg"
                                                    type="submit">{{ __('Update') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);

                const form = document.getElementById('image-upload-form');
                const hiddenInput = document.getElementById('hidden-image-input');
                hiddenInput.files = event.target.files;
                form.submit();
            }
        });
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>

@endsection
