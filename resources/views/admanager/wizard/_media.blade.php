<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">Ad Media</div>
        <div class="panel-body" ng-controller="mediaController">

            Search: <input type="text" placeholder="Search" ng-model="qm" />

            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#admedia-modal">
                Add
            </button>

            <br />

            <input type="button" value="Trigger" ng-click="fetchMedia()" id="btn_trigger" style="display: none">

            <table class='table table-hover'>
                <thead>

                <tr>
                    <th>#</th>
                    <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Extension</th>
                    <th ng-click="sortData('original_file_name')">File Name <div ng-class="getSortClass('original_file_name')"></div></th>

                </tr>

                </thead>

                <tbody>

                <tr dir-paginate="m in media | filter:qm | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit" pagination-id="adMediaPagination">
                    <td>
                        <input type="radio" name="media_d[]" value="@{{ m.id }}" class="chk_media" ng-model="mediaSelected.media_id" ng-change="showMediaSelected()">
                    </td>
                    <td>@{{ m.id }}</td>
                    <td>
                        <img ng-src="@{{m.file_path}}" width="@{{m.width}}" height="@{{m.height}}">
                    </td>
                    <td>@{{ m.type }}</td>
                    <td>
                        @{{ m.file_extension }}
                    </td>
                    <td>@{{ m.original_file_name | uppercase }}</td>
                    {{--<td>--}}
                        {{--<a href="/ad/ad-media/@{{m.id}}" class="fa fa-trash"></a>--}}
                    {{--</td>--}}

                </tr>

                </tbody>
            </table>
            <dir-pagination-controls
                    direction-links=true
                    boundary-links=true
                    pagination-id="adMediaPagination"
            >
            </dir-pagination-controls>


        </div>

    </div>
</div>
