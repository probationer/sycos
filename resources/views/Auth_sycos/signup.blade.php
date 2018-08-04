@extends('layouts.app')

@section('content')
@guest
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Sing Up | Sycos</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="signup">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Create Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('usertype') ? ' has-error' : '' }}">
                                <label for="usertype" class="col-md-4 control-label">Account type</label>

                                <div class="col-md-6">
                                    <!--<input id="usertype" type="text"  name="usertype" value="{{ old('usertype') }}" >-->
                                    
                                    <select id="usertype" name="usertype" class="form-control">
                                        <?php
                                            $types = ['Student','Teacher','Coaching Institute','Parents or Guardian'];
                                            echo '<option>--Choose Account Type--</option>';
                                            foreach($types as $v){
                                                if($v===old('usertype')){
                                                    echo '<option selected="selected">'.$v.'</option>';
                                                }else{
                                                    echo '<option>'.$v.'</option>';
                                                }
                                            
                                            }
                                            
                                        ?>
                                        
                                    </select>
                                    @if ($errors->has('usertype'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('usertype') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="row">
            <h2>Already logged In</h2>
            <a href="{{asset('/profile/'.Auth::user()->name)}}"> View Profile </a>
        </div>
    </div>
    <?php header('Location: '.asset('/'));?>
@endguest
@endsection
