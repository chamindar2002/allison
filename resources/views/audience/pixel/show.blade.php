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
                    Pixel Code: 
                    {!! $audience_pixel->name !!}
                    
                   
                </div>
                <div class='panel-body'>
                    <blockquote>
                        <p>Copy the following code and place them between the <code> &#60;head&#62;&#60;/head&#62; </code> tags of the index page of your website.</p>
                          
                    </blockquote>
            
                        {!! Form::textarea('pixel_code', $audience_pixel->pixel_code, ['class' => 'form-control', 'id'=>'embed_code']) !!}
                                         
                </div>
            </div>
        </div>
    </div>
</div>




@stop


@section('scripts') 

     @include('audience.pixel._scripts');
     
@stop