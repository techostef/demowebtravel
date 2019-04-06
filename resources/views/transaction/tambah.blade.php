
@extends('layout.main')

@section('content')
{!!Form::open([
    'action'=>empty($userData)?'transactionController@insertdata':'transactionController@updatedata','method'=>'POST',
    'id'=>'theForm','enctype'=>"multipart/form-data",
    'class'=>'form-horizontal'
])!!}
<div class="col-lg-12">
    @include('transaction.inc.form')
    @include('inc.js')
</div>

</form>
@endsection