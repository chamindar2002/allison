<?php //dd($results); ?>
@if(sizeof($results) > 0)

<strong>Recent Posts</strong>
<table class='table table-hover'>
    @foreach ($results as $result)

    <tr>
        <td>
            {!! Form::radio('posts[]', $result->id, true, ['class'=>'opt_posts']) !!}
        </td>
        <td>

                @if(isset($result->message))
                    {!! $result->message !!}
                @elseif(isset($result->story))
                    {!! $result->story !!}
                @else
                    {!! '-' !!}
                @endif

        </td>


    </tr>

    @endforeach
</table>
@endif


