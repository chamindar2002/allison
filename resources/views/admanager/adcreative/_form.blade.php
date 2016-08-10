<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('title','Title', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('body','Body', ['class'=>'col-md4 control-label']) !!}
    <a title="The body of the ad."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('body',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('object_url','Url', ['class'=>'col-md4 control-label']) !!}
    <a title="Destination URL for a link ads not connected to a page."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('object_url',null,['class'=>'form-control']) !!}
    </div>
</div>

@include('admanager.adcreative._media_list')

<div class='form-group'>
    {!! Form::label('object_url','&nbsp;', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
    </div>
</div>




@section('scripts')

    <script src="{!! asset('angular/controllers/mediaCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/mediaService.js') !!}"></script>
    @include('admanager.adcreative._scripts')


@stop