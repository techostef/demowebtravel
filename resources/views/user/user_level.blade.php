@extends('layout.main')

@section('content')
{!!Form::open([
    'action'=>empty($data)?'user\UserController@user_level_insertdata':'user\UserController@user_level_updatedata',
    'method'=>'POST',
    'id'=>'theForm','enctype'=>"multipart/form-data",
    'class'=>'form-horizontal'
])!!}
<div class="col-lg-12">
    @include('user.inc.user_level')
    @include('inc.js')
</div>


</form>
@endsection