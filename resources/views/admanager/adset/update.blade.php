@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{!! $adset->name; !!}</div>
                <div class='panel-body'>
                    
                    {!! Form::model($adset, ['method'=>'patch', 'action'=>['AdManager\AdSetController@update', $adset->id], 'class'=>'form-horizontal']) !!}
                             
                         @include('admanager.adset._form',['submitButtonText' => 'Update','searchModalTitle'=>'Target Groups'])

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


@section('scripts') 

     @include('admanager.adset._scripts')
     
@stop