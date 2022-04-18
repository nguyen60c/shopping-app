@extends('layouts.app-master')
@section("title","Product")
@section('content')
    <div class="bg-light p-4 rounded">
        <h2 class="text-center">Add new product</h2>

        <div class="container mt-4">

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="original" class="form-label">From:</label>
                    <input value="{{ old('original') }}"
                           type="text"
                           class="form-control"
                           name="original"
                           placeholder="Original" required>

                    @if ($errors->has('original'))
                        <span class="text-danger text-left">{{ $errors->first('original') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input class="form-control"
                           type="number"
                           name="price"
                           placeholder="price" required value="{{ old('price') }}"/>

                    @if ($errors->has('price'))
                        <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input class="form-control"
                           type="number"
                           name="quantity"
                           placeholder="quantity" required value="{{ old('quantity') }}"/>

                    @if ($errors->has('quantity'))
                        <span class="text-danger text-left">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                @if ($errors->has('image'))
                    <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                @endif

                <button type="submit" class="btn btn-primary">Save product</button>
                <a href="{{ route('products.index') }}" class="btn btn-default border">Back</a>
            </form>
        </div>

    </div>
@endsection

@section("style")

@endsection
