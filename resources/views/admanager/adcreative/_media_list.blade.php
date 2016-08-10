<?php if(isset($adcreative)){ ?>



<div class='form-group'>
    {!! Form::label('object_url','Media in use', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>


        <div class="media">
            @foreach ($adcreative->media as $md)
                <div class="media-left media-middle">

                    <?php
                    if (!file_exists($path . $md->media_file)) {
                        #if file not exists locally fetch it from remote url
                        if ($md->url_128 != '') {
                            $file = $md->url_128;
                        } else {
                            #if remote url is also not available, display no image image
                            $file = $path . $media_config['NO_IMAGE'];
                        }
                        $type = $media_config['NO_IMAGE_TYPE'];
                    } else {
                        $file = $path . $md->media_file;
                        $type = $md->media_type;
                    }

                    #https://laracasts.com/discuss/channels/general-discussion/displaying-an-image-from-the-view-with-intervention-image/replies/53697
                    $img = Image::make(file_get_contents($file))->resize($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                    $img->encode($type);
                    //$type = $md->media_type;
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                    ?>
                    <img class="media-object" src="{!! $base64 !!}">

                </div>
            @endforeach
        </div>

    </div>
</div>


<?php } ?>

<?php if(isset($product)){ ?>

    <div class='form-group'>
        {!! Form::label('object_url','Media in use', ['class'=>'col-md4 control-label']) !!}
        <div class='col-md-6'>

            <div class="media">

                <?php
                $md =  $product->media;
                if (!file_exists($path . $md->media_file)) {
                    #if file not exists locally fetch it from remote url
                    if ($md->url_128 != '') {
                        $file = $md->url_128;
                    } else {
                        #if remote url is also not available, display no image image
                        $file = $path . $media_config['NO_IMAGE'];
                    }
                    $type = $media_config['NO_IMAGE_TYPE'];
                } else {
                    $file = $path . $md->media_file;
                    $type = $md->media_type;
                }

                #https://laracasts.com/discuss/channels/general-discussion/displaying-an-image-from-the-view-with-intervention-image/replies/53697
                $img = Image::make(file_get_contents($file))->resize($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                $img->encode($type);
                //$type = $md->media_type;
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                ?>
                <img class="media-object" src="{!! $base64 !!}">
            </div>

        </div>

    </div>

<?php } ?>



<div class='form-group'>
    {!! Form::label('object_url','&nbsp;', ['class'=>'col-md4 control-label media-file-label', 'id'=>'lbl_media_file_name']) !!}
    <div class='col-md-6'>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mediaModal">
            Open Media Gallery
            Open Media Gallery
        </button>
    </div>
</div>



<!--
Modal
bootstrap modal source: http://getbootstrap.com/javascript/
-->


<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Media Gallery</h4>
            </div>


            <div class='panel-body' ng-app="mediaApp" ng-controller="mediaController">
                <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

                Search: <input type="text" placeholder="Search" ng-model="q" />

                <br /><br />

                <table class='table table-hover'>
                    <thead>

                    <tr>
                        <th>#</th>
                        <th ng-click="sortData('id')">ID <div ng-class="getSortClass('id')"></div></th>
                        <th>Image</th>
                        <th ng-click="sortData('original_file_name')">File Name <div ng-class="getSortClass('original_file_name')"></div></th>
                        <th>Actions</th>
                    </tr>

                    </thead>

                    <tbody>

                    <tr dir-paginate="m in media | filter:q | itemsPerPage: recordsPerPage |orderBy:sortColumn:reverseSort | limitTo:rowLimit">

                        <td>
                            <input type="radio" name="media_d[]" value="@{{ m.id }}" prop_1="@{{ m.original_file_name }}" class="chk_media"  >
                        </td>

                        <td>@{{ m.id }}</td>
                        <td>
                            <img ng-src="@{{m.file_path}}" width="@{{m.widht}}" height="@{{m.height}}">
                        </td>
                        <td>@{{ m.original_file_name | uppercase }}</td>
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

