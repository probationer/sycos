@extends('components.profile.tempLayout')


@section('content')

@if(count($userData['detail']) > 0)
    <!--<a href="../profile/{{$userData['detail']->profilePage}}/edit" class="btn btn-default ">Edit Profile</a>-->
@else
    <?php header('location: https://www.sycos.in'); ?>
@endif

<div class="container-fluid">
    <div class="col-lg-6">
             
        <div class="tab">
            <a class="tablinks" onclick="openTab(event, 'Detail')" href="{{asset('/profile/'.$userData['detail']->profilePage.'/'.'detail')}}">Details</a>
            <a class="tablinks" onclick="openTab(event, 'Articles')" href="{{asset('/profile/'.$userData['detail']->profilePage.'/'.'article')}}">Articles</a>
            <a class="tablinks" onclick="openTab(event, 'Articles')" href="{{asset('/profile/'.$userData['detail']->profilePage.'/'.'video')}}">Video</a>
            <a class="tablinks" onclick="openTab(event, 'Companions')" href="{{asset('/profile/'.$userData['detail']->profilePage.'/'.'companion')}}">Companions <span class="badge"><?php echo CompanionFunction::NewCount($userData['detail']->profilePage);?></span></a>
            <a class="tablinks" onclick="openTab(event, 'comments')" href="{{asset('/profile/'.$userData['detail']->profilePage.'/'.'comment')}}">Comments & reviews</a>        
        </div>
     
            @yield('detail')
            
            @yield('article')  
            
            @yield('companion')
    
            @yield('video')
    
            @yield('comment')

        
    </div>

</div>


@endsection('content')
