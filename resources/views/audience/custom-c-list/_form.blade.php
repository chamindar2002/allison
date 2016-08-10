@if($submitButtonText != 'Update')
<div class='form-group'>
    {!! Form::label('pixel_id', 'Pixel', ['class'=>'col-md4 control-label']) !!}
    <a title="The pixel associated with this audience."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::select('pixel_id',$pixel, null, ['class'=>'form-control']) !!}
    </div>
</div>
@endif

<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}  
    </div>
</div>

@if($submitButtonText == 'Update')
<div class='form-group'>
    {!! Form::label('description','Description', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('description',null,['class'=>'form-control']) !!}  
    </div>
</div>
@endif

<div class='form-group'>
    {!! Form::label('data_type', 'Data Type', ['class'=>'col-md4 control-label']) !!}
    <a title="The pixel associated with this audience."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::select('data_type',$data_types, null, ['class'=>'form-control']) !!}
    </div>
</div>

@if($submitButtonText == 'Update')
<div class='form-group'>
    {!! Form::label('data_type', 'Add/Remove People', ['class'=>'col-md4 control-label']) !!}
    <a title="The pixel associated with this audience."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::radio('data_action_selector', 'add_to_list', true) !!} Add People <br>
        {!! Form::radio('data_action_selector', 'remove_from_list') !!} Remove People
    </div>
</div>

@endif

<div class='form-group'>
    {!! Form::label('data','Data', ['class'=>'col-md4 control-label']) !!}
    
    <a title="
       Ex.
        name1@example.com
        name2@example.com
        name3@example.com
        name1@example.com,name2@example.com
        
       "><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::textarea('data',null,['class'=>'form-control']) !!}  
    </div>
</div>

<div class='form-group'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>