@extends("layouts.app")

@section('content')
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if(count($data) > 0)
                    <h4>{{ count($data)}} Product(s) In Your Cart</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="/" class="btn btn-dark">Continue Shopping</a>
                @endif
                {{--                {{ddd($quantity_data)}}--}}
                @foreach($data as $item)
                    {{--                    {{ddd($products)}}--}}
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/images/{{ $item->image_path }}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            {{--                            {{ddd($item)}}--}}
                            <p>
                                <b><a href="/shop/{{ $item->slug }}">
                                        {{ $item->name }}</a></b><br>
                                <b>Price: </b>${{ $item->price }}<br>
                                <b>Sub Total: </b>
                                ${{ $total }}<br>
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                        <span class="text-danger"></span>
                                        <input type="number"
                                               class="form-control form-control-sm quantity"
                                               value="{{ $item->quantity }}"
                                               min="1"
                                               max="100"
                                               id="quantity" name="quantity"
                                               style="width: 70px; margin-right: 10px;">
                                        <button class="btn btn-secondary btn-sm"
                                                style="margin-right: 25px;"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm"
                                            style="margin-right: 10px;"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($data)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Clear Cart</button>
                    </form>
                @endif
            </div>
            @if(count($data)>0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>${{ $total }}</li>
                        </ul>
                    </div>
                    <br><a href="{{route("home.index")}}"
                           class="btn btn-dark">Continue Shopping</a>
                    <a href="{{route("order.index")}}" class="btn btn-success">Proceed To Checkout</a>
                </div>
            @endif
        </div>
        <br><br>
    </div>
@endsection

@section("script")
    <script>
        $(document).ready(function () {
            let badge = $(".badge");
            let quantity = $(".quantity");
            let combiObj = $.map(quantity, function (el) {
                return el;
            })

            badge.text(<?php echo $total_quan ?>)

            $(combiObj).on("click", function () {
                $.ajax({
                    url: "http://127.0.0.1:8000/cart/products",
                    method: "GET",
                    datatype: "json",
                    success: function (res) {
                        console.log($(combiObj).val())
                        badge.text(res.total)
                    }
                })
            })

            $(combiObj).on("keyup", function () {
                console.log("hello")
                $.ajax({
                    url: "http://127.0.0.1:8000/cart",
                    method: "GET",
                    datatype: "json",
                    success: function (res) {
                        if (quantity <= 0) {
                            $(".text-danger").text().replace("helelo")
                        }
                    }
                })
            })

        })
    </script>
@endsection
