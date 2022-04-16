@extends("layouts.app-master")

@section("content")
    @auth
    <h1>Hello world</h1>
    @endauth

    @guest
        <h1>Homepage</h1>
    @endguest
@endsection
