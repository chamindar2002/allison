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
                    Create a Custom Audience
                    
                </div>
                <div class='panel-body'>
                                      
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/audience-custom/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Website Traffic </strong></span>
                    </a>
                    </div>
                    <br>
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/audience-custom-customer-list/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Customer List </strong></span>
                    </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@stop


    


