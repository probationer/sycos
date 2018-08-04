@extends('components.profile.tempLayout')

@section('content')


    <div class="col-md-6">
            @guest
                
            @else
                <div id="notify">
                        <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top:20px;">
                                        <h4>Requests Sent to you</h4>
                                    </div>
                                    
                                </div>
                                
                
                                <div class="row">
                                    <div class="col-md-12" style="margin-top:20px;">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Viewed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php  SycosFunctions::RequestRecived(Auth::user()->name);?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                </div>
    
            @endguest
    </div>


@endsection('content')