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
                    Lookalike Audience
                    
                        {!! link_to("ad/audience-lookalike/create", '', array('class'=>'fa fa-plus')) !!}
                    
                </div>
                <div class='panel-body'>
                                      
                    <table class='table table-hover'>
                       
                        <tr><th>Name</th><th>Actions</th></tr>
                        @if(isset($lookalike_audience))
                        
                        @foreach ($lookalike_audience as $la)
                            <tr>
                                <td>
                                    {!! $la->name !!}
                                </td>
                                <td>
                                    
                                {!! link_to("ad/audience-lookalike/$la->id/edit", '', array('class'=>'fa fa-pencil-square-o')) !!} 
                                {!! link_to("ad/audience-lookalike/$la->id", '', array('class'=>'fa fa-trash')) !!} 
                               
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


    


