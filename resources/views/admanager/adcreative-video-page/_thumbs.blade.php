@if(sizeof($results) > 0)

<ul class="img-library">
    @foreach ($results as $result)

        <li class="img-library-item">
            {!! Form::radio('thumbs[]', $result->id, true, ['class'=>'opt_thumbs', 'uri'=>$result->uri]) !!}
            <img src="{!! $result->uri !!}" width="100px">
        </li>

    @endforeach
</ul>

@endif
