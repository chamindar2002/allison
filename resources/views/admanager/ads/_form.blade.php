<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('ad_creative','Ad Creative', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::select('ad_creative_id', ['' => ''] + $adcreatives, null, ['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('ad_set','Ad Set', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
           {!! Form::select('ad_set_id', ['' => ''] + $adsets, null, ['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('status','Status', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::select('status', ['' => ''] + $statuses, null, array('class'=>'form-control')) !!}
    </div>
</div>


<div class='form-group'>
    <div class='col-md-6'>
    {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>