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
                    Ad Campaigns &nbsp;
                    
                    {!! link_to("ad/ad-campaign/create", '', array('class'=>'fa fa-plus')) !!}
                </div>
                <div class='panel-body'>
                    <table class='table table-hover'>
                        <tr><th>Name</th><th>Objective</th><th>Status</th><th>Actions</th></tr>
                        @if(isset($campaigns))
                        
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <td>
                                    {!! $campaign->name !!}
                                </td>
                                <td>
                                    {!! $campaign->objective !!}
                                </td>
                                <td>
                                    {!! $campaign->status !!}
                                </td>
                                <td>
                                    {!! link_to("ad/ad-campaign/$campaign->id/edit", '', array('class'=>'fa fa-pencil-square-o')) !!} 
                                    {!! link_to("ad/ad-campaign/$campaign->id", '', array('class'=>'fa fa-trash')) !!} 
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


    


