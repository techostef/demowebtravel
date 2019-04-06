
{!!Form::open([
    'action'=>empty($data)?'customerController@insertdata':'customerController@updatedata','method'=>'POST',
    'id'=>'theForm','enctype'=>"multipart/form-data",
    'class'=>'form-horizontal'
])!!}
<div class="col-lg-12">
    @include('customer.inc.form')
    @include('inc.js')
</div>

</form>