@extends('app')


@section('content')

@section('steps-menu')

    @include('partials.navsteps')

@stop


@include('admanager.wizard._messages')

<div class="container-fluid">

    @include('admanager.wizard._media_form')

</div>

<div  ng-app="wizardApp">

    <div class="container-fluid wizard-nav" ng-controller="wizardNavController">

        <ul class="ul-wz-steps">
            <li id="li_first">1 - Campaign</li>
            <li id="li_second">2 - Ad Set</li>
            <li id="li_third">3 - Media</li>
            <li id="li_fourth">4 - Ad Creative</li>
            <li id="li_fifth">5 - Ad</li>
        </ul>

    </div>

    <div class="container-fluid wizard-nav" ng-controller="wizardNavController">

        <button type="button" class="btn btn-success" ng-click="next()" id="wz-next">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-default" ng-click="prev()" id="wz-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back </button>

    </div>


    <div class="container-fluid wizard-panels" id="_fifth" style="display: none">

        @include('admanager.wizard._ads')

    </div>

    <div class="container-fluid wizard-panels" id="_fourth" style="display: none">

        @include('admanager.wizard._adcreative')

    </div>

    <div class="container-fluid wizard-panels" id="_third" style="display: none">

        @include('admanager.wizard._media')

    </div>

    <div class="container-fluid wizard-panels" id="_second" style="display: none">

        @include('admanager.wizard._adset')

    </div>

    <div class="container-fluid wizard-panels" id="_first" style="display: none">

        @include('admanager.wizard._campaign')

    </div>



    @include('admanager.wizard._product_gallery')

</div>




@stop

@section('scripts')

    <script src="{!! asset('angular/controllers/campaignCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/campaignService.js') !!}"></script>

    <script src="{!! asset('angular/controllers/adSetCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/adSetService.js') !!}"></script>

    <script src="{!! asset('angular/controllers/mediaGalleryCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/mediaService.js') !!}"></script>

    <script src="{!! asset('angular/controllers/adCreativeCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/adCreativeService.js') !!}"></script>

    <script src="{!! asset('angular/controllers/productGalleryCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/productService.js') !!}"></script>

    <script src="{!! asset('angular/controllers/adsCtrl.js') !!}"></script>
    <script src="{!! asset('angular/services/adsService.js') !!}"></script>

    <script src="{!! asset('angular/controllers/wizardNavCtrl.js') !!}"></script>



    @include('admanager.wizard._scripts')


@stop

    