<!DOCTYPE html>
<html>

<head>
    <title>User Management System</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assetes/image/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body {
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }

        .logo-container {
            flex-direction: column;
            text-align: center;
            margin-right: 78%
        }

        .dropdown-item:hover {
            background-color: transparent !important;
            color: inherit;
        }

        .row.space > * {
            padding-right: 0;
            padding-left: 0;
            margin-top: var(--bs-gutter-y);
        }
    </style>
</head>

<body>

    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <div class="row">
                    <div class="col-md-9">
                        <a href="/" class="d-flex text-dark text-decoration-none logo-container">
                            <div class="logo-image">
                                <img src="{{ asset('assetes/image/logo.png') }}" alt="BootstrapBrain Logo"
                                    width="50" style="border-radius: 50%;">
                            </div>
                            <div class="logo-text">
                                User Management System
                            </div>
                        </a>

                    </div>

                    <div class="col-md-1" style="margin-top:20px; padding-left:35px;">
                        <a href="{{ route('dashboard') }}" class="text-dark text-decoration-none">Dashboard</a>
                    </div>

                    <div class="col-md-1" style="margin-top:20px; padding-left:50px;">
                        <a href="{{ route('user-profile') }}" class="text-dark text-decoration-none">Profile</a>
                    </div>

                    <div class="col-md-1" style="margin-top:15px;">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

            </header>
            @yield('content')
        </div>
    </main>

</body>

</html>
