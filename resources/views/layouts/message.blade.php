@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" id="error-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        {{ Session::get('error') }}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" id="success-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ Session::get('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" id="error-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        @foreach ($errors->all() as $error)
            {{ $error }}<br />
        @endforeach
    </div>
@endif
