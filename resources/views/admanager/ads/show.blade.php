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
                    {!! $ad->name !!}
                    
                   
                </div>
                <div class='panel-body'>
                    {!! Form::model($ad, ['method'=>'delete', 'action'=>['AdManager\AdPublishController@destroy', $ad->id]]) !!}
                        {!! Form::hidden('id',$ad->id,['class'=>'form-control']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    