<x-layouts.front :title="__('Home')">
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="/storage/front/img/banner.webp" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            <p class="px-4 py-2 rounded">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, veritatis praesentium. Reprehenderit officia quo rem sapiente omnis molestiae accusamus expedita minima ab voluptatem ex, a facere tempora praesentium, blanditiis minus!</p>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="/storage/front/img/banner2.webp" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            <p class="px-4 py-2 rounded">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit sit quas ut, commodi distinctio inventore blanditiis ratione tenetur voluptatum fuga provident, omnis excepturi ab! Totam animi corporis maxime adipisci! Ipsa.</p>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-md-7 text-start">
                        <h1>Latest Products</h1>
                    </div>
                    <div class="col-md-3 text-end"><a href="/shop">View More...</a></div>
                </div>
                <div class="tab-content mt-3">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item border border-secondary border-top-0 rounded-bottom">
                                            <div class="fruite-img">
                                                <img src="{{$product->cover}}" class="img-fluid w-100 rounded-top" alt="" style="height:40vh; object-fit:scale-down;">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->category}}</div>
                                            <div class="p-2">
                                                <h4 class="text-center">{{$product->name}}</h4>
                                                <p class="text-dark fw-bold text-center mb-2">Ksh. {{$product->price}} per pc</p>
                                                <div class="">
                                                    <a href="/product/{{$product->id}}" class="btn border border-secondary rounded-pill px-3 text-primary w-100 mb-2"><i class="fa fa-eye text-primary"></i> View</a>
                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary w-100">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
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
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselGallery" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselGallery" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselGallery" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselGallery" data-bs-slide-to="3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row g-2">
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner.webp" class="d-block w-50 h-100" alt="Slide 1"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner2.webp" class="d-block w-50 h-100" alt="Slide 2"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner.webp" class="d-block w-50 h-100" alt="Slide 3"></div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="row g-2">
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner2.webp" class="d-block w-50 h-100" alt="Slide 4"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner.webp" class="d-block w-50 h-100" alt="Slide 5"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner2.webp" class="d-block w-50 h-100" alt="Slide 6"></div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="row g-2">
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner.webp" class="d-block w-100" alt="Slide 7"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner2.webp" class="d-block w-100" alt="Slide 8"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner.webp" class="d-block w-100" alt="Slide 9"></div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="row g-2">
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner2.webp" class="d-block w-100" alt="Slide 10"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner.webp" class="d-block w-100" alt="Slide 11"></div>
                    <div class="col-12 col-md-4"><img src="/storage/front/img/banner2.webp" class="d-block w-100" alt="Slide 12"></div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->

    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="service-item bg-secondary rounded border border-secondary">
                        <img src="/storage/front/img/featur-1.jpg" class="img-fluid rounded-top w-100" style="height:45vh" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-primary text-center p-4 rounded">
                                <h5 class="text-white">Fresh Fruits</h5>
                                <!-- <h3 class="mb-0">20% OFF</h3> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-item bg-dark rounded border border-dark">
                        <img src="/storage/front/img/featur-3.jpg" class="img-fluid rounded-top w-100" style="height:45vh" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-light text-center p-4 rounded">
                                <h5 class="text-primary">Exotic Vegetables</h5>
                                <!-- <h3 class="mb-0">Tasty</h3> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-item bg-primary rounded border border-primary">
                        <img src="/storage/front/img/featur-2.jpg" class="img-fluid rounded-top w-100" style="height:45vh" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-secondary text-center p-4 rounded">
                                <h5 class="text-white">Quality Cereals</h5>
                                <!-- <h3 class="mb-0">Discount 30$</h3> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->

</x-layouts.front>