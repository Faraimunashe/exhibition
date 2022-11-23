<x-guest-layout>
    <div class="pagetitle" style="" id="space">
        <h1>Home</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Exhibitors</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard" id="space">
        <div class="row">
            @foreach ($exhibitors as $ex)
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$ex->name}}</h5>
                            <p> <strong>Phone: </strong>{{$ex->phone}}. <strong>Address: </strong>{{$ex->address}}.</p>

                            <div style="float: right;">
                                <button type="button" disabled class="btn btn-success mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Votes for this exhibitor">
                                    Products <span class="badge bg-white text-primary">{{\App\Models\Product::where('exhibition_id', $ex->id)->count()}}</span>
                                </button>
                                @if (hasVoted())
                                    <button disabled type="button" class="btn btn-primary mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Votes for this exhibitor">
                                        Vote <span class="badge bg-white text-primary">{{\App\Models\Vote::where('exhibition_id', $ex->id)->count()}}</span>
                                    </button>
                                @else
                                    @if (!isVoter())
                                        <button disabled type="button" class="btn btn-primary mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Votes for this exhibitor">
                                            Vote <span class="badge bg-white text-primary">{{\App\Models\Vote::where('exhibition_id', $ex->id)->count()}}</span>
                                        </button>
                                    @else
                                        <a href="{{route('user-vote', $ex->id)}}" class="btn btn-primary mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Votes for this exhibitor">
                                            Vote <span class="badge bg-white text-primary">{{\App\Models\Vote::where('exhibition_id', $ex->id)->count()}}</span>
                                        </a>
                                    @endif
                                @endif
                                <a href="{{route('user-products',$ex->id)}}" class="btn btn-dark mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Votes for this exhibitor">
                                    See <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$exhibitors->links('pagination::bootstrap-4')}}
    </section>
</x-guest-layout>
