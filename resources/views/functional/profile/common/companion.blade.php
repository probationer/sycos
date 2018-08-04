@extends('functional.profile.teacherProfile')


@section('companion')   
    
    <div id="Companions"  class="tabcontent" style="display:block;" >
            <div class="row">
                <div class="col-md-12" style="margin:20px;">
                    <h3> Your Companions</h3>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <?php CompanionFunction::List($userData['detail']->profilePage); ?> 
                            </tbody>
                        </table>
                    </div>
            </div>
        
    </div>
@endsection('companion')