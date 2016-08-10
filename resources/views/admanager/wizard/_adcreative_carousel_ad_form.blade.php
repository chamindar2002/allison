<div id="adcreative_carousel_ad_placeholder" style="display:none;" class="ad_creative_froms">

    <form ng-submit="submitCarousalAdData()">
        <div class='form-group'>
            {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                {!! Form::text('name',null,['class'=>'form-control', 'ng-model'=>"adCreativeData.name"]) !!}
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
            {!! Form::label('ldf_caption','Caption', ['class'=>'col-md4 control-label']) !!}
            <a title="The caption of the ad. Eg-'My Caption'"><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::text('ldf_caption',null,['class'=>'form-control', 'ng-model'=>'adCreativeData.ldf_caption']) !!}
            </div>
        </div>


        <div class='form-group'>
            {!! Form::label('object_url','Url', ['class'=>'col-md4 control-label']) !!}
            {{--<a title="Destination URL for a link ads not connected to a page."><i class="fa fa-info-circle"></i></a>--}}
            <div class='col-md-6'>
                {!! Form::text('object_url',null,['class'=>'form-control', 'ng-model'=>'adCreativeData.object_url']) !!}
            </div>
        </div>


    <div class='form-group'>
        {!! Form::label('button','&nbsp;', ['class'=>'col-md4 control-label media-file-label', 'id'=>'lbl_media_file_name']) !!}
        <div class='col-md-6'>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productModal">
                Open Products Catalogue
            </button>
        </div>
    </div>


    <div class='form-group'>
        {!! Form::label('submit_button','&nbsp;', ['class'=>'col-md4 control-label media-file-label', 'id'=>'lbl_media_file_name']) !!}
        <div class='col-md-6'>
            {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
        </div>
    </div>

    </form>


    {{--{!! Form::hidden('ad_type', 'carousel_ad') !!}--}}


</div>