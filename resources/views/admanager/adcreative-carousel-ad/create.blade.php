@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>New Corousel Ad Creative</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'ad/ad-creative-carousel-ad', 'method' => 'post', 'class'=>'form-horizontal')) !!}
                      
                         @include('admanager.adcreative-carousel-ad._form',['submitButtonText' => 'Create'])

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    