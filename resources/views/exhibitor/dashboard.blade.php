<x-app-layout>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            @foreach ($products as $product)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @php
                                    $imgCount = 0;
                                @endphp
                                @foreach (\App\Models\ProductImage::where('product_id', $product->id)->get() as $img)
                                    @if ($imgCount == 0)
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$imgCount}}" aria-label="Slide {{$imgCount+1}}" class="active" aria-current="true"></button>
                                    @else
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$imgCount}}" aria-label="Slide {{$imgCount+1}}"></button>
                                    @endif
                                    @php
                                        $imgCount++;
                                    @endphp
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach (\App\Models\ProductImage::where('product_id', $product->id)->get() as $img)
                                    @if ($counter == 0)
                                        <div class="carousel-item active">
                                            <img src="{{asset('images')}}/{{$img->file}}" class="d-block w-100" height="300" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{$product->name}}</h5>
                                                <p>{{$product->description}}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img src="{{asset('images')}}/{{$img->file}}" class="d-block w-100" height="300" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{$product->name}}</h5>
                                                <p>{{$product->description}}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach
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
    </section>
</x-app-layout>
