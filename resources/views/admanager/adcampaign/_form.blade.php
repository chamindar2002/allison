<div class='form-group'>
    {!! Form::label('name','Campaign Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('objective','Objective', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::select('objective', ['' => ''] + $objectives, null, array('class'=>'form-control')) !!}
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