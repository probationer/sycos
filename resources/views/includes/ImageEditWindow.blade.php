
  <!-- Trigger the modal with a button -->

  <button type="button" style="display:none;" id="trigger" class="btn btn-info"  data-toggle="modal" data-target="#imageEditor">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="imageEditor" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              
              <img id="imagePreview" src="{{asset('/storage/profileImage/default.png')}}" width="400px" height="400px" >
              <input type="hidden" name='x' id='x'>
              <input type="hidden" name='y' id='y'>
              <input type="hidden" name='w' id='w'>
              <input type="hidden" name='h' id='h'>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default" id='cropButton' data-dismiss="modal" name="cropImage">Crop</button>
            </div>
        </form>
      </div>
     
    
    </div>
  </div>
