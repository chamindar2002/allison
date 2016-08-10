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
                    Ads &nbsp;
                    
                    {!! link_to("ad/ad-publish/create", '', array('class'=>'fa fa-plus')) !!}
                </div>
                <div class='panel-body'>
                    <table class='table table-hover'>
                        <tr><th>Name</th><th>Actions</th></tr>
                        @foreach ($ads as $ad)
                            <tr>
                                <td>
                                    {!! $ad->name !!}
                                </td>
                                
                                <td>
                                    {!! link_to("ad/ad-publish/$ad->id/edit", '', array('class'=>'fa fa-pencil-square-o')) !!} 
                                    {!! link_to("ad/ad-publish/$ad->id", '', array('class'=>'fa fa-trash')) !!} 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@stop


    


