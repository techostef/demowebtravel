@extends('layout.main')

@section('content')
{!!Form::open([
    'action'=>empty($userData)?'user\UserController@insertdata':'user\UserController@updatedata','method'=>'POST',
    'id'=>'theForm','enctype'=>"multipart/form-data",
    'class'=>'form-horizontal'
])!!}
<div class="col-lg-12">
    @include('user.inc.formTambah')
    @include('user.inc.javascript')
</div>

</form>
@endsection