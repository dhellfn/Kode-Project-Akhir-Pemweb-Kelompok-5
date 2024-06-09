@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Add User</h4>
                        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addUser">
                            <i class="fa fa-plus"></i> Add New Users
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->is_admin == 1 ? 'Admin' : 'Cashier' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Changed 'data-toggl' to 'data-toggle' and corrected 'btnt-sm' to 'btn-sm' -->
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" 
                                                data-target="#editUser{{ $user->id }}">
                                                <i class="fa fa-pen-to-square"></i> Edit
                                            </a><a href="#" data-toggle="modal" 
                                                data-target="#deleteUser{{ $user->id }}" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Del</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal of Edit User Detail -->
                                <div class="modal right fade" id="editUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Users</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                
                                            </div>
                                            <div class="modal-body">
                                                <!-- Set the form action dynamically and used @method('PUT') for updating the user -->
                                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT') <!-- Add this to indicate a PUT request -->
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" readonly value="{{ $user->password }} class="form-control">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Confirm Password</label>
                                                        <input type="password" name="confirm_password" class="form-control">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Role</label>
                                                        <select name="is_admin" class="form-control">
                                                            <option value="1"@if($user->is_admin == 1)
                                                                selected
                                                            @endif>Admin</option>
                                                            <option value="2"@if($user->is_admin == 2)
                                                                selected
                                                            @endif>Cashier</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">Update User</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal of Delete User Detail -->
                                <div class="modal right fade" id="deleteUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete Users</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                {{ $user->id }}
                                            </div>
                                            <div class="modal-body">
                                                <!-- Set the form action dynamically and used @method('PUT') for updating the user -->
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete') <!-- Add this to indicate a PUT request -->
                                                        <p>Are you sure want to delete this  {{ $user->name }} ? </p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">
                                                            Cancel</button>

                                                        <button type="submit" class="btn btn-danger">
                                                            Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Search User</h4>
                    </div>
                    <div class="card-body">
                        <!-- Search functionality goes here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal of adding new user --}}
    <div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Add Users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="is_admin" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Cashier</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-block">Save User</button>
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
