@extends("layouts.app-master")

@section('title') {{ 'Orders' }} @endsection

@section('content')
    @auth
        @role("admin")
        <div class="body flex-grow-1">
            <h1>Orders</h1>
            <div class="container bg-secondary bg-opacity-10 p-2" style="border-radius: 10px;">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time Created</th>
                        <th scope="col">Products</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col"><span style="display: inline-block;width: 105px">Status</span>
                            Action
                        </th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php $old_val = "" ?>
                    <?php $limit = 0 ?>
                    <?php $total_price = 0 ?>
                    <?php $old_val_num = 0 ?>
                    <?php $test = []; ?>
                    @foreach($arr_temp as $key => $order)

                        <?php $next = next($arr_temp);?>
                        @if($order["position"] == array_search($order["time"],$unique_val_arr)
                            && $old_val == $order["position"])
                            <tr style="margin: auto;">

                                <td class="align-middle">{{ $order["time"] }}</td>
                                <td class="align-middle">{{ date('h:i:s A', strtotime($order["created_at"])) }}</td>
                                <td class="align-middle">{{$order["product_name"]}}</td>
                                <td class="align-middle">{{$order["quantity"]}}</td>
                                <td class="align-middle">${{number_format($order["total"])}}</td>

                                <td class="align-middle text-danger bolder">
                                    <form method="post" action="{{route("orders.update_specified",$order["user_id"])}}">
                                        @csrf

                                        <input type="text" name="status" value="{{$order["status"]}}" readonly
                                               class="transparent-input"
                                               style="width: 100px">
                                        <input type="hidden" name="product_name" class="input_status"
                                               value="{{$order["product_name"]}}"/>
                                        <input type="hidden" name="status" class="input_status"
                                               value="{{$order["status"]}}"/>
                                        <input type="hidden" name="user_id" class="input_user_id"
                                               value="{{$order["user_id"]}}"/>
                                        <input type="hidden" name="order_details_id"
                                               class="input_order_details_id" value="{{$order["id"]}}"/>


                                        <button type="submit" class="btn btn-primary">
                                            Details
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            <?php
                            if ($order["status"] == "Cancel") {
                                $total_price = $total_price + 0;
                            } else {
                                $total_price = $total_price + $order["total"];
                            }
                            ?>
                            <?php
                            $next_val = $next["time"] ?? "next_val";
                            $cur_val = $order["time"] ?? "cur_val";
                            ?>
                            @if($next_val != $cur_val)
                                <tr style="margin: auto;border-style: none">
                                    <td class="align-middle" style="border:transparent !important;">
                                        <strong>Total: {{$total_price}} </strong>
                                        <?php $total_price = 0 ?>
                                    </td>
                                </tr>
                            @endif

                        @elseif($order["position"] ==
                            array_search($order["time"],$unique_val_arr)
                            && $old_val != $order["position"])
                            @if($limit > 0)
                                <tr style="margin: auto;">
                                    <td class="align-middle" style="border-bottom-width:0">
                                        <br></td>
                                </tr>
                            @endif

                            <?php ++$limit ?>

                            <tr style="margin: auto;">
                                <td class="align-middle">{{ $order["time"] }}</td>
                                <td class="align-middle">{{ date('h:i:s A', strtotime($order["created_at"])) }}</td>
                                <td class="align-middle">{{$order["product_name"]}}</td>
                                <td class="align-middle">{{$order["quantity"]}}</td>
                                <td class="align-middle">${{number_format($order["total"])}}</td>

                                <td class="align-middle text-danger bolder">
                                    <form method="post" action="{{route("orders.display",$order["user_id"])}}">
                                        @csrf
                                        <input type="text" name="status" value="{{$order["status"]}}" readonly
                                               class="transparent-input"
                                               style="width: 100px">
                                        <input type="hidden" name="product_name" class="input_status"
                                               value="{{$order["product_name"]}}"/>
                                        <input type="hidden" name="status" class="input_status"
                                               value="{{$order["status"]}}"/>
                                        <input type="hidden" name="user_id" class="input_user_id"
                                               value="{{$order["user_id"]}}"/>
                                        <input type="hidden" name="order_details_id"
                                               class="input_order_details_id" value="{{$order["id"]}}"/>
                                        <button type="submit" class="btn btn-primary">
                                            Details
                                        </button>
                                    </form>
                                </td>


                                <?php $old_val = $order["position"] ?>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td class="align-middle text-danger bolder"
                            style="border-bottom-width:0">

                            <input type="hidden" value="" class="test_thu">
                            <button class="btn btn-primary form-control save-btn"
                                    type="submit">Save
                            </button>
                            {{--                            <a class="btn btn-primary form-control save-btn"--}}
                            {{--                               href="{{route("orders.display")}}">Save</a>--}}
                        </td>


                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="test">

        </div>
        @if(session()->has('success'))
            <div x-data="{ show: true }" x-show="show"
                 x-init="setTimeout(() => show = false, 3000)" class="card"
                 style="width: 16rem; position: fixed;bottom: 1rem;right: 1rem;padding: 5px; background-color: #d1e7dd">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @endrole
    @endauth
@endsection

@section("style")

@endsection


@section("script")
    <script>

        $(document).ready(function () {

            let selected_status = $(".select_status");
            let input_status = $(".input_status");
            let input_user_id = $(".input_user_id");
            let input_order_details_id = $(".input_order_details_id");
            let save_button = $(".save-btn")

            var url = window.location.href;
            var id = url.split("/");
            var user_id = id[4];
            var order_details_id = 0;
            var status_order_details = "";
            var order_detils_update_array = [];

            $(selected_status).each(function (index) {
                $(this).change(function () {
                    var optionSelected = $(this).find("option:selected");
                    var valueSelected = optionSelected.val();

                    input_status.eq(index).val(valueSelected);
                    input_user_id.eq(index).val(user_id);
                    input_order_details_id.eq(index).val(index);
                    console.log(input_status[index]);
                    console.log(input_user_id[index]);
                    console.log(input_order_details_id[index]);

                    switch (valueSelected) {
                        case "Processing":
                            $(this).removeClass("bg-warning");
                            $(this).removeClass("bg-danger");
                            $(this).addClass("bg-primary");
                            break;
                        case "Shipping":
                            $(this).removeClass("bg-primary");
                            $(this).removeClass("bg-danger");
                            $(this).addClass("bg-warning");
                            break;
                        case "Cancel":
                            $(this).removeClass("bg-primary");
                            $(this).removeClass("bg-warning");
                            $(this).addClass("bg-danger");
                            break;
                    }
                });
            });

            $(save_button).click(function (e) {
                if (confirm("are you sure to save it?")) {
                    if (order_detils_update_array.length > 0) {
                        $(".test_thu").val(order_detils_update_array);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN':
                                    $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: 'http://127.0.0.1:8000/orders/updateId',
                            type: "json",
                            method: "POST",
                            data: order_detils_update_array,
                            success: function (response) { // What to do if we succeed
                                // alert("Updated Successful!");
                                console.log("ok");
                            },
                            error: function (response) {
                                alert("Updated Failed!");
                            }
                        });

                    } else {
                        alert("You have not changed anything!")
                    }
                }
            });

        })

    </script>
@endsection
