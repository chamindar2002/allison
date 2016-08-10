<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
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
    {!! Form::label('post_id','Post Id', ['class'=>'col-md4 control-label']) !!}
    <a title="The ID of a page post to use in an ad. "><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('post_id',null,['class'=>'form-control']) !!}
    </div>
</div>

{!! Form::hidden('ad_type', 'ad_from_existing_page_post') !!}

<div class='form-group clearfix'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>


<div id="target-place-holder"></div>