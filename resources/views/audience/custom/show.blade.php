@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps-audience')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    {!! $custom_audience->name !!}
                    
                   
                </div>
                <div class='panel-body'>
                    {!! Form::model($custom_audience, ['method'=>'delete', 'action'=>['AudienceManager\CustomAudienceController@destroy', $custom_audience->id]]) !!}
                        {!! Form::hidden('id',$custom_audience->id,['class'=>'form-control']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    