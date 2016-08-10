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
                    {!! $media->original_file_name !!}
                    
                   
                </div>
                <div class='panel-body'>
                    <?php
                                    if(!file_exists($path.$media->media_file)){
                                         $file = $path.$media_config['NO_IMAGE'];
                                         $type = $media_config['NO_IMAGE_TYPE'];
                                    }else{
                                         $file = $path.$media->media_file;
                                         $type = $media->media_type;
                                    }
                                    
                                    $img = Image::make(file_get_contents($file))->resize($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                                    $img->encode('jpg');
                                    
                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                                    ?>
                                    
                                        <div class="thumbnail">
                                             <img src="{!! $base64 !!}">
                                        </div>
                                   
                                    
                    {!! Form::model($media, ['method'=>'delete', 'action'=>['AdManager\AdMediaController@destroy', $media->id]]) !!}
                        {!! Form::hidden('id',$media->id,['class'=>'form-control']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    