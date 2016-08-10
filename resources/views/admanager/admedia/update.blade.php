@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{!! $media->original_file_name !!}</div>
                <div class='panel-body'>
          
                    {!! Form::model($media, ['method'=>'patch', 'action'=>['AdManager\AdMediaController@updateVideo', $media->id]]) !!}
                                             
                         @include('admanager.admedia._list_thumbs',['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop

@section('scripts')

    @include('admanager.adcreative-video-page._scripts')

@stop

    