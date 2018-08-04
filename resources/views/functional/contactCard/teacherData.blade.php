@extends('components.commonNavigation')


@section('content')
<link href="{{asset('css/profileStyle/profileCard.css')}}" rel="stylesheet" type="text/css">
        
@if(count($userData)>0)
   
    <div class="container">
        <div class="row" style="margin-top:60px;">
            <!--- profile card start-------->  
            <div class="col-md-4"></div>
            <div class="col-md-3 text-center" id="ProfileCard">
                    <div class="row" id="upperSectionOfCard" style="background-image: url({{asset('/storage/profileImage/'.$userData['detail']['imageLink'])}});">
                        <div id="upperSectionConatiner">
                            <div id="ProfileCardName">
                                {{$userData['detail']['name']}}
                            </div>
                            <p id="ProfileCardDesignation">
                                    {{$userData['detail']['type']}}
                                <br>
                                <span id="ProfileCardExperience" class="glyphicon glyphicon-earphone" >
                                    {{$userData['detail']['contactNo']}}
                                </span> 
                            </p>
                        
                        </div>
                    </div>
                    
                    <div class="row" >
                        
                        <div class="col-xs-5">
                            <p id="ProfileCardAchivements">
                                Class <br>
                                <span id="ProfileCardCount">
                                        {{$userData['cardDetail']->class}}
                                </span>
                            </p>
                        </div>
                        
                        <div class="col-xs-7">
                            <p id="ProfileCardAchivements">Subject<br>
                                <span id="ProfileCardCount">
                                        {{$userData['cardDetail']->subjects}}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div id="ProfileCardCharges">Chareges </h4>
                        <p id="ProfileCardCharge"> {{$userData['cardDetail']->Budget}} Rs</p>
                    </div>

                    <div class="row">
                        <div id="ProfileCardSpecialization">Message</h4>
                        <p id="ProfileCardTopics"> {{$userData['cardDetail']->message}}</p>
                    </div>

                    <div class="row" style="margin-bottom:10px;">
                    <a class="btn btn-primary" href="{{asset('/profile/'.$userData['detail']['profile'])}}">View Profile</a>
                    </div>
                </div>
            
            </div>
            <!--- profile card end-------->
        </div>
    </div>

@else
  
@endif

@endsection('content')