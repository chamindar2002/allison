@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>New Ad</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'ad/ad-publish', 'method' => 'post', 'class'=>'form-horizontal')) !!}
                       {!! csrf_field() !!}
                       
                         @include('admanager.ads._form',['submitButtonText' => 'Create'])

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