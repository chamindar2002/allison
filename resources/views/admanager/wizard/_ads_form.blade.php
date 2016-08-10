<div class="modal fade" id="add-ads-modal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ads</h4>
            </div>

            <div class='panel-body'>

                <form ng-submit="submitAdData()">

                    <div class='form-group'>
                        {!! Form::label('name','Ad Name', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::text('name',null,['class'=>'form-control', 'ng-model'=>'adsData.name']) !!}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('status','Status', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::select('status', ['' => ''] + $statuses, null, array('class'=>'form-control', 'ng-model'=>'adsData.status')) !!}
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