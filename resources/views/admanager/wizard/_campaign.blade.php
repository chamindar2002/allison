<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">Ad Campaigns</div>
            <div class="panel-body" ng-controller="campaginController">


                <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

                Search: <input type="text" placeholder="Search" ng-model="q" />

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-campaign-modal">
                    Add
                </button>

                <br />

                <table class='table table-striped table-hover'>
                    <thead>

                    <tr>
                        <th>#</th>
                        <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                        <th ng-click="sortData('name')">Name <div ng-class="getSortClass('name')"></div></th>
                        <th ng-click="sortData('objective')">Objective<div ng-class="getSortClass('objective')"></div></th>
                        <th ng-click="sortData('campaign_id')">Campaign Id<div ng-class="getSortClass('campaign_id')"></div></th>
                        <th>Status</th>
                        {{--<th ng-click="sortData('original_file_name')">File Name <div ng-class="getSortClass('original_file_name')"></div></th>--}}
                        {{--<th>Actions</th>--}}
                    </tr>

                    </thead>

                    <tbody>

                    <tr dir-paginate="cp in campaign | filter:q | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit"  pagination-id="adCampaignPagination">

                        <td>
                            <input type="radio" name="campaign_id[]" value="@{{ cp.id }}" class="chk_campaign"  ng-model="campaignSelected.campaign_id" ng-change="showCampaignSelected()">
                        </td>
                        <td>@{{ cp.id }}</td>
                        <td>@{{ cp.name | uppercase }}</td>
                        <td>@{{ cp.objective }}</td>
                        <td>@{{ cp.campaign_id }}</td>
                        <td>@{{ cp.status | uppercase }}</td>
                    </tr>

                    </tbody>


                </table>
                <dir-pagination-controls
                        direction-links=true
                        boundary-links=true
                        pagination-id="adCampaignPagination"
                >
                </dir-pagination-controls>

                {{--forms--}}

                @include('admanager.wizard._campaign_form')




            </div>

        </div>
</div>
