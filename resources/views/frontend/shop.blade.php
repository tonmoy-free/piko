@extends('frontend.master')
@section('content')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li>Shop</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- product-area-start -->
<div class="shop-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="shop-filter-wrap">
           <!--         <div class="filter-item">
                        <div class="shop-filter-item">
                            <div class="shop-filter-search">
                                <form>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Search..">
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Catagories</h2>
                            <ul>
                                @foreach ($categories as $category)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $category->category_name }} <span>{{ $category->rel_to_product->count() }}</span>
                                        <input type="radio" name="cat" class="category_id" value="{{ $category->id }}" {{$category->id == @$_GET['category_id'] ? 'checked' : ''  }}>
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Filter by price</h2>
                            <div class="shopWidgetWraper">
                                <div class="priceFilterSlider">
                                    <form  class="clearfix">
                                        <!-- <div id="sliderRange"></div>
                                        <div class="pfsWrap">
                                            <label>Price:</label>
                                            <span id="amount"></span>
                                        </div> -->
                                        <div class="d-flex">
                                            <div class="col-lg-6 pe-2">
                                                <label for="" class="form-label">Min</label>
                                                <input id="min" type="text" class="form-control" placeholder="Min" value="{{ @$_GET['min'] }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="" class="form-label">Max</label>
                                                <input id="max" type="text" class="form-control" placeholder="Max" value="{{ @$_GET['max'] }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-4">
                                            <button type="button" class="form-control bg-light price_range">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Color</h2>
                            <ul>
                                @foreach ($colors as $color)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $color->color_name }} <span>({{ $color->rel_to_inventory->count() }})</span>
                                        <input type="radio" class="color_id" name="color" value="{{ $color->id }}" {{ $color->id == @$_GET['color_id'] ? 'checked' : '' }}>
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="shop-filter-item">
                            <h2>Size</h2>
                            <ul>
                                @foreach ($sizes as $size)
                                <li>
                                    <label class="topcoat-radio-button__label">
                                        {{ $size->size_name }} <span>({{ $size->rel_to_inventory->count() }})</span>
                                        <input type="radio" class="size_id" name="size" value="{{ $size->id }}" {{ $size->id == @$_GET['size_id'] ? 'checked' : '' }} >
                                        <span class="topcoat-radio-button"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


         <!--           <div class="filter-item">
                        <div class="shop-filter-item new-product">
                            <h2>New Products</h2>
                            <ul>
                                <li>
                                    <div class="product-card">
                                        <div class="card-image">
                                            <div class="image">
                                                <img src="assets/images/new-product/1.png" alt="">
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h3><a href="product.html">Stylish Pink Coat</a></h3>
                                            <div class="rating-product">
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <span>30</span>
                                            </div>
                                            <div class="price">
                                                <span class="present-price">$120.00</span>
                                                <del class="old-price">$200.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-card">
                                        <div class="card-image">
                                            <div class="image">
                                                <img src="assets/images/new-product/2.png" alt="">
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h3><a href="product.html">Blue Bag</a></h3>
                                            <div class="rating-product">
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <span>30</span>
                                            </div>
                                            <div class="price">
                                                <span class="present-price">$120.00</span>
                                                <del class="old-price">$200.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-card">
                                        <div class="card-image">
                                            <div class="image">
                                                <img src="assets/images/new-product/3.png" alt="">
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h3><a href="product.html">Kids Blue Shoes</a></h3>
                                            <div class="rating-product">
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <span>30</span>
                                            </div>
                                            <div class="price">
                                                <span class="present-price">$120.00</span>
                                                <del class="old-price">$200.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->


                    <div class="filter-item">
                        <div class="shop-filter-item tag-widget">
                            <h2>Popular Tags</h2>
                            <ul>
                                <li>
                                    @foreach ($tags as $tag)
                                        <button  value="{{ $tag->id }}" class="btn btn-light m-1 tag">{{ $tag->tag_name }}</button>
                                    @endforeach
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="shop-section-top-inner">
                    <div class="shoping-product">
                        <p>We found <span>{{ $products->count() }}</span> for you!</p>
                    </div>
                    <div class="short-by">
                        <ul>
                            <li>
                                Sort by:
                            </li>
                            <li>
                                <select name="sort" class="sort">
                                    <option value="">Default Sorting</option>
                                    <option value="1" {{ @$_GET['sort'] == 1?'selected' : '' }}>Low To High</option>
                                    <option value="2" {{ @$_GET['sort'] == 2?'selected' : '' }}>High To Low</option>
                                    <option value="3" {{ @$_GET['sort'] == 3?'selected' : '' }}>A To Z</option>
                                    <option value="4" {{ @$_GET['sort'] == 4?'selected' : '' }}>Z To A</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-wrap">
                    <div class="row align-items-center">
                        @foreach ($products as $product)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="image">
                                    <img src="{{ asset('uploads/product/preview') }}/{{$product->preview }}" alt="">
                                    <div class="tag new">New</div>
                                </div>
                                <div class="text">
                                    <h2><a href="product-single.html">{{ $product->product_name }}</a></h2>
                                    <div class="rating-product">
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <span>130</span>
                                    </div>
                                    <div class="price">
                                        @if ( $product->discount)
                                           <span class="present-price">&#2547;200 </span>
                                           <del class="old-price">&#2547;100</del>
                                        @else
                                            <span class="present-price">&#2547;{{ $product->rel_to_inventory->first()->after_discount }}</span>
                                        @endif
                                    </div>
                                    <div class="shop-btn">
                                        <a class="theme-btn-s2" href="{{ route('product.details', $product->slug) }}">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product-area-end -->
