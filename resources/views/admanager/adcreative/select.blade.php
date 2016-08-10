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
                    Create an Ad Creative
                    
                </div>
                <div class='panel-body'>
                                      
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/ad-creative/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Create a link Ad (not connected to a Page) </strong></span>
                    </a>
                    </div>
                     <br>
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/ad-creative-page-link/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Create a Link Ad (connected to a page) </strong></span>
                    </a>
                    </div>
                    <br>
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/ad-creative-call-to-action/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Create a Link Ad with a call to action </strong></span>
                    </a>
                    </div>
                    
                    <br>
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/ad-creative-video-page/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Create a Video Page Like Ad </strong></span>
                    </a>
                    </div>
                    
                    <br>
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/ad-creative-existing-post/create', null) }}">
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Create an Ad From an Existing Page Post </strong></span>
                    </a>
                    </div>
                    
                    <br>
                    <div class='form-group'>
                    <a href="{{ URL::to('ad/ad-creative-carousel-ad/create', null) }}">
                        {{--<i class="fa fa-plus disabled"></i>--}}
                        <i class="fa fa-plus"></i>
                        <span class="menu-text"><strong> Create a Carousel Ad </strong></span>
                    </a>
                    </div>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>



@stop


    


