<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Register Page</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assetes/image/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <style type="text/css">
        body {
            background: #F8F9FA;
        }

        .p-xl-5 {
            padding-right: 1rem !important;
        }
    </style>
</head>

<body>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-7 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-2">
                                <a href="#!">
                                    <img src="{{ asset('assetes/image/register-logo.jpg') }}" alt="BootstrapBrain Logo"
                                        width="220">
                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign up to your account</h2>
                            <form method="POST" action="{{ route('register.post') }}">
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
                                                    value="{{ old('first_name') }}" name="first_name" id="first_name"
                                                    placeholder="name@example.com">
                                                <label for="first_name"
                                                    class="form-label">{{ __('First Name') }}</label>
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
                                                    value="{{ old('last_name') }}" name="last_name" id="last_name"
                                                    placeholder="name@example.com">
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
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" id="email"
                                                    placeholder="name@example.com">
                                                <label for="email"
                                                    class="form-label">{{ __('Email Address') }}</label>
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
                                                    name="mobile_number" value="{{ old('mobile_number') }}"
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
                                                    name="date_of_birth" value="{{ old('date_of_birth') }}"
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
                                                <select id="gender" name="gender" value="{{ old('gender') }}"
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"
                                                        {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="Other"
                                                        {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
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
                                                    value="{{ old('password_confirmation') }}"
                                                    id="password_confirmation" value=""
                                                    placeholder="password_confirmation">
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
                                                    placeholder="Address">{{ old('address') }}</textarea>
                                                <label for="address" class="form-label">{{ __('Address') }}</label>
                                            </div>
                                            @error('address')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg"
                                                type="submit">{{ __('Register') }}</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Have an account? <a
                                                href="{{ route('login') }}"
                                                class="link-primary text-decoration-none">Sign in</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
