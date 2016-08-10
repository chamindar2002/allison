<div class="modal fade bs-example-modal-lg" id="adset-modal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ad Set</h4>
            </div>

            <form ng-submit="submitAdSetData()">

            <div class='panel-body'>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal">
                    Launch Target Groups Search
                </button>

                <br><br>



                    <div class='form-group'>
                        {!! Form::label('name','AdSet Name', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::text('name',null,['class'=>'form-control', 'ng-model'=>'targetSearchData.name']) !!}
                            {{--{!! Form::text('selected_target_groups', null, ['id'=>'selected_target_groups', 'class'=>'form-control', 'ng-model'=>'targetSearchData.selected_target_groups']) !!}--}}
                            {{--<input type="text" name="selected_target_groups" id="selected_target_groups" ng-model="targetSearchData.selected_target_groups" style="display: block">--}}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('optimization_goals','Optimization Goal', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::select('optimization_goals', $optimization_goals, null, ['class'=>'form-control', 'ng-model'=>'targetSearchData.optimization_goals']) !!}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('start_time','Start Campaign', ['class'=>'col-md4 control-label']) !!}
                                <!--    <div class='col-md-6'>
                {!! Form::text('start_time','2016-01-07',['class'=>'form-control', 'readonly'=>'readonly']) !!}
                                </div>-->

                        <!--    https://bootstrap-datepicker.readthedocs.org/en/latest/-->
                        <div id="sandbox-container_1" class="col-md-6">
                            {!! Form::text('start_time',null,['class'=>'form-control', 'ng-model'=>'targetSearchData.start_time']) !!}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('end_time','End Campaign', ['class'=>'col-md4 control-label']) !!}
                                <!--    <div class='col-md-6'>
                {!! Form::text('end_time','2016-02-14',['class'=>'form-control', 'readonly'=>'readonly']) !!}
                                </div>-->

                        <!--    https://bootstrap-datepicker.readthedocs.org/en/latest/-->
                        <div id="sandbox-container_2" class="col-md-6">
                            {!! Form::text('end_time',null,['class'=>'form-control', 'ng-model'=>'targetSearchData.end_time']) !!}

                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('bid_amount','Bid Amount ($)', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::text('bid_amount', null, ['class'=>'form-control', 'ng-model'=>'targetSearchData.bid_amount']) !!}
                        </div>
                    </div>


                    <div class='form-group'>
                        {!! Form::label('daily_budget','Daily Budget ($)', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::text('daily_budget', null, ['class'=>'form-control', 'ng-model'=>'targetSearchData.daily_budget']) !!}
                        </div>
                    </div>


                    <div class='form-group'>
                        {!! Form::label('status','Status', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::select('status', ['' => ''] + $statuses, null, array('class'=>'form-control', 'ng-model'=>'targetSearchData.status')) !!}
                        </div>
                    </div>

                <input type="text" name="selected_target_groups" id="selected_target_groups" value="@{{  targetSearchData.selected_target_groups }}" style="display: none">

                {{--@{{ targetSearchData.selected_target_groups }}--}}

                    {{--<div class="form-group text-right">--}}
                        {{--<button type="submit" class="btn btn-primary btn-lg">Submit</button>--}}
                    {{--</div>--}}

                {{--</form>--}}


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            </form>

        </div>
    </div>
</div>
