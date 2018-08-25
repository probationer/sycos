<div id="report" class="modal">
    <!-- Modal content -->


    <div class="container modal-content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login | Sycos </div>
                    <div class="alert alert-info text-center">
                        {{$msg}}
                    </div>
                          
                    <div class="panel-body">
                            
                        <form class="form-horizontal" method="POST" action="{{asset('/login/'.SycosFunctions::pageAddress())}}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
    
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a><br><br>
                                    <a class="btn btn-link" href="/signup">
                                        Don't have login? Create an account.
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <style>
            .modal {
                 display:block;
                 position: fixed; /* Stay in place */
                 z-index: 1; /* Sit on top */
                 padding-top: 100px; /* Location of the box */
                 left: 0;
                 top: 0;
                 width: 100%; /* Full width */
                 height: 100%; /* Full height */
                 overflow: auto; /* Enable scroll if needed */
                 background-color: rgb(0,0,0); /* Fallback color */
                 background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
             }
    
             /* Modal Content */
             .modal-content {
                 background-color: #fefefe;
                 margin: auto;
                 padding: 30px;
                 border: 1px solid blue;
                 width: 80%;
                 
             }
    
             /* The Close Button */
             .close {
                 color: #aaaaaa;
                 float: right;
                 font-size: 28px;
                 font-weight: bold;
             }
    
             .close:hover,
             .close:focus {
                 color: #000;
                 text-decoration: none;
                 cursor: pointer;
             }
    
         </style>
         
    
    
    
         
    
         <script>
         // get modal id
             var modal = document.getElementById('report');
    
    
             // Get the <span> element that closes the modal
             var span = document.getElementsByClassName("close")[0];
    
             // When the user clicks anywhere outside of the modal, close it
             window.onclick = function(event) {
                 if (event.target == modal) {
                     modal.style.display = "none";
                 }
             }
    
             // When the user clicks on <span> (x), close the modal
             span.onclick = function() {
                 modal.style.display = "none";
             }
    </script>