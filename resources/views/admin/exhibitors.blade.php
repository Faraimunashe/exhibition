<x-app-layout>
    <div class="pagetitle">
        <h1>Exhibitors</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Exhibitors</li>
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
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5 class="card-title">Exhibitors</h5>
                                    </div>
                                    <div class="col-md-2 mt-3 justify-end">
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModal">Add New</button>
                                    </div>
                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Account ID</th>
                                            <th scope="col">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($exhibitors as $item)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">
                                                        @php
                                                            $count++;
                                                            echo $count;
                                                        @endphp
                                                    </a>
                                                </th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->user_id }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Change</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#smallModal{{ $item->id }}">Remove</button>
                                                </td>
                                            </tr>
                                            {{-- <div class="modal fade" id="smallModal{{ $item->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('admin-delete-item') }}">
                                                            @csrf
                                                            <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete item</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete {{ $item->name }} from vehicle categories?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Yes delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('admin-edit-item') }}">
                                                            @csrf
                                                            <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit item</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <label for="inputText" class="col-sm-2 col-form-label">item: </label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin-add-exhibitor') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Exhibitor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Select User</label>
                            <div class="col-sm-10">
                                <select name="user_id" class="form-control" required>
                                    <option selected disabled>Selected Disabled</option>
                                    @foreach (\App\Models\User::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Phone </label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Address </label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Large Modal-->
</x-app-layout>
