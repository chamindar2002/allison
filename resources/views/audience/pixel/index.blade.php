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
                    Pixel
                    @if($audience_pixel == null)
                        {!! link_to("ad/audience-pixel/create", '', array('class'=>'fa fa-plus')) !!}
                    @endif
                </div>
                <div class='panel-body'>
                                      
                    <table class='table table-hover'>
                       
                        <tr><th>Name</th><th>Pixel Id</th><th>Actions</th></tr>
                         @if($audience_pixel != null)
                        <tr>
                            <td>{!! $audience_pixel->name !!}</td>
                            <td>{!! $audience_pixel->pixel_id !!}</td>
                            <td>
                                {!! link_to("ad/audience-pixel/$audience_pixel->id/edit", '', array('class'=>'fa fa-pencil-square-o')) !!} 
                                {!! link_to("ad/audience-pixel/$audience_pixel->id", '', array('class'=>'fa fa-code')) !!} 
                               
                            </td>
                        </tr>
                        @endif
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@stop


    