@endsection

@section('footer_script')
 <script>


 $('.category_id').click(function(){
  var keyword = $('#search_input').val();
  var category_id = $("input:radio[class=category_id]:checked").val();
  var min = $('#min').val();
  var max = $('#max').val();
  var color_id = $("input:radio[class=color_id]:checked").val();
  var size_id = $("input:radio[class=size_id]:checked").val();
  var sort = $('.sort').val();

  var link = '{{ route('shop') }}'+'?keyword='+keyword+'&category_id='+category_id+'&min='+min+'&max='+max+'&color_id='+color_id+'&size_id='+size_id+'&sort='+sort;
  window.location.href=link;
 })

 $('.color_id').click(function(){
  var keyword = $('#search_input').val();
  var category_id = $("input:radio[class=category_id]:checked").val();
  var min = $('#min').val();
  var max = $('#max').val();
  var color_id = $("input:radio[class=color_id]:checked").val();
  var size_id = $("input:radio[class=size_id]:checked").val();
  var sort = $('.sort').val();

  var link = '{{ route('shop') }}'+'?keyword='+keyword+'&category_id='+category_id+'&min='+min+'&max='+max+'&color_id='+color_id+'&size_id='+size_id+'&sort='+sort;
  window.location.href=link;
 })

 $('.size_id').click(function(){
  var keyword = $('#search_input').val();
  var category_id = $("input:radio[class=category_id]:checked").val();
  var min = $('#min').val();
  var max = $('#max').val();
  var color_id = $("input:radio[class=color_id]:checked").val();
  var size_id = $("input:radio[class=size_id]:checked").val();
  var sort = $('.sort').val();

  var link = '{{ route('shop') }}'+'?keyword='+keyword+'&category_id='+category_id+'&min='+min+'&max='+max+'&color_id='+color_id+'&size_id='+size_id+'&sort='+sort;
  window.location.href=link;
 })

 $('.price_range').click(function(){
  var keyword = $('#search_input').val();
  var category_id = $("input:radio[class=category_id]:checked").val();
  var min = $('#min').val();
  var max = $('#max').val();
  var color_id = $("input:radio[class=color_id]:checked").val();
  var size_id = $("input:radio[class=size_id]:checked").val();
  var sort = $('.sort').val();

  var link = '{{ route('shop') }}'+'?keyword='+keyword+'&category_id='+category_id+'&min='+min+'&max='+max+'&color_id='+color_id+'&size_id='+size_id+'&sort='+sort;
  window.location.href=link;
 })
 </script>

 <script>
    $('.tag').click(function(){
        var tag_id = $(this).val();
        var link = '{{ route('shop') }}'+'?tag_id='+tag_id;
        window.location.href=link;
    })
 </script>
@endsection
