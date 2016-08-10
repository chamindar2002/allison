<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}  
    </div>
</div>


<div class='form-group'>
    {!! Form::label('custom_audience_id', 'Custom Audience', ['class'=>'col-md4 control-label']) !!}
    <a title="The custom audience associated with this lookalike audience."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::select('custom_audience_id', ['' => ''] + $custom_audiences, null, ['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('country_code','Country', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::select('country_code', ['' => ''] + $countries, null, ['class'=>'form-control']) !!}
    </div>
</div>



<div class='form-group'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>