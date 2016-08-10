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
                    Custom Audience
                    
                        {!! link_to("ad/create-select", '', array('class'=>'fa fa-plus')) !!}
                    
                </div>
                <div class='panel-body'>
                                      
                    <table class='table table-hover'>
                       
                        <tr><th>Name</th><th>Delivery Status</th><th>Actions</th></tr>
                        @if(isset($custom_audience))
                        
                        @foreach ($custom_audience as $ca)
                            <tr>
                                <td>
                                    {!! $ca->name !!}                      
                                </td>
                                <td>
                                    {!! $ca->delivery_status_description !!}
                                </td>
                                <td>    
                                {!! link_to("ad/audience-custom/$ca->id/edit", '', array('class'=>'fa fa-pencil-square-o')) !!} 
                                {!! link_to("ad/audience-custom/$ca->id", '', array('class'=>'fa fa-trash')) !!} 
                               
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



@stop


    


