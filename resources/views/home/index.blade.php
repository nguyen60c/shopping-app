@extends("layouts.app-master")
@section('title', 'Home')
@section('content')
    @auth
        @role('user')
            <br>

            <h1>Store</h1>

            @if ($products->count() == 0)
                <tr>
                    <td colspan="5">No products to display.</td>
                </tr>
            @endif

            <?php $count = 0; ?>

            @foreach ($products as $product)
                @if ($count % 3 == 0)
                    <div class="row">
                @endif

                <div class="col-md-4 mt-5" style="border-radius: 10px">
                    <div class="card mb-4" style="align-items: center;
                                    padding: 18px;border: none !important;">
                        <img class="card-img-top" style="width: 200px; height: 200px"
                            src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->image_path }}">
                        <div class="card-body">
                            <h4 class="card-text" style="margin-bottom: 5px">{{ $product->name }}</h4>
                            <h5>${{ number_format($product->price) }}</h5>
                            <form action="{{ route('cart.store') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $product->name }}" id="name" name="name">
                                <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                <input type="hidden" value="{{ $product->image_path }}"
                                id="img" name="img">
                                <input type="hidden" value="{{ $product->slug }}" id="slug" name="slug">
                                <input type="hidden" value="1" id="quantity" name="quantity">
                                <div class="card-footer" style="background-color: white;">
                                    <div class="row">
                                        <button class="btn btn-secondary btn-sm"
                                        class="tooltip-test" title="add to cart">
                                            <i class="fa fa-shopping-cart"></i> add to cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($count % 3 == 2)
                    </div>
                @endif

                <?php $count++; ?>
            @endforeach
        @endrole
    @endauth

    @guest
        <h1>Please login</h1>
    @endguest
@endsection


@section('script')

    <script>

    </script>

@endsection
