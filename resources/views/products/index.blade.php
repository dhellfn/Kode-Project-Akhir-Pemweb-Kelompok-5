@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Products</h4>
                    <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addProductModal">
                        <i class="fa fa-plus"></i> Add New Product
                    </a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Alert Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if ($product->alert_stock >= $product->quantity)
                                        <span class="badge badge-danger">Low Stock > {{ $product->alert_stock }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $product->alert_stock }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editProductModal{{ $product->id }}">
                                            <i class="fa fa-pen-to-square"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteProductModal{{ $product->id }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Product Modal -->
                            <div class="modal right fade" id="editProductModal{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editProductModalLabel{{ $product->id }}">Edit Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('products.update', $product->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="product_name">Product Name</label>
                                                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="brand">Brand</label>
                                                    <input type="text" name="brand" value="{{ $product->brand }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alert_stock">Alert Stock</label>
                                                    <input type="number" name="alert_stock" value="{{ $product->alert_stock }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" cols="30" rows="2" class="form-control" required>{{ $product->description }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning btn-block">Update Product</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Product Modal -->
                            <div class="modal right fade" id="deleteProductModal{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="deleteProductModalLabel{{ $product->id }}">Delete Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <p>Are you sure you want to delete {{ $product->product_name }}?</p>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Search Products</h4>
                </div>
                <div class="card-body">
                    <!-- Search functionality goes here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal right fade" id="addProductModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addProductModalLabel">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="alert_stock">Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="2" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 19vh;
    }
    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
</style>
@endsection
