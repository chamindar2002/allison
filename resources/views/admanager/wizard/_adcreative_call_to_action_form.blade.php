<div id="adcreative_call_to_action_placeholder" style="display:none;" class="ad_creative_froms">

    <form ng-submit="submitCallToActionCreativeData()">
        <div class='form-group'>
            {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                {!! Form::text('name', null,['class'=>'form-control', 'ng-model'=>"adCreativeData.name"]) !!}
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('ldf_message','Message', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                {!! Form::text('ldf_message', null,['class'=>'form-control', 'ng-model'=>"adCreativeData.ldf_message"]) !!}
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('object_url','Url', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                {!! Form::text('object_url', null,['class'=>'form-control', 'ng-model'=>"adCreativeData.object_url"]) !!}
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('ldf_caption','Caption', ['class'=>'col-md4 control-label']) !!}
            <a title="The caption of the ad. Eg-'My Caption'"><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::text('ldf_caption',null,['class'=>'form-control', 'ng-model'=>'adCreativeData.ldf_caption']) !!}
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('ldf_call_to_action_type','Call to action type', ['class'=>'col-md4 control-label']) !!}
            <a title="The call to action button text and header text of legacy ads."><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::select('ldf_call_to_action_type', ['' => ''] + $call_to_action_types, null, array('class'=>'form-control', 'ng-model'=>'adCreativeData.ldf_call_to_action_type')) !!}
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('ldf_link_caption','Link Caption', ['class'=>'col-md4 control-label']) !!}
            <a title="Allows to customize the call to action caption. Eg-'Sign Up!'"><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::text('ldf_link_caption',null,['class'=>'form-control', 'ng-model'=>'adCreativeData.ldf_link_caption']) !!}
            </div>
        </div>


        <div class='form-group'>
            {!! Form::label('page_id','Page Id', ['class'=>'col-md4 control-label']) !!}
            <a title="Facebook page id. (e.g:181706508877956)"><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::text('page_id', null,['class'=>'form-control', 'ng-model'=>'adCreativeData.page_id']) !!}
            </div>
        </div>


        <div class='form-group'>
            <div class='col-md-6'>
                {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
            </div>
        </div>
    </form>

</div>