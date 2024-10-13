@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($recent_viewed as $product)


        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="product-item">
                <div class="image">
                    <img src="{{ asset('uploads/product/preview/') }}/{{ $product->preview }}" alt="">
                    @if ( $product->discount)

                      <div class="tag sale">-{{  $product->discount}}%</div>
                    @else
                    <div class="tag new">New</div>
                    @endif

                </div>
                <div class="text">
                    <h2><a href="{{ route('product.details',$product->slug) }}">{{ $product->product_name }}</a></h2>
                    @php
                        $avg = 0;
                        $reviews = App\Models\OrderProduct::where('product_id',  $product->id)->whereNotNull('review')->get();
                        $total_star = App\Models\OrderProduct::where('product_id',  $product->id)->whereNotNull('review')->sum('star');
                        if ($reviews->count() != 0) {
                            $avg= $total_star/$reviews->count();
                        }
                    @endphp
                    <div class="rating-product">
                        @for ($i=1; $i<=$avg; $i++)
                        <i class="fi flaticon-star"></i>
                        @endfor
                        <span>{{ $reviews->count() }}</span>
                    </div>
                     {{ $product->rel_to_inventory }}
                    <div class="price">
                        @if ( $product->discount)
                           <span class="present-price">&#2547;200</span>
                           <del class="old-price">&#2547;</del>
                        @else
                            <span class="present-price">&#2547;200</span>
                        @endif

                    </div>
                    <div class="shop-btn">
                        <a class="theme-btn-s2" href="{{ route('product.details',$product->slug) }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
