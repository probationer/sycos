@if(count($errors) > 0)

    @foreach($errors->all() as $e)
        <?php 
            $msg =null;
            $msg .= $e.', ';
        ?>
    @endforeach
    @include('includes.modalTemplate')
@endif

@if(session('success'))
    <?php $msg = session('success');?>
    @include('includes.modalTemplate')
@endif

@if(session('error'))
    <?php $msg = session('error');?>
    @include('includes.modalTemplate')
@endif

@if(session('report'))
    <?php $msg = session('report');?>
    @include('includes.modalTemplate')
@endif

@if(session('login'))
    <?php $msg = session('login');?>
    @include('includes.loginTemplate')
@endif