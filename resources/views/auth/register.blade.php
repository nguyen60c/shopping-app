@extends("layouts.auth-master")

@section("title","Register")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="signup-form border p-4 bg-light">
                    <h1 style="margin:0;text-align: center">Register</h1>
                    <form action="{{route("register.perform")}}" method="post" class="mt-1">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" required value="{{old("username")}}"/>
                            </div>
                            @if($errors->has("username"))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif

                            <div class="mb-3 col-md-12">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" value="{{old("email")}}" required/>
                            </div>
                            @if($errors->has("email"))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif

                            <div class="mb-3 col-md-12">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required/>
                            </div>
                            @if($errors->has("password"))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif

                            <div class="mb-3 col-md-12">
                                <label>Password confirm:</label>
                                <input type="password" name="password_confirmation" class="form-control" required/>
                            </div>
                            @if($errors->has("password_confirmation"))
                                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                            @endif

                            <div class="mb-3 col-md-12">
                                <label>Avatar:</label>
                                <input type="file" name="avatar" class="form-control"/>
                            </div>
                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end" type="submit">Signup Now</button>
                                <a href="{{route("login.show")}}">Have an account?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
