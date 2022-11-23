<x-guest-layout>
    <div class="pagetitle" style="padding-top: 25px;" id="space">
        <h1>Apply Exhibition</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Exhibit</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard" id="space">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Application Form
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
                            <form method="POST" action="{{route('user-apply-exhibit')}}">
                                @csrf
                                <div class="row mt-4">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Company name" required>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group">
                                        <label for="name">Contact Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone number" required>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group">
                                        <label for="name">Company Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Company address" required>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <button class="btn btn-primary btn-block">
                                        Apply Exhibition
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</x-guest-layout>
