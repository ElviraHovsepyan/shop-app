<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of products') }}
        </h2>
    </x-slot>

    <section class="section-products">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-2 offset-11">
                    <a href="{{ route('products.create') }}"><button type="button" class="btn btn-primary shop-button">Add product</button></a>
                    {{--<button type="button" class="btn btn-success shop-button">Buy Now</button>--}}
                    {{--<div class="product_fav"><i class="fas fa-heart"></i></div>--}}
                </div>
                <div class="col-md-8 col-lg-6">
                    <div class="header">

                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Single Product -->
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('products.get', $product->id) }}" style="display: block">
                        <div id="product-2" class="single-product">
                            <div class="part-1" style="background: url('{{ asset("images/".$product->pic) }}')">
                                {{--<span class="discount">15% off</span>--}}
                                {{--<span class="new">new</span>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                    {{--<li><a href="#"><i class="fas fa-heart"></i></a></li>--}}
                                    {{--<li><a href="#"><i class="fas fa-plus"></i></a></li>--}}
                                    {{--<li><a href="#"><i class="fas fa-expand"></i></a></li>--}}
                                {{--</ul>--}}
                            </div>
                            <div class="part-2">
                                    <h3 class="product-title">{{ $product->name }}</h3>
                                    <h4 class="product-old-price">$79.99</h4>
                                    <h4 class="product-price">$ {{ $product->price }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
