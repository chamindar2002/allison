@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop




<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    Ad Media &nbsp;

                    {!! link_to("ad/ad-media/create", '', array('class'=>'fa fa-plus')) !!}
                </div>

                <div class='panel-body' ng-app="mediaApp" ng-controller="mediaController">
                    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

                    Search: <input type="text" placeholder="Search" ng-model="q" />
                    &nbsp;|&nbsp; Limit rows to : <input type="number" step="1", min="0" max="100" ng-model="rowLimit" />
                    <br /><br />


                    <table class='table table-hover'>
                        <thead>

                            <tr>
                                <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                                <th>Image</th>
                                <th ng-click="sortData('original_file_name')">File Name <div ng-class="getSortClass('original_file_name')"></div></th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                            {{--<tr dir-paginate="m in media | limitTo:rowLimit | orderBy:sortColumn:reverseSort | itemsPerPage:recordsPerPage | filter:q">--}}
                            {{--https://github.com/michaelbromley/angularUtils/tree/master/src/directives/pagination--}}
                            <tr dir-paginate="m in media | filter:q | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit">
                            {{--<li dir-paginate="meal in meals | filter:q | itemsPerPage: pageSize" current-page="currentPage">{{ meal }}</li>    --}}

                                <td>@{{ m.id }}</td>
                                <td>
                                    <img ng-src="@{{m.file_path}}" width="@{{m.widht}}" height="@{{m.height}}">
                                </td>
                                <td>@{{ m.original_file_name | uppercase }}</td>
                                <td>
                                    <a href="/ad/ad-media-video-thumbs/@{{ m.id }}"  class="fa fa-picture-o" title="Update thumb image"></a>
                                    &nbsp;
                                    <a href="/ad/ad-media/@{{m.id}}" class="fa fa-trash"></a>
                                </td>

                            </tr>

                        </tbody>


                    </table>

                    <dir-pagination-controls
                            direction-links=true
                            boundary-links=true >
                    </dir-pagination-controls>


                </div>

            </div>
        </div>
    </div>
</div>




@stop

@section('scripts')

    <script src="{!! asset('angular/controllers/mediaCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/mediaService.js') !!}"></script>



@stop

    


