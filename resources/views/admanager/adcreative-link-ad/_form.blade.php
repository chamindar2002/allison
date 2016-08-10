<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name', null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('ldf_message','Message', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('ldf_message', null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('object_url','Url', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('object_url', null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('ldf_caption','Caption', ['class'=>'col-md4 control-label']) !!}
    <a title="The caption of the ad. Eg-'My Caption'"><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('ldf_caption', null,['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('page_id','Page Id', ['class'=>'col-md4 control-label']) !!}
    <a title="Facebook page id."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('page_id', null,['class'=>'form-control']) !!}
    </div>
</div>

{!! Form::hidden('ad_type', 'link_ad_connected_to_page') !!}

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
