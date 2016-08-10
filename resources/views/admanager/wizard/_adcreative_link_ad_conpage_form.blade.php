<div id="adcreative-linkad-conpage-placeholder" style="display:none;" class="ad_creative_froms">

    <form ng-submit="submitLinkAdConPageCreativeData()">
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
                {!! Form::text('ldf_caption', null,['class'=>'form-control', 'ng-model'=>'adCreativeData.ldf_caption']) !!}
            </div>
        </div>


        <div class='form-group'>
            {!! Form::label('page_id','Page Id', ['class'=>'col-md4 control-label']) !!}
            <a title="Facebook page id."><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::text('page_id', null,['class'=>'form-control', 'ng-model'=>'adCreativeData.page_id']) !!}
            </div>
        </div>


        <div class='form-group'>
            {!! Form::label('object_url','&nbsp;', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
            </div>
        </div>
    </form>

</div>