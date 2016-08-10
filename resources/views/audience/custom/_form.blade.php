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

@if($submitButtonText != 'Update')
<div class='form-group'>
    {!! Form::label('pixel_id', 'Pixel', ['class'=>'col-md4 control-label']) !!}
    <a title="The pixel associated with this audience."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::select('pixel_id',$pixel, null, ['class'=>'form-control']) !!}
    </div>
</div>
@endif

@if($submitButtonText != 'Update')
<div class='form-group'>
    {!! Form::label('sub_type', 'Sub Type', ['class'=>'col-md4 control-label']) !!}
    <a title="Must be set to WEBSITE."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::select('sub_type',$subtypes, null, ['class'=>'form-control']) !!}
    </div>
</div>
@endif


<div class='form-group'>
    {!! Form::label('website_traffic', 'Website Traffic', ['class'=>'col-md4 control-label']) !!}
    <a title="Choose how you want to add people to your audience. Include all of your website visitors, or create rules that only add people who visit specific parts of your website."><i class="fa fa-info-circle"></i>
    </a>
    <div class='col-md-6'>
        {!! Form::select('website_traffic', $website_traffic, null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group' id='rule_place_holder'>
    {!! Form::label('rule', 'Url Key Words', ['class'=>'col-md4 control-label']) !!}
    <a title="Audience rules to be applied on the referrer URL"><i class="fa fa-info-circle"></i>
    </a>
    <div class='col-md-2'>
     @if($submitButtonText == 'Update')
            @if($custom_audience->website_traffic == 'specific_pages' )
                {!! Form::select('rule_definer', $rule_definer, null, ['id'=>'rule_definer', 'class'=>'form-control']) !!}
            @else
                {!! Form::select('rule_definer', $rule_definer, null, ['id'=>'rule_definer', 'class'=>'form-control', 'disabled'=>'disabled']) !!}
            @endif
     @else
            @if(Request::old('website_traffic') == 'specific_pages' )
                {!! Form::select('rule_definer', $rule_definer, null, ['id'=>'rule_definer', 'class'=>'form-control']) !!}
            @else
                {!! Form::select('rule_definer', $rule_definer, null, ['id'=>'rule_definer', 'class'=>'form-control', 'disabled'=>'disabled']) !!}
            @endif
     @endif
     
    </div>
    <div class='col-md-4'>
      @if($submitButtonText == 'Update')  
            @if($custom_audience->website_traffic == 'specific_pages' )
                {!! Form::text('url_key_words', null, ['class'=>'form-control', 'id'=>'url_key_words']) !!} 
            @else
                {!! Form::text('url_key_words', null, ['class'=>'form-control', 'id'=>'url_key_words', 'disabled'=>'disabled']) !!} 
            @endif
      @else
            @if(Request::old('website_traffic') == 'specific_pages')
                {!! Form::text('url_key_words', null, ['class'=>'form-control', 'id'=>'url_key_words']) !!} 
            @else
                {!! Form::text('url_key_words', null, ['class'=>'form-control', 'id'=>'url_key_words', 'disabled'=>'disabled']) !!} 
            @endif
      @endif
    </div>
</div>


<div class='form-group'>
    {!! Form::label('retention_days', 'Retention Days', ['class'=>'col-md4 control-label']) !!}
    <a title="Number of days to keep the user in this cluster. You can use any value between 1 and 180 days. Defaults to 14 days if not specified."><i class="fa fa-info-circle"></i>
    </a>
    <div class='col-md-6'>
        {!! Form::text('retention_days', null, ['class'=>'form-control']) !!}  
    </div>
</div>

@if($submitButtonText != 'Update')
<div class='form-group'>
    {!! Form::label('prefill', 'Prefill', ['class'=>'col-md4 control-label']) !!}
    <a title="true - Include website traffic recorded prior to the audience creation.
       false - Only include website traffic beginning at the time of the audience creation."><i class="fa fa-info-circle"></i>
    </a>
    <div class='col-md-6'>
        {!! Form::select('prefill', $prefill, null, ['class'=>'form-control']) !!}
    </div>
</div>
@endif



<div class='form-group'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>