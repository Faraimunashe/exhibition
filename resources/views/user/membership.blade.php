<x-guest-layout>
    <div class="pagetitle" style="padding-top: 25px;" id="space">
        <h1>Membership</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Membership</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard" id="space">
        <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        @if (is_null($member))
                            <div class="card-header">
                                Membership Application Form
                            </div>
                            <div class="card-body">
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
                                <form method="POST" action="{{route('user-apply-membership')}}">
                                    @csrf
                                    <div class="row mt-2 mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">FirstName: </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="fname" class="form-control" placeholder="first name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">LastName: </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="lname" class="form-control" placeholder="first name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Phone: </label>
                                        <div class="col-sm-10">
                                            <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Gender: </label>
                                        <div class="col-sm-10">
                                            <select name="sex" class="form-control" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Address: </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address" class="form-control" placeholder="Home Address" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary" type="submit">Submit Application</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="card-header">
                                Membership Details
                            </div>
                            <div class="card-body">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Firstname</div>
                                    {{$member->fname}}
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Lastname</div>
                                    {{$member->lname}}
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Gender</div>
                                    {{$member->sex}}
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Phone</div>
                                    {{$member->phone}}
                                </div>
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Address</div>
                                    {{$member->address}}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Subscription Status
                        </div>
                        <div class="card-body">
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
                            @if (is_null($member))
                                <div class="alert alert-danger mt-3" role="alert">
                                    You have no membership record
                                </div>
                            @else
                                @if($member->paid)
                                    <ul class="list-group mt-4">
                                        <li class="list-group-item">
                                            <i class="bi bi-check-circle me-1 text-success"></i>
                                            Application Paid
                                        </li>
                                    </ul>
                                @else
                                    <ul class="list-group mt-4">
                                        <li class="list-group-item">
                                            <i class="bi bi-x-circle me-1 text-danger"></i>
                                            Application Payment Required
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-credit-card me-1"></i>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#largeModal">Pay Application Fee</button>
                                        </li>
                                    </ul>
                                @endif
                            @endif
                            {{-- <div class="list-group mt-4">
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Subscribed</h5>
                                  </div>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('user-apply-fee') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Membership Application Fee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="amount" value="5" required>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Phone: </label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" class="form-control" placeholder="Ecocash/Onemoney number" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Start payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Large Modal-->
</x-guest-layout>
