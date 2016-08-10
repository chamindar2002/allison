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
    {!! Form::label('video_id','Video Id', ['class'=>'col-md4 control-label']) !!}
    <a title="Facebook video id."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('video_id', null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('page_id','Page Id', ['class'=>'col-md4 control-label']) !!}
    <a title="Facebook page id."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('page_id', null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('thumb_image_url','Thumb Image Url', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('thumb_image_url', null,['class'=>'form-control']) !!}
    </div>
</div>



{!! Form::hidden('ad_type', 'video_page_like_ad') !!}


<div class='form-group'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>

<div id="target-place-holder"></div>

