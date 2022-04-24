@extends('layouts.app-master')
@section("title","Update Product")
@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Update product</h2>
        <div class="lead">
            Edit product.
        </div>
        <div class="container mt-4">

            <form method="post" action="{{ route('products.update', $product->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $product->name }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug Product</label>
                    <input value="{{ $product->slug }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="slug" required>

                    @if ($errors->has('slug'))
                        <span class="text-danger text-left">
                            {{ $errors->first('slug') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details:</label>
                    <input value="{{ $product->details }}"
                           type="text"
                           class="form-control"
                           name="original"
                           placeholder="details" required>

                    @if ($errors->has('details'))
                        <span class="text-danger text-left">{{ $errors->first('details') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input class="form-control"
                           type="number"
                           name="price"
                           placeholder="price" required value="{{ $product->price }}"/>

                    @if ($errors->has('price'))
                        <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="shipping_cost" class="form-label">Price:</label>
                    <input class="form-control"
                           type="number"
                           name="shipping_cost"
                           placeholder="Shipping cost" required
                           value="{{ $product->shipping_cost }}"/>

                    @if ($errors->has('shipping_cost'))
                        <span class="text-danger text-left">
                            {{ $errors->first('shipping_cost') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input class="form-control"
                           type="text"
                           name="description"
                           placeholder="Shipping cost" required
                           value="{{ $product->description }}"/>

                    @if ($errors->has('description'))
                        <span class="text-danger text-left">
                            {{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image_path" class="form-label">Image:</label>
                    <input type="file" name="image_path" class="form-control" required>
                </div>

                @if ($errors->has('image_path'))
                    <span class="text-danger text-left">{{ $errors->first('image_path') }}</span>
                @endif

                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('products.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>


    </div>
@endsection
