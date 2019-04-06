@extends('layout.main')

@section('content')
{!!Form::open([
    'action'=>'user\UserController@permission_update',
    'method'=>'POST',
    'id'=>'theForm','enctype'=>"multipart/form-data",
    'class'=>'form-horizontal'
])!!}
<div class="col-lg-12">
    @include('user.inc.permission')
    @include('inc.js')
</div>


</form>
@endsection