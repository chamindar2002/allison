@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>New Media (Pictures)</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'ad/ad-media', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true)) !!}

                         @include('admanager.admedia._form',['submitButtonText' => 'Upload'])

                    {!! Form::close() !!}

                    
                </div>
            </div>

            <div class='panel panel-default'>
                <div class='panel-heading'>New Media (Videos)</div>
                <div class='panel-body'>

                    {!! Form::open(array('url' => 'ad/ad-media-video', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true)) !!}

                    @include('admanager.admedia._form_video',['submitButtonText' => 'Upload'])

                    {{--temp. testing progress bar--}}

                    {{--@include('admanager.admedia._form_progress',['submitButtonText' => 'Upload'])--}}



                    {!! Form::close() !!}

                </div>
            </div>


            {{--<div class='panel panel-default'>--}}
                {{--<div class='panel-heading'>New Media (Videos)</div>--}}
                {{--<div class='panel-body'>--}}

                    {{--{!! Form::open(array('url' => 'ad/ad-media-video', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true)) !!}--}}

                    {{--@include('admanager.admedia._form_video',['submitButtonText' => 'Upload'])--}}

                    {{--temp. testing progress bar--}}

                    {{--@include('admanager.admedia._form_progress',['submitButtonText' => 'Upload'])--}}



                    {{--{!! Form::close() !!}--}}

                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
</div>



@stop


<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<link href="{{ asset('jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet"/>

@section('scripts')


    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{ asset('jquery-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    {{--<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->--}}
    <script src="{{ asset('jquery-file-upload/js/jquery.iframe-transport.js') }}"></script>
    {{--<!-- The basic File Upload plugin -->--}}
    <script src="{{ asset('jquery-file-upload/js/jquery.fileupload.js') }}"></script>

    <script>

        var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'jq-file-upload';

        $('#fileupload').fileupload({
            dataType: 'json',
            url: url,
            done: function (e, data) {

                $.each(data.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });


            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'

                );


            },

        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

        /*jslint unparam: true */
        /*global window, $ */
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = window.location.hostname === 'blueimp.github.io' ?
                    '//jquery-file-upload.appspot.com/' : 'jq-file-upload';

            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                //autoUpload: true,
                done: function (e, data) {

                    $.each(data.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });


                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            progress + '%'

                    );


                },



            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });

        function display(data){
            console.log(data);
        }
    </script>

@stop

<?php //dd(\Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities::fullview_media_path()); ?>