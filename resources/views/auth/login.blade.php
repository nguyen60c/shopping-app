@extends("layouts.auth-master")

@section("title","Login")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="signup-form border p-4 bg-light">
                    <h1 style="margin:0;text-align: center">Login</h1>
                    @include('layouts.partials.messages')
                    <form action="{{route("login.perform")}}" method="post" class="mt-1">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Username or Email:</label>
                                <input type="text" name="username" class="form-control" required value="{{old("username")}}"/>
                            </div>
                            @if($errors->has("username"))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif

                            <div class="mb-3 col-md-12">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required/>
                            </div>
                            @if($errors->has("password"))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end" type="submit">Login Now</button>
                                <a href="{{route("register.show")}}">Don't Have an account?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
