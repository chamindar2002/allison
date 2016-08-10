@extends('app')


@section('content')

@section('steps-menu')

      @include('partials.navsteps-audience')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{!! $audience_pixel->name !!}</div>
                <div class='panel-body'>
          
                    {!! Form::model($audience_pixel, ['method'=>'patch', 'action'=>['AudienceManager\AudiencePixelController@update', $audience_pixel->id]]) !!}
                                             
                         @include('audience.pixel._form',['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    