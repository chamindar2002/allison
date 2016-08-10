@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>New Ad Set</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'ad/ad-set', 'method' => 'post', 'class'=>'form-horizontal')) !!}
                       {!! csrf_field() !!}
                       
                         @include('admanager.adset._form',['submitButtonText' => 'Create','searchModalTitle'=>'Launch Target Groups Search'])

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