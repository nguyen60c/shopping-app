@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded mt-5">
        <div class="container border radius">
            <div class="row">
                <div class="col">
                    <img class="product-img" src="{{asset("images/".$product->image_path)}}" style="width: 200px;height: 200px">
                </div>

                <div class="col-9">
                    <div><strong>Name: </strong>
                        <input class="product-name border-0 transparent-input"
                               type="text"
                               readonly value="{{$product->name}}">
                    </div>
                    <div><strong>Details: </strong>
                        <input class="product-original border-0 transparent-input"
                               type="text"
                               readonly
                               value="{{$product->details}}"></div>
                    <div>
                        <strong>Price: </strong>
                        <input class="product-price border-0 transparent-input"
                               type="text"
                               readonly value="{{$product->price}}"></div>
                    <div>
                        <strong>Description: </strong>
                        <input class="product-desc border-0 transparent-input"
                               type="text" readonly value="{{$product->description}}"></div>

                    <div>
                        <strong>Shipping cost: </strong>
                        <input class="product-desc border-0 transparent-input"
                               type="text" readonly
                               value="{{$product->shipping_cost}}">
                    </div>

                    <div>
                        <strong>Quantity: </strong>
                        <input class="product-desc border-0 transparent-input"
                               type="text" readonly
                               value="{{$product->quantity_pro}}">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mt-4">
        @role("admin"|"seller")
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('products.index') }}" class="btn btn-default">Back</a>
        @endrole

        @role("user")
        <a href="{{ route('orders.index') }}" class="btn btn-default">Back</a>
        @endrole


    </div>
@endsection

@section("script")
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            @include("layouts.partials.jquery")--}}
{{--            /*Show product details*/--}}
{{--            let pathUrl = window.location.href;--}}
{{--            let array = pathUrl.split("/");--}}
{{--            let attr_image = $(".product-img");--}}
{{--            let input_name = $(".product-name");--}}
{{--            let input_price = $(".product-price");--}}
{{--            let input_quantity = $(".product-description");--}}
{{--            let input_details = $(".product-details");--}}

{{--            $.ajax({--}}
{{--                url: "http://127.0.0.1:8000/products/" + array[4] + "/fetch",--}}
{{--                method: "GET",--}}
{{--                datatype: "json",--}}
{{--                success: function (res) {--}}
{{--                    let source = "{!! asset('images/products/" + res.product["image"] + "') !!}"--}}
{{--                    attr_image.attr("src", source);--}}
{{--                    input_name.val(res.product["name"])--}}
{{--                    input_name.val(res.product["name"])--}}
{{--                    input_quantity.val(res.product["quantity"])--}}
{{--                    input_details.val(res.product["details"])--}}
{{--                    input_price.val(addCommas(res.product["price"]) + " VNĐ")--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endsection
