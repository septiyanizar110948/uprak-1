@extends('admin.admin_master')

@section('index')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Detail User</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Detail User</h5>

        <table class="table table-borderless">
            <tr>
                <td>Id</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Role</td>
                <td>{{ $user->role }}</td>
            </tr>
            <tr>
                <td>Created At</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
