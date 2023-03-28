<section id="cart_sidebar" class="cart_sidebar">
    <div class="container">
      <div class="close"><i class="bi bi-x-circle-fill close_btn"></i></div>
      <div class="cart_items_count d-flex align-items-center justify-content-end text-dark pt-3 gap-1">
         <i class="bi bi-bag"></i>
         @if (session()->get('cart') > 0)
            <span>{{count(session('cart')) ?? 0}} Items</span>
            @else
            <span>0 Items</span>
         @endif
      </div>
        <div class="row">
            <div class="col-12">
                <div class="cart_wrap">
                    <div class="cart_box">
                        @php
                            $total = 0;

                        @endphp
                        <table class="table table-bordered">
                            @if((session('cart') > 0))
                            <thead>
                            <tr>
                                <th style="width: 5%;">Qty</th>
                                <th style="width: 25%;">Image</th>
                                <th style="width: 15%;">Price</th>
                                <th style="width: 5%;">Action</th>
                            </tr>
                            </thead>
                            @endif
                            <tbody>
                                @if((session('cart') > 0))
                                    @foreach (session('cart') as $id =>$cart)

                                        <tr class="cart_wrap" data-id="{{ $id }}">
                                            <td>{{$cart['quantity']}}</td>
                                            <td>
                                                <img src="{{ asset(''.$cart['image']) }}" alt="{{ $cart['title'] ?? '' }}" width="30" height="30" style="object-fit: cover;" class="rounded">
                                            </td>

                                            <td><span class="take_sign">&#2547;</span> {{ number_format($cart['price'] ?? '0.00', 2) }}</td>
                                            <td class="text-center remove-from-cart " data-th=""><i class="bi bi-trash cart_trash"></i></td>
                                            {{-- <input type="hidden" class="cart_id" value="{{$id }}"> --}}
                                        </tr>

                                        @php
                                            $total += $cart['price'] * $cart['quantity'];
                                        @endphp
                                         <a href="{{ route('buy.now',$cart['id']) }}" class="buy_btn"><i class="bi bi-bag-plus-fill"></i> Buy Now</a>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">
                                        <div class="bg-warning text-white d-flex justify-content-center align-items-center px-3 rounded py-1" style="font-size: 14px;">
                                            <div><b>Cart is empty</b></div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>

                      </table>
                      @if(session('cart') > 0)
                      <div class="bg-success text-white d-flex justify-content-between align-items-center px-3 rounded py-1" style="font-size: 14px;">
                        <div><b>Total Price</b></div>
                        <div><span class="take_sign text-white">&#2547;</span> <b>{{ number_format($total ?? '0.00', 2) }}</b></div>
                      </div>





                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
