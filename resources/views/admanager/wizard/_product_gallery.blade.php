<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Product List</h4>
            </div>

            <div class='panel-body' ng-controller="productController">
                <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

                Search: <input type="text" placeholder="Search" ng-model="qprg" />
                {{--&nbsp;|&nbsp; Limit rows to : <input type="number" step="1", min="0" max="100" ng-model="rowLimit" />--}}

                <br /><br />

                <table class='table table-hover'>
                    <thead>

                    <tr>
                        <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                        <th>#</th>
                        <th>Image</th>
                        <th ng-click="sortData('product_name')"> Name <div ng-class="getSortClass('product_name')"></div></th>
                        <th> Description </th>
                        {{--<th>Actions</th>--}}
                    </tr>

                    </thead>

                    <tbody>


                    <tr dir-paginate="p in product | filter:qprg | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort" pagination-id="adProductGalleryPagination">

                        <td>@{{ p.id }}</td>
                        <td>
                            <input type="checkbox" name="products[]" prop_1="@{{ p.product_name  }}" ng-model="p.name" ng-true-value="@{{ p.id }}" ng-false-value="" value="@{{ p.id }}" ng-click="updateSelection($event, p.product_name, p.id)">

                        </td>
                        <td>
                            <img ng-src="@{{p.file_path}}" width="@{{p.width}}" height="@{{p.height}}">
                            {{--@{{ p.file_path }}--}}
                        </td>
                        <td>@{{ p.product_name | uppercase }}</td>
                        <td>@{{ p.product_description }}</td>
                        {{--<td><a href="/ad/ad-media/@{{m.id}}" class="fa fa-trash"></a></td>--}}

                    </tr>

                    </tbody>


                </table>
                <dir-pagination-controls
                    direction-links=true
                    boundary-links=true
                    pagination-id="adProductGalleryPagination"
                >
                </dir-pagination-controls>



            </div>


        </div>
    </div>
</div>