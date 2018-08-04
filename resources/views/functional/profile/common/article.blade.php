@extends('functional.profile.teacherProfile')


@section('article')
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

        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                    <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Heading</th>
                                <th>Date</th>
                                <th>Views</th>
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

