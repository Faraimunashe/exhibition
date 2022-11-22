<x-guest-layout>
    <div class="pagetitle" style="padding-top: 25px;" id="space">
        <h1>{{$exhibitor->name}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard" id="space">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">{{$product->name}}</h5>
                          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item">
                                    <img src="{{asset('assets/img/slides-1.jpg')}}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{$product->name}}</h5>
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                                <div class="carousel-item active">
                                    <img src="{{asset('assets/img/slides-2.jpg')}}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('assets/img/slides-3.jpg')}}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                    </div>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$exhibitors->links('pagination::bootstrap-4')}}
    </section>
</x-guest-layout>
