@extends('app')


@section('content')

@section('steps-menu')

       @include('partials.navsteps-audience')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{!! $custom_audience->name !!}</div>
                <div class='panel-body'>
          
                    {!! Form::model($custom_audience, ['method'=>'patch', 'action'=>['AudienceManager\CustomAudienceController@update', $custom_audience->id]]) !!}
                                             
                         @include('audience.custom._form',['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


@section('scripts') 

     @include('audience.custom._scripts')
     
@stop
    