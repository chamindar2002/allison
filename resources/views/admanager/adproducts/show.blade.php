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
                    {!! $product->product_name !!}


                </div>
                <div class='panel-body'>
                    {!! Form::model($product, ['method'=>'delete', 'action'=>['AdManager\AdCreativeProductsController@destroy', $product->id]]) !!}
                    {!! Form::hidden('id',$product->id,['class'=>'form-control']) !!}
                    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>




@stop


    