<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Target Groups</h4>
            </div>
            <div class="modal-body">


                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Target Groups</div>
                        <div class="panel-body">

                            <div class='form-group'>
                                {!! Form::button('Search', ['class'=>'btn btn-success', 'id'=>'btn-target-search', 'ng-click'=>'searchTargets(targetSearchData)']) !!}
                                <div class='col-md-6'>
                                    {!! Form::text('target_string',null,['class'=>'form-control', 'id'=>'text-target-search', 'ng-model'=>'targetSearchData.searchText']) !!}
                                </div>
                            </div>

                            <div class='form-group'>
                                {!! Form::label('limit_results','Limit Results', ['class'=>'col-md4 control-label']) !!}
                                <div class='col-md-6'>
                                    {!! Form::select('limit_results', ['10' => 'Limit 10', '50' => 'Limit 50', '100' => 'Limit 100'], null, array('class'=>'form-control', 'id'=>'limit_results', 'ng-model'=>'targetSearchData.searchLimit')) !!}
                                </div>

                            </div>

                            <div id='target-place-holder'>
                                {{--@{{targets}}--}}

                                <ul ng-repeat="t in targets">

                                    <li><input type="checkbox" class="chk_interests" name="interests[]"  value="@{{ t.id }}" ng-model="selected[t.id]" ng-change="toggleSelection(id)">&nbsp;@{{ t.name }}</li>

                                </ul>


                            </div>

                            <div class='form-group'>
                                {!! Form::label('geo_location','Geo Location', ['class'=>'col-md4 control-label']) !!}
                                <div class='col-md-6'>
                                    {!! Form::select('geo_location[]',$countries, $geo_locations, ['id'=>'geo_location', 'class'=>'form-control', 'multiple' => 'multiple', 'ng-model'=>'targetSearchData.geo_location']) !!}
                                    @{{ targetSearchData.geo_location }}
                                </div>
                            </div>

                            <div class='form-group'>
                                {!! Form::label('targeting_search_types','Target By', ['class'=>'col-md4 control-label']) !!}
                                <div class='col-md-6'>

                                    {!! Form::radio('targeting_search_types', 'INTEREST', true, ['class'=>'', 'ng-model'=>'targetSearchData.targeting_search_types']) !!} Interest &nbsp;
                                    {!! Form::radio('targeting_search_types', 'GEOLOCATION', false, ['class'=>'', 'ng-model'=>'targetSearchData.targeting_search_types']) !!} Geo Location &nbsp;

                                </div>
                            </div>


                        </div>


                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>

            </div>

        </div>
    </div>
</div>


