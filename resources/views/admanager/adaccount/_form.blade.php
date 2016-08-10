<div class='form-group'>
    {!! Form::label('ad_account_id','Ad Account', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('ad_account_id',null,['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>
