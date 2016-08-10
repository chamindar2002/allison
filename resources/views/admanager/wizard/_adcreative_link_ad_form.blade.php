<div id="adcreative-linkad-placeholder" style="display:none;" class="ad_creative_froms">

    <form ng-submit="submitAdLinkAdCreativeData()">

        <div class='form-group'>
            {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                <input type="text" name="name" id="name" value="@{{ adCreativeData.name }}" class="form-control" ng-model="adCreativeData.name" >

            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('title','Title', ['class'=>'col-md4 control-label']) !!}
            <div class='col-md-6'>
                <input type="text" name="title" id="title" value="@{{ adCreativeData.title }}" class="form-control" ng-model="adCreativeData.title" >
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('body','Body', ['class'=>'col-md4 control-label']) !!}
            <a title="The body of the ad."><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                <input type="text" name="body" id="body" value="@{{ adCreativeData.body }}" class="form-control" ng-model="adCreativeData.body" >
            </div>
        </div>

        <div class='form-group'>
            {!! Form::label('object_url','Url', ['class'=>'col-md4 control-label']) !!}
            <a title="Destination URL for a link ads not connected to a page."><i class="fa fa-info-circle"></i></a>
            <div class='col-md-6'>
                <input type="text" name="object_url" id="object_url" value="@{{ adCreativeData.object_url }}" class="form-control" ng-model="adCreativeData.object_url" >
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