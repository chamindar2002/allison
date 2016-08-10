@extends('app')


@section('content')

@section('steps-menu')

     @include('partials.navsteps')
     
@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Ad Account</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::model($ad_account, ['method'=>'patch', 'action'=>['AdManager\AdAccountController@update', $ad_account->id]]) !!}
                      
                         @include('admanager.adaccount._form',['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                </div>
                    
                    <section>
                        <blockquote>
                            <p>
                                Get your Ad Account Id from <a href="https://business.facebook.com" target="_blank">here: https://business.facebook.com</a>
                                
                                <br>
                                Next:
                                <br>
                            
                                
                            </p>
                          </blockquote>
                        
                            <pre>
                                1. Select Business Settings -> Ad Accounts.<br>
                                <img src="{!! asset('img/business-settings.png') !!}" >
                                <hr>
                                2. You'll now see your Ad Account Id as highlighted. <br>
                                <img src="{!! asset('img/ad-account-id.png') !!}" >
                                <hr>
                                3. If you do not have an Ad Account, Create a new Account from the button on top right hand corner. <br>
                                <img src="{!! asset('img/new-ad-account.png') !!}" >
                            </pre>
                                
                    </section>
                    
                
            </div>
        </div>
    </div>
</div>




@stop


    