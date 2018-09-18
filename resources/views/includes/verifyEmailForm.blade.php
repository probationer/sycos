


<div class="sticky ">
        <form class="form-inline text-center" action="{{asset('/VerifyEmail')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label style="font:400 18px oxygen; color:white;"> Verify Your Account </label>
                <input type="text" class="form-control" placeholder="Enter Verification Code" name="verification_code">
            </div>

                <button type="submit" class="btn btn-danger">Submit</button>
            
            <div class="form-group">
                <label style="font:200 14px oxygen; color:white; margin:10px">
                    <a href="{{asset('/resendCode')}}" style="color:white;">Resend Verification Code</a>
                </label>
                
            </div>
            
        </form>
</div>




<style>
    div.sticky {
        border-radius: 2px;
        position: -webkit-sticky;
        position: sticky;
        bottom: 0;
        z-index: 2;
        background-color:#3c5375;
        padding: 5px;
        font:300 16px oxygen;
        
    }
    </style>