@extends('layouts.app')
@section('title', 'User Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Task List</h1>
                </div>
                <div class="col-sm-4">
                    <form action="" method="GET">
                    <div class="mb-3">
                        <label for="name">Status</label>
                        <select class="form-control" id="status_filter" name="status_filter">
                            <option value="">Select Status</option>
                            <option value="Inprogress">{{ 'Inprogress' }}</option>
                            <option value="Completed">{{ 'Completed' }}</option>
                        </select>
                    </div>
                    <button type="submit" id="Filter" class="btn btn-primary">Filter</button>
                </form>
                </div>
                <div class="col-sm-4 text-right">
                    <a href="{{ route('user.create.task') }}" class="btn btn-primary">Create Task</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route('user.taskList') }}'"
                                class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="keyword" value="{{ Request::get('keyword') }}"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th width="100">Status</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($taskList->isNotEmpty())
                                <?php $i = 1; ?>
                                @foreach ($taskList as $key => $task)
                                    <tr>
                                        <td> <?php echo $i; ?></td>
                                        <td>{{ $task->title ? $task->title : 'N/A' }}</td>
                                        <td>{{ $task->due_date ? $task->due_date : 'N/A' }}</td>
                                        <td>{{ $task->description ? $task->description : 'N/A' }}</td>
                                        <td>
                                            @if ($task->status == 'Inprogress')
                                                <span>{{ 'Inprogress' }}</span>
                                            @else
                                                <span>{{ 'Completed' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit.task', $task->id) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('user.delete.task', $task->id) }}"
                                                class="text-danger w-4 h-4 mr-1">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">{{ 'Record(s) Not Found.' }}</td>
                                </tr>

                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $taskList->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customjs')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#status_filter').change(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('user/task') }}",
                    type: 'GET',
                    data: {
                        name: $('#status_filter').val(),
                    },
                    success: function(result) {
                        console.log(result);
                    }
                });
            });
        });
    </script>
@endsection
