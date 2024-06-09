@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card mb-4">
                <h4 class="card-header" style="background: #008B8B; color: #fff">
                    <marquee behavior="" direction="">Welcome to Laravel POS Management</marquee>
                </h4>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar / Dashboard -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
