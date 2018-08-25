@extends('functional.profile.teacherProfile')

@section('article')
@include('includes.content_groupForm')
<div id="Articles"  class="tabcontent" style="display:block;"  >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                <h4>Articles Written </h4>
            </div>
            
        </div>
        
    @if(privacyFunctions::checkPrivacyOnArticle($userData['detail']->profilePage))
            <div class="row">
                <div class="col-xs-6" style="margin-top:20px; float:left;">
                        <h5>Search articles :</h5>
                            <input type="text" class="form-control" id="articleSearch" placeholder="Enter article title..">
                </div>
            </div>
            @if((Auth::user()) && (Auth::user()->id == $userData['detail']->user_id))
                <div class="row">
                    <div class="col-xs-6" style="margin-top:10px; float:left;">
                        <a class="btn btn-success" href="javascript:void(0)" data-placement="right" data-trigger="focus" data-toggle="popover" data-content="{{articleFunction::grouperList()}}" ><span class="glyphicon glyphicon-folder-close" ></span> Make Groups</a>               
                    </div>
                </div>
            @endif

            <style>
                #ArticleMenu{
                    color:aquamarine;
                }
                #ArticleMenu:hover{
                    color:black;
                }
            </style>
            
        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                    <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Heading</th>
                                <th>Group Name</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody id="articleTable">
                                <?php  articleFunction::List($userData['detail']->profilePage);?>
                            
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
@endsection('article')

