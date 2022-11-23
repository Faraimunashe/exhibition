<x-app-layout>
    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
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
                                        <h5 class="card-title">Products</h5>
                                    </div>
                                    <div class="col-md-2 mt-3 justify-end">
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModal">Add New</button>
                                    </div>
                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($products as $item)
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
                                                <td>{{ $item->description }}</td>
                                                <td>{{\App\Models\ProductImage::where('product_id', $item->id)->count()}}
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $item->id }}">
                                                        <i class="bi bi-upload"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"><i class="bi bi-pencil-square"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#smallModal{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="smallModal{{ $item->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('exhibitor-delete-product') }}">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}" required>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete {{ $item->name }} from products?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Yes delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- End Delete Modal-->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('exhibitor-update-product') }}">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}" required>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update Product</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <label for="inputText" class="col-sm-2 col-form-label">Name: </label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputText" class="col-sm-2 col-form-label">Description: </label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="description" class="form-control" value="{{ $item->description }}" required>
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
                                            </div><!-- End Edit Modal-->
                                            <div class="modal fade" id="uploadModal{{ $item->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('exhibitor-add-product-pic') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->id }}" required>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Upload Product Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <label for="inputText" class="col-sm-2 col-form-label">Image: </label>
                                                                    <div class="col-sm-10">
                                                                        <input type="file" name="file" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Upload image</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- End Edit Modal-->
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
                <form method="POST" action="{{ route('exhibitor-add-product') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name: </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Product name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Description: </label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" placeholder="Product Description" required>
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
