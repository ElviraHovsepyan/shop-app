<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of products') }}
        </h2>
    </x-slot>

    <section class="section-products">
        <div class="container">
            <form method="post" action="{{ route('products.filtered') }}" class="mt-6 space-y-6">

            <div class="row justify-content-center text-center">
                <div class="col-md-6 offset-4">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort By
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <button type="submit" class="dropdown-item" name="sort" value="name-asc">Name asc</button>
                                    <button type="submit" class="dropdown-item" name="sort" value="name-desc">Name desc</button>
                                    <button type="submit" class="dropdown-item" name="sort" value="price-asc">Price ask</button>
                                    <button type="submit" class="dropdown-item" name="sort" value="price-desc">Price desk</button>
                                    {{--<div class="dropdown-divider"></div>--}}
                                    {{--<a class="dropdown-item" href="#">Quantity</a>--}}
                                </div>
                            </li>
                        </ul>
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ old('search') }}" id="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </nav>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('products.create') }}"><button type="button" class="btn btn-primary shop-button">Add product</button></a>
                    {{--<button type="button" class="btn btn-success shop-button">Buy Now</button>--}}
                    {{--<div class="product_fav"><i class="fas fa-heart"></i></div>--}}
                </div>
                <div class="col-md-8 col-lg-6">
                    <span style="visibility: hidden">djchbhcjdbhc</span>
                </div>
            </div>

                <div class="row justify-content-center" id="basic-example-filters" data-mdb-items=".basic-example-item" data-mdb-auto-filter="true">
                    @foreach($filters as $filter_group)
                        <div class="col-md-3" data-mdb-filter="color">
                            <span class="fa-lg font-bold">{{ $filter_group->name }}</span>
                                @foreach($filter_group->filters as $filter)
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="filters" data-id="{{ $filter->id }}">
                                        <label class="form-check-label" for="inlineRadio1">{{ $filter->name }}</label>
                                    </div>
                                @endforeach
                        </div>
                    @endforeach

                        <input type="hidden" name="filters_value" id="filters_value" value="{{ old('filters_value') }}" >
                        <div class="col-md-3 offset-6">
                            <button type="submit" class="btn btn-primary mt-3">
                                Get results
                            </button>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('products') }}"><button type="button" class="btn btn-primary mt-3" id="resetButton">
                            Clear all filters
                        </button></a>
                    </div>
                </div>

            <div class="row">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Single Product -->
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('products.get', $product->id) }}" style="display: block">
                        <div id="product-2" class="single-product">
                            <div class="part-1" style="background: url('{{ asset("images/".$product->pic) }}')"></div>
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

            @if($count > 1)

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <button class="page-link"  type="submit" name="page" value="1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </button>
                    </li>
                    <li class="page-item">
                        <button class="page-link"  type="submit" name="page" value="{{ old('page') > 1 ? old('page') - 1 : 1 }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </button>
                    </li>

                        @for($x = 1; $x <= $count; $x++)
                            <li class="page-item {{ old('page', 1) == $x ? 'active' : ''}}"><button class="page-link" type="submit" name="page" value="{{ $x }}">{{ $x }}</button></li>
                        @endfor

                    <li class="page-item">
                        <button class="page-link"  type="submit" name="page" value="{{ old('page') < $count ? old('page') + 1 : $count }}" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Previous</span>
                        </button>
                    </li>
                    <li class="page-item">
                        <button class="page-link"  type="submit" name="page" value="{{ $count }}"  aria-label="Next">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                            <span class="sr-only">Next</span>
                        </button>
                    </li>
                </ul>
            </nav>

            @endif

            </form>

        </div>
    </section>
</x-app-layout>
