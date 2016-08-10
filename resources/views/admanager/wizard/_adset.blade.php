<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">Ad Sets</div>

        <div class="panel-body" ng-controller="adSetController">

            Search: <input type="text" placeholder="Search" ng-model="qs" />

            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#adset-modal">
                Add
            </button>

            <br />

            <table class='table table-striped table-hover'>
                <thead>

                    <tr>
                        <th>#</th>
                        <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                        <th ng-click="sortData('name')">Name <div ng-class="getSortClass('name')"></div></th>
                        <th>Optimization Goal</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <tr dir-paginate="adst in adsets | filter:qs | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit" pagination-id="adsetPagination">
                    <td>
                        <input type="radio" name="adset_id[]" value="@{{ adst.id }}" class="chk_adset" ng-model="adSetSelected.adset_id" ng-change="showAdsetSelected()">
                    </td>
                    <td>@{{ adst.id }}</td>
                    <td>@{{ adst.name | uppercase }}</td>
                    <td>@{{ adst.optimization_goals }}</td>
                    <td>@{{ adst.status | uppercase }}</td>


                </tr>

                </tbody>
            </table>
            <dir-pagination-controls
                    direction-links=true
                    boundary-links=true
                    pagination-id="adsetPagination"
            >
            </dir-pagination-controls>

            {{--forms--}}

            @include('admanager.wizard._adset_form')
            @include('admanager.wizard._target')


        </div>

    </div>
</div>
