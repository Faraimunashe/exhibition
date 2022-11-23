<x-guest-layout>
    <div class="pagetitle" style="" id="space">
        <h1>Votes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Votes</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard" id="space">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Exhibition Voting Results</h5>
                        <ol class="list-group list-group-numbered">
                            @foreach ($votes as $vote)
                                @php
                                    $exhibitor = get_exhibition($vote->exhibition_id);
                                @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{$exhibitor->name}}</div>
                                        {{$exhibitor->phone}} || {{$exhibitor->address}}
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{$vote->total}}</span>
                                </li>
                            @endforeach
                        </ol><!-- End with custom content -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
