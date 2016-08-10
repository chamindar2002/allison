<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal">
    {!! $searchModalTitle !!}
</button>
<br><br>

<!--
 Modal
 bootstrap modal source: http://getbootstrap.com/javascript/
-->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Target Groups</h4>
            </div>
            <div class="modal-body">


                <div class="well well-lg">
                    <div class='form-group'>

                        <div class='col-md-6'>
                            {!! Form::text('target_string',null,['class'=>'form-control', 'id'=>'text-target-search']) !!}
                        </div>

                        <div class='form-group'>
                            <div class='col-md-6'>
                                {!! Form::button('Search', ['class'=>'btn btn-success', 'id'=>'btn-target-search']) !!}

                            </div>

                        </div>

                        <div class='col-md-6'>
                            {!! Form::select('limit_results', ['10' => 'Limit 10', '50' => 'Limit 50', '100' => 'Limit 100'], null, array('class'=>'form-control', 'id'=>'limit_results')) !!}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('Interest','Interests', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6' id='target-place-holder'>

                            @include('admanager.adset._interests')

                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('geo_location','Geo Location', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>
                            {!! Form::select('geo_location[]',$countries, $geo_locations, ['id'=>'geo_location', 'class'=>'form-control', 'multiple' => 'multiple']) !!}
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('targeting_search_types','Target By', ['class'=>'col-md4 control-label']) !!}
                        <div class='col-md-6'>

                            {!! Form::radio('targeting_search_types', 'INTEREST', true, ['class'=>'']) !!} Interest &nbsp;
                            {!! Form::radio('targeting_search_types', 'GEOLOCATION', false, ['class'=>'']) !!} Geo Location &nbsp;

                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>






<div class='form-group'>
    {!! Form::label('name','AdSet Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('optimization_goals','Optimization Goal', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
       {!! Form::select('optimization_goals', $optimization_goals, $adset->selected_defualt, array('class'=>'form-control')) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('campaign_id','Campaign', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
       {!! Form::select('campaign_id', ['' => ''] + $campaigns, null, array('class'=>'form-control')) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('start_time','Start Campaign', ['class'=>'col-md4 control-label']) !!}
<!--    <div class='col-md-6'>
       {!! Form::text('start_time','2016-01-07',['class'=>'form-control', 'readonly'=>'readonly']) !!}
    </div>-->

<!--    https://bootstrap-datepicker.readthedocs.org/en/latest/-->
    <div id="sandbox-container_1" class="col-md-6">
            {!! Form::text('start_time',null,['class'=>'form-control']) !!}
       
    </div>
</div>




<div class='form-group'>
    {!! Form::label('end_time','End Campaign', ['class'=>'col-md4 control-label']) !!}
<!--    <div class='col-md-6'>
       {!! Form::text('end_time','2016-02-14',['class'=>'form-control', 'readonly'=>'readonly']) !!}
    </div>-->

<!--    https://bootstrap-datepicker.readthedocs.org/en/latest/-->
    <div id="sandbox-container_2" class="col-md-6">
            {!! Form::text('end_time',null,['class'=>'form-control']) !!}
       
    </div>
</div>



<div class='form-group'>
    {!! Form::label('bid_amount','Bid Amount ($)', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
       {!! Form::text('bid_amount', '2', ['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('daily_budget','Daily Budget ($)', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
       {!! Form::text('daily_budget', '100', ['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('status','Status', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::select('status', ['' => ''] + $statuses, null, array('class'=>'form-control')) !!}
    </div>
</div>


<div class='form-group'>
    <div class='col-md-6'>
    {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
    </div>
</div>