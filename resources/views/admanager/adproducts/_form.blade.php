<div class='form-group'>
    {!! Form::label('product_name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('product_name',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('product_description','Description', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('product_description',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('product_url', 'Product URL', ['class'=>'col-md4 control-label']) !!}
    <a title="URL to the product description page."><i class="fa fa-info-circle"></i>
    </a>
    <div class='col-md-6'>
        {!! Form::text('product_url',null,['class'=>'form-control']) !!}
    </div>
</div>

@include('admanager.adcreative._media_list')

<div class='form-group'>
    {!! Form::label('object_url','&nbsp;', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
    </div>
</div>

{!! Form::hidden('media_id',null, ['id'=>'media_id_hidden']) !!}

@section('scripts')

    <script src="{!! asset('angular/controllers/mediaCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/mediaService.js') !!}"></script>
    @include('admanager.adproducts._scripts')
    @include('admanager.adcreative._scripts')
@stop