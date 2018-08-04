<!DOCTYPE html>
<html >
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{asset('assetsHome/images/logono-background-364x126.png')}}" type="image/x-icon">
  <meta name="description" content="Web Site Builder Description">
  <title>FeedBack | Sycos</title>
  <link rel="stylesheet" href="{{asset('assetsHome/web/assets/mobirise-icons/mobirise-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/tether/tether.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/bootstrap/css/bootstrap-grid.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/bootstrap/css/bootstrap-reboot.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/dropdown/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/animatecss/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/socicon/css/styles.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/theme/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assetsHome/mobirise/css/mbr-additional.css')}}" type="text/css">
  
  
  
</head>
<body>
    @include('mainPages.mainPagesNav')
    <section class="mbr-section form1 cid-qX6AV5p4lU" id="form1-12">
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">Suggestion/Request Box</h2>
                    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid">
                        <div data-form-alert="" hidden="">Thanks for filling out the form!</div>
                
                        <form class="mbr-form" action="{{asset('/feedback')}}" method="post" data-form-title="Feedback">
                            
                            <div class="row row-sm-offset">
                                <div class="col-md-4 multi-horizontal" data-for="name">
                                    <div class="form-group">
                                        <label class="form-control-label mbr-fonts-style display-7" for="name-form1-12">Name</label>
                                        <input type="text" class="form-control" name="name" data-form-field="Name" required="" placeholder="Enter Name" id="name-form1-12">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="form-group" data-for="message">
                                <label class="form-control-label mbr-fonts-style display-7" for="message-form1-12">Message</label>
                                <textarea type="text" class="form-control" name="message" rows="7" data-form-field="Message" placeholder="Your Message/comment/request/complaint" id="message-form1-12"></textarea>
                            </div>
                            {{ csrf_field() }}
                            <span class="input-group-btn"><button href="" type="submit" class="btn btn-form btn-white-outline display-4">Send Message</button></span>
                        </form>
                </div>
            </div>
        </div>
    </section>

    @include('mainPages.mainpageFooter')


  <script src="{{asset('assetsHome/web/assets/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assetsHome/popper/popper.min.js')}}"></script>
  <script src="{{asset('assetsHome/tether/tether.min.js')}}"></script>
  <script src="{{asset('assetsHome/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assetsHome/smoothscroll/smooth-scroll.js')}}"></script>
  <script src="{{asset('assetsHome/dropdown/js/script.min.js')}}"></script>
  <script src="{{asset('assetsHome/touchswipe/jquery.touch-swipe.min.js')}}"></script>
  <script src="{{asset('assetsHome/viewportchecker/jquery.viewportchecker.js')}}"></script>
  <script src="{{asset('assetsHome/theme/js/script.js')}}"></script>
  <script src="{{asset('assetsHome/formoid/formoid.min.js')}}"></script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>