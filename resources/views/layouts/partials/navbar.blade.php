<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav_list nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav_item active"><a href="/" class="nav-item__content nav-link px-2 text-white">Home</a></li>
                <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Users</a></li>
                <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Products</a></li>
                <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Roles</a></li>
                <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Permissions</a></li>
            </ul>

            @auth
                {{auth()->user()->name}}
                <div class="text-end">
                    <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
                </div>
            @endguest
        </div>
    </div>
</header>

@section("script")
    <script>

        /*
        Jquery field
         */

    </script>

@section("style")
    <style>

    </style>
@endsection
@endsection
