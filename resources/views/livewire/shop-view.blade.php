<div class="container-fluid fruite py-3">

    <div class="container py-5">
        <div class="row g-4 d-flex justify-content-between mb-3">
            <div class="col-md-3">
                <div class="input-group w-100 ">
                    <input type="text" class="form-control" placeholder="keywords..." aria-describedby="search-icon-2" wire:model.li="keyword" wire:change="search">
                    <!-- <span id="search-icon-2" class="input-group-text" style="cursor: pointer;"><i class="fa fa-search"></i></span> -->
                </div>
            </div>
            <div class="col-md-3">
                <!-- dropdown menu -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($this->sorts as $criterior )
                        <li><button class="dropdown-item text-capitalize" wire:click="sort('{{ $criterior['name'] }}', '{{ $criterior['order'] }}')">{{$criterior['title']}}</button></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-sm-3">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="mb-3 d-none d-sm-block">
                            <h4>Filter By:</h4>
                            <ul class="list-unstyled fruite-categorie" style="cursor:pointer;">
                                @foreach ($this->categories as $category)
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a wire:click="filter('{{ $category }}')">{{$category}}</a>
                                        <span>({{$this->allproducts->where('category',$category)->count()}})</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <h4 class="mb-2">Filter By Price Above:</h4>
                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="5000" value="0" oninput="amount.value=rangeInput.value" wire:change="filterPrice(rangeInput.value)">
                            <output id="amount" name="amount" min-velue="0" max-value="5000" for="rangeInput">{{$price}}</output>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="mb-3">Discounted products</h4>
                        @foreach ($products->where('discount','!=',0) as $prod)
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="{{$prod->cover}}" class="img-fluid rounded" alt="">
                            </div>
                            <div>
                                <h6 class="mb-2">{{$prod->name}}</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">Ksh. {{$prod->price}}</h5>
                                    <h5 class="text-danger text-decoration-line-through">{{($prod->price)-($prod->discount)}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row g-4 justify-content-center">
                    @foreach ($products as $product)
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="rounded position-relative fruite-item border border-secondary border-top-0 rounded-bottom">
                            <div class="fruite-img">
                                <img src="{{$product->cover}}" class="img-fluid w-100 rounded-top" alt="" style="height:40vh;object-fit:scale-down;">
                            </div>
                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->category}}</div>
                            <div class="p-2">
                                <h4 class=" ms-2">{{$product->name}}</h4>
                                <p class="text-dark fw-bold mb-2 ms-2">Ksh. {{$product->price}}</p>
                                <div class="">
                                    <a href="/product/{{$product->id}}" class="btn border border-secondary rounded-pill px-3 text-primary w-100 mb-2"><i class="fa fa-eye text-primary"></i> View</a>
                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary w-100" wire:click="addtoCart('{{ $product->id }}')">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i>Add to Cart
                                    </button>
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