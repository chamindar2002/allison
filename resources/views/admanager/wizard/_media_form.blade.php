<div class="modal fade" id="admedia-modal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ad Media</h4>
            </div>

            <div class="panel-body">

                <div class="panel-body">

                    <div class='form-group'>
                        {!! Form::label('media_file','Upload Image', ['class'=>'col-md4 control-label']) !!}
                        <i class="fa fa-picture-o" aria-hidden="true"></i>

                        {!! Form::file('media_file',array('id'=>'media_file')) !!}

                    </div>

                    <div  class='form-group'>

                            {!! Form::label('media_file','&nbsp;', ['class'=>'col-md4 control-label']) !!}
                            <input type="button" value="Upload" id="btn_upload", class="btn btn-primary form-control">

                    </div>


                    <hr />

                    <div class='form-group'>
                        {!! Form::label('media_file_video','Upload Video', ['class'=>'col-md4 control-label']) !!}
                        <i class="fa fa-video-camera" aria-hidden="true"></i>

                            {!! Form::file('media_file_video') !!}


                    </div>




                    <div class='form-group'>

                        {!! Form::label('media_file_video','&nbsp;', ['class'=>'col-md4 control-label']) !!}

                        <input type="button" value="Upload" id="btn_upload_video", class="btn btn-primary form-control">
                            {!! Form::hidden('media_type', 'video') !!}

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



