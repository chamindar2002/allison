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
                    Ad Creatives &nbsp;
                    
                    {!! link_to("ad/ad-creative/create", '', array('class'=>'fa fa-plus')) !!}
                </div>
                <div class='panel-body'>
                    <table class='table table-hover'>
                        <tr><th>Name</th><th>Status</th><th>Actions</th></tr>
                        @if(isset($ad_creatives))
                        
                        @foreach ($ad_creatives as $ad_creative)
                            <tr>
                                <td>
                                    {!! $ad_creative->name !!}
                                </td>
                                <td>
                                    {!! $ad_creative->title !!}
                                </td>
                                <td>
                                    {!! link_to("ad/ad-creative/$ad_creative->id/edit", '', array('class'=>'fa fa-pencil-square-o')) !!} 
                                    {!! link_to("ad/ad-creative/$ad_creative->id", '', array('class'=>'fa fa-trash')) !!} 
                                </td>
                            </tr>
                        @endforeach
                        
                        @endif
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<pre>
    > Link Ad with a call to action,
    > carousel ad
    > link ad (connected to a Page)
    > link ad (not connected to a Page) - default
    > Video Page Like ad
    > Ad using and existing page post
        
    https://developers.facebook.com/docs/marketing-api/reference/ad-creative/
</pre>



@stop


    


