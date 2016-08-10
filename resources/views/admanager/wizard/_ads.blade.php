<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">Ads</div>
        <div class="panel-body" ng-controller="adsController">


            <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

            Search: <input type="text" placeholder="Search" ng-model="qad" />

            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-ads-modal">
                Add
            </button>

            <br />

            <table class='table table-striped table-hover'>
                <thead>

                <tr>
                    <th>#</th>
                    <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                    <th ng-click="sortData('name')">Name <div ng-class="getSortClass('name')"></div></th>
                    <th>Status</th>
                </tr>

                </thead>

                <tbody>

                <tr dir-paginate="ad in ads | filter:qad | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit"  pagination-id="adsPagination">

                    <td>
                        <input type="radio" name="ad_id[]" value="@{{ ad.id }}" class="chk_campaign"  ng-model="adsSelected.ad_id" ng-change="showAdSelected()">
                    </td>
                    <td>@{{ ad.id }}</td>
                    <td>@{{ ad.name | uppercase }}</td>
                    <td>@{{ ad.status | uppercase }}</td>
                </tr>

                </tbody>


            </table>
            <dir-pagination-controls
                    direction-links=true
                    boundary-links=true
                    pagination-id="adsPagination"
            >
            </dir-pagination-controls>

            {{--forms--}}

            @include('admanager.wizard._ads_form')



        </div>

    </div>
</div>
