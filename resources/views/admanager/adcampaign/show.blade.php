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
                    {!! $campaign->name !!}
                    
                   
                </div>
                <div class='panel-body'>
                    {!! Form::model($campaign, ['method'=>'delete', 'action'=>['AdManager\AdCampaignController@destroy', $campaign->id]]) !!}
                        {!! Form::hidden('id',$campaign->id,['class'=>'form-control']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']); !!}
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    