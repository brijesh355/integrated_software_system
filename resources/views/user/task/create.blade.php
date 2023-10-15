@extends('layouts.app')
@section('title', 'User Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Task</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('user.update.task') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="form-control" placeholder="Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Due Date</label>
                                    <input type="text" name="due_date" id="due_date"
                                        value="{{ old('due_date') }}" class="form-control"
                                        placeholder="Due Date">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="active" @if (old('status') == 'active') {{ 'selected' }} @endif>
                                            Active</option>
                                        <option value="inactive"
                                            @if (old('status') == 'inactive') {{ 'selected' }} @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('user.update.profile') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customjs')
    <script type="text/javascript">
        $( function() {
        $( "#due_date" ).datepicker({
            minDate: 0,
        });
    });
    </script>
@endsection
