<div class='form-group'>
    {!! Form::label('thumb_images','Thumb Images', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'></div>
</div>

@if(!empty($thumb_images))

    <table class='table table-hover'>
        @foreach($thumb_images As $key=>$thumb_image)
            <tr>
                <td>
                    @if($key == 0)
                        {!! Form::radio('thumb_url',  $thumb_image, true, ['class'=>'']) !!}
                    @else
                        {!! Form::radio('thumb_url',  $thumb_image, false, ['class'=>'']) !!}
                    @endif
                </td>

                <td><img title="" src="{!! $thumb_image !!}" width="50px"></td>
            </tr>
        @endforeach

    </table>


    @if(count($thumb_images) > 0)

        <div class='form-group'>
            <div class='col-md-6'>
                {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
            </div>
        </div>

    @else

        <div class='form-group'>
            <div class='col-md-6'>
                <a href="{{ URL::to('ad/ad-media-video-thumbs/'.$media->id, null) }}">
            </div>
        </div>

    @endif

@else

    <strong>No images found</strong>

@endif


