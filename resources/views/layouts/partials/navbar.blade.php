<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav_list nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav_item active"><a href="/" class="nav-item__content nav-link px-2 text-white">Home</a></li>
                @auth
                    @role("admin")
                    <li class="nav_item"><a href="{{route("users.index")}}"
                                            class="nav-item__content nav-link px-2 text-white">Users</a></li>
                    <li class="nav_item"><a href="{{route("products.index")}}"
                                            class="nav-item__content nav-link px-2 text-white">Products</a>
                    </li>
                    <li class="nav_item"><a href="{{route("roles.index")}}"
                                            class="nav-item__content nav-link px-2 text-white">Roles</a></li>
                    <li class="nav_item"><a href="{{route("permissions.index")}}"
                                            class="nav-item__content nav-link px-2 text-white">Permissions</a>
                    </li>
                    @endrole

                    @role("seller")
                    <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Products</a>
                    </li>
                    @endrole

                    @role("user")
                    <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Carts</a>
                    </li>
                    <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Orders</a>
                    </li>
                    @endrole

                    <li class="nav_item"><a href="#" class="nav-item__content nav-link px-2 text-white">Profile</a>
                    </li>
                @endauth
            </ul>

            @auth
                <span class="mr-3" style="display: inline-block;margin-right: 10px !important;">
                {{auth()->user()->name}}
                </span>

                <div class="ml-6 text-end">
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
