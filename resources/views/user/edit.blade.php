@extends('layout.main')

@section('content')
{!!Form::open([
    'action'=>'user\UserController@updatedata','method'=>'POST',
    'id'=>'formuser','enctype'=>"multipart/form-data",
    'class'=>'form-horizontal'
])!!}
<div class="col-lg-9">
    @include('user.inc.formTambah')
    @include('user.inc.javascript')
</div>

<div class="col-lg-3">
    @include('user.inc.role')
</div>

</form>
@endsection