@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps-audience')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>New Custom Audience</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'ad/audience-custom', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true)) !!}
                      
                         @include('audience.custom._form',['submitButtonText' => 'Create'])

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