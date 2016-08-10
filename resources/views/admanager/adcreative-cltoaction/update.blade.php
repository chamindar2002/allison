@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{!! $adcreative->name !!}</div>
                <div class='panel-body'>
          
                    {!! Form::model($adcreative, ['method'=>'patch', 'action'=>['AdManager\AdCreativeCallToActionController@update', $adcreative->id]]) !!}
                                             
                         @include('admanager.adcreative-cltoaction._form',['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    