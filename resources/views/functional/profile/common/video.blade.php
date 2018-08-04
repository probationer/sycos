@extends('functional.profile.teacherProfile')

@section('video')   
    
<div id="videos"  class="tabcontent" style="display:block;" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                <h4>Tutorial Videos </h4>
            </div>
            
        </div>
        @if(privacyFunctions::checkPrivacyOnVideo($userData['detail']->profilePage))
            <div class="row">
                <div class="col-xs-6" style="margin-top:20px; float:left;">
                        <h5>Search Video :</h5>
                            <input type="text" class="form-control" id="searchInPage" placeholder="Enter video title..">
                        
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                        <table  id="content" class="table table-striped">
                            <thead>
                                <tr>
                                <th>Heading</th>
                                <th>Date</th>
                                <th>Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php  videoFunction::List($userData['detail']->profilePage);?>
                                
                            </tbody>
                        </table>
                </div>
            </div>
            <script src="{{asset('js/profileJs/searchInPage.js')}}"></script>
        @else
    
            <h2 style="font-weight:100; font-family:oxygen; text-align:center;">
                <span class="glyphicon glyphicon-eye-close"></span><br>
                    This is private contain add him/her to see content
            </h2>
        @endif
    </div>
    
</div>
@endsection('video')