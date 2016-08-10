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
                    {!! $adcreative->name !!}
                    
                   
                </div>
                <div class='panel-body'>
                    {!! Form::model($adcreative, ['method'=>'delete', 'action'=>['AdManager\AdCreativeController@destroy', $adcreative->id]]) !!}
                        {!! Form::hidden('id',$adcreative->id,['class'=>'form-control']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    