@extends("layouts.app-master")
@section("title","Home")
@section("content")
    @auth
        @role("user")
        <br>
        <div class="text-end">
            <a class="btn btn-success" href="{{route("index.add-cart")}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart"
                     viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0
                         1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0
                         0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <span id="items-in-cart">0</span> items in cart
            </a>
        </div>

        <h1>Store</h1>


        <!--        --><?php //print_r($cart) ?>
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
                                 src="{{asset('images/products/'.$product->image)}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-text" style="margin-bottom: 5px">{{$product->name}}</h4>
                                <div class="text-danger mb-2 mt-1">Only ${{number_format($product->price)}}</div>
                                <div class="btn-group">
                                    <span class="text-danger" id="text-input-number"></span>
                                    <input type="hidden" value="1" min="1" max="100">
                                    <button class="add-to-cart btn btn-primary" type="button"
                                            data-id="{{$product->id}}"
                                            data-name="{{$product->name}}"
                                            data-price="{{$product->price}}"
                                            data-image="{{$product->image}}"
                                            data-quantity="{{$product->quantity}}"
                                    >Add to Cart
                                    </button>
                                </div>

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


@section("script")

    <script>
        $(document).ready(function() {

            window.cart = <?php echo json_encode($cart) ?>;
            console.log(window.cart)

            updateCartButton();

            $('.add-to-cart').on('click', function(event){

                var cart = window.cart || [];
                cart.push({
                    "id": $(this).data("id"),
                    "name": $(this).data("name"),
                    "original": $(this).data("original"),
                    "image": $(this).data("image"),
                    "quantity": $(this).data("quantity"),
                    "qty": $(this).prev("input").val()
                });

                window.cart = cart;

                $.ajax('/store/add-to-cart', {
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}", "cart":cart},
                    success: function (data, status, xhr) {

                    }
                });

                updateCartButton();
            });
        })

        function updateCartButton() {

            var count = 0;
            window.cart.forEach(function (item, i) {

                count += Number(item.qty);
            });

            $('#items-in-cart').html(count);
        }
    </script>

@endsection
