<x-app-layout>
    <div class="pagetitle">
        <h1>Votes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Votes</li>
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
            </div><!-- End Left side columns -->
        </div>
    </section>
</x-app-layout>
