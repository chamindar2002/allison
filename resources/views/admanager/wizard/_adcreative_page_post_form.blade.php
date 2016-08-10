<div id="adcreative-page-post-placeholder" style="display:none;" class="ad_creative_froms">

    <form ng-submit="submitPagePostAdCreativeData()">
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
            {!! Form::label('post_id','Post Id', ['class'=>'col-md4 control-label']) !!}
            <a title="The ID of a page post to use in an ad. "><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                {!! Form::text('post_id',null,['class'=>'form-control', 'ng-model'=>'adCreativeData.post_id', 'ng-click'=>'fetchPagePosts()']) !!}
            </div>
        </div>


        <div class='form-group'>
            {!! Form::label('page_posts','&nbsp;', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
            </div>
        </div>

    </form>


    <div class='form-group'>
        {!! Form::label('page_posts','Page Posts', ['class'=>'col-md4 control-label']) !!}
        <div class='col-md-6'>
            <dir content="htm_posts" id="dir"></dir>
        </div>
    </div>
</div>