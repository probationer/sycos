@extends('functional.profile.teacherProfile')


@section('comment')   
    <div id="comments" class="tabcontent" style="display:block;" >
        
                <div class="row">
                    <div class="col-sm-12" style="margin:20px;">
                        <h3>Comments</h3>
                    </div>
                </div>
            @if(privacyFunctions::checkPrivacyOnComment($userData['detail']->profilePage))

                <div class="row" style="margin-right:20px;">
                        <div class="col-sm-12" >
                            <table class="table table-striped" >
                                <tbody>
                                    <?php commentFunction::comments($userData['detail']->profilePage) ?>
                                </tbody>
                            </table>
                        </div>
                </div>
                @guest
                
                @else
                    @if(Auth::user()->name!==$userData['detail']->profilePage)
                        <div class="row">
                            <div class="col-sm-12" style="margin:10px">
                                <form action="{{asset('/comment/'.$userData['detail']->profilePage)}}" method="post">
                                    {{ csrf_field() }}
                                        <div class='form-group'>
                                            <h4>Comment</h4>
                                            {{ Form::textarea('comment','',['rows'=>'5','class'=>'form-control','placeholder'=>'Write a comment for me'])}}
                                        </div>

                                        <div class="form -group">
                                            {{Form::label('rating','How Much Knowledge do i have ?')}}
                                            <input type="hidden" value="" name="rating" />
                                                <a style="margin-left:15px;" class="rateBook" onclick="Rating(1,'rateBook')" href="javascript:void(0)"><span  class="glyphicon glyphicon-book"></span></a>
                                                <a class="rateBook" onclick="Rating(2,'rateBook')" href="javascript:void(0)"><span  class="glyphicon glyphicon-book"></span></a>
                                                <a class="rateBook" onclick="Rating(3,'rateBook')" href="javascript:void(0)"><span  class="glyphicon glyphicon-book"></span></a>
                                                <a class="rateBook" onclick="Rating(4,'rateBook')" href="javascript:void(0)"><span  class="glyphicon glyphicon-book"></span></a>
                                                <a class="rateBook" onclick="Rating(5,'rateBook')" href="javascript:void(0)"><span  class="glyphicon glyphicon-book"></span></a>

                                                <script>
                                                    
                                                </script>
                                                
                                        </div>
                                        <br>
                                        <div class='form-group'>
                                                {{Form::submit('Comment',['class'=>'btn btn-primary'])}}    
                                        </div>
     
                                </form>
                            </div>
                        </div>
                    @endif
                @endguest

            @else
                <h2 style="font-weight:100; font-family:oxygen; text-align:center;">
                    <span class="glyphicon glyphicon-eye-close"></span><br>
                        This is private contain add him/her to see content
                </h2>
            @endif
        
    </div>
    
@endsection('comment')