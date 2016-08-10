<div class='form-group'>
    {!! Form::label('name','Name', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('page_id','Page Id', ['class'=>'col-md4 control-label']) !!}
    <a title="Facebook page id."><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('page_id', null,['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('ldf_caption','Caption', ['class'=>'col-md4 control-label']) !!}
    <a title="The caption of the ad. Eg-'My Caption'"><i class="fa fa-info-circle"></i></a>
    <div class='col-md-6'>
        {!! Form::text('ldf_caption',null,['class'=>'form-control']) !!}
    </div>
</div>


<div class='form-group'>
    {!! Form::label('object_url','Url', ['class'=>'col-md4 control-label']) !!}
    {{--<a title="Destination URL for a link ads not connected to a page."><i class="fa fa-info-circle"></i></a>--}}
    <div class='col-md-6'>
        {!! Form::text('object_url',null,['class'=>'form-control']) !!}
    </div>
</div>

<?php if(isset($adcreative->products)){ ?>

    <div class='form-group'>
        {!! Form::label('object_url','Products in use', ['class'=>'col-md4 control-label']) !!}
        <div class='col-md-6'>


            <div class="media">
                @foreach($adcreative->products as $product)
                    <div class="media-left">

                        <?php
                        if (!file_exists($path . $product->media->media_file)) {
                            #if file not exists locally fetch it from remote url
                            if ($product->media->url_128 != '') {
                                $file = $product->media->url_128;
                            } else {
                                #if remote url is also not available, display no image image
                                $file = $path . $media_config['NO_IMAGE'];
                            }
                            $type = $media_config['NO_IMAGE_TYPE'];
                        } else {
                            $file = $path . $product->media->media_file;
                            $type = $product->media->media_type;
                        }

                        #https://laracasts.com/discuss/channels/general-discussion/displaying-an-image-from-the-view-with-intervention-image/replies/53697
                        $img = Image::make(file_get_contents($file))->resize($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                        $img->encode($type);
                        //$type = $md->media_type;
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                        ?>
                        <img class="media-object" src="{!! $base64 !!}">

                    </div>

                    <div class="media-body">
                        <p>{!! $product->product_name !!}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

<?php } ?>


<div class='form-group'>
    {!! Form::label('object_url','&nbsp;', ['class'=>'col-md4 control-label media-file-label', 'id'=>'lbl_media_file_name']) !!}
    <div class='col-md-6'>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productModal">
            Open Products Catalogue
        </button>
    </div>
</div>



<div class='form-group'>
        {!! Form::label('object_url','&nbsp;', ['class'=>'col-md4 control-label media-file-label', 'id'=>'lbl_media_file_name']) !!}
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
    </div>
</div>



{!! Form::hidden('ad_type', 'carousel_ad') !!}




<br /><br />

<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Product List</h4>
            </div>

            <div class='panel-body' ng-app="productApp" ng-controller="productController">
                <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

                Search: <input type="text" placeholder="Search" ng-model="q" />
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
                        <th>Actions</th>
                    </tr>

                    </thead>

                    <tbody>


                    <tr dir-paginate="p in product | filter:q | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort">

                        <td>@{{ p.id }}</td>
                        <td>
                            <input type="checkbox" name="products[]" prop_1="@{{ p.product_name  }}" ng-model="p.name" ng-true-value="@{{ p.id }}" ng-false-value="" value="@{{ p.id }}" ng-click="updateSelection($event, p.product_name)">

                        </td>
                        <td>
                            <img ng-src="@{{p.file_path}}" width="@{{p.width}}" height="@{{p.height}}">
                            {{--@{{ p.file_path }}--}}
                        </td>
                        <td>@{{ p.product_name | uppercase }}</td>
                        <td>@{{ p.product_description }}</td>
                        <td>
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




@section('scripts')

    <script src="{!! asset('angular/controllers/productCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/productService.js') !!}"></script>


@stop
