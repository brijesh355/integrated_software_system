@extends('layouts.app')
@section('title', 'User Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update User Profile</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('user.dashboard')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{route('user.update.profile')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{old('name', @$userAuth->name ?? '')}}" class="form-control" placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Email</label>
                                <input type="email" name="email" id="email" value="{{old('email', @$userAuth->email ?? '')}}" class="form-control" placeholder="Email">
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Password</label>
                                <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control" placeholder="Password">
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" value="{{old('confirm_password')}}" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Profile Pic</label>
                                <input type="file" name="profile_pic" id="profile_pic" class="form-control">
                            </div>
                        </div> 
                    </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('user.update.profile')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customjs')
    <script>
    </script>
@endsection
