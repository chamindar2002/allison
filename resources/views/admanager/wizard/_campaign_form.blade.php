<div class="modal fade" id="add-campaign-modal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ad Campaign</h4>
            </div>

            <div class='panel-body'>

                <form ng-submit="submitCampaignData()">

                    <div class='form-group'>
                        {!! Form::label('name','Campaign Name', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::text('name',null,['class'=>'form-control', 'ng-model'=>'campaignData.name']) !!}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('objective','Objective', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::select('objective', ['' => ''] + $objectives, null, array('class'=>'form-control', 'ng-model'=>'campaignData.objective')) !!}
                        </div>
                    </div>


                    <div class='form-group'>
                        {!! Form::label('status','Status', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::select('status', ['' => ''] + $statuses, null, array('class'=>'form-control', 'ng-model'=>'campaignData.status')) !!}
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>