<div ng-controller="adCreativeController">

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">Ad Creatives</div>
            <div class="panel-body">

                Search: <input type="text" placeholder="Search" ng-model="qscr" />

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#adcreative-selector-modal">
                    Add
                </button>

                <br />


                <table class='table table-striped table-hover'>
                    <thead>

                    <tr>
                        <th>#</th>
                        <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                        <th ng-click="sortData('name')">Name <div ng-class="getSortClass('name')"></div></th>
                        <th>Type</th>

                    </tr>

                    </thead>

                    <tbody>
                    <tr dir-paginate="adct in adcreatives | filter:qscr | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit" pagination-id="adCreativePagination">
                        <td>
                            <input type="radio" name="adcreative_id[]" value="@{{ adct.id }}" class="chk_adcreative"  ng-model="adCreativeSelected.adCreative_id" ng-change="showAdCreativeSelected()">
                        </td>
                        <td>@{{ adct.id }}</td>
                        <td>@{{ adct.name | uppercase }}</td>
                        <td>@{{ adct.ad_type | uppercase }}</td>


                    </tr>

                    </tbody>
                </table>


                <dir-pagination-controls
                        direction-links=true
                        boundary-links=true
                        pagination-id="adCreativePagination"
                >
                </dir-pagination-controls>

            </div>

        </div>
    </div>


    @include('admanager.wizard._adcreative_form')



</div>
