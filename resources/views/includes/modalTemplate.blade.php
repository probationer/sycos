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
             width: 40%;
             font-size:16px;
             font-style: oxygen;
             font-weight: 500;
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
     



     <div id="report" class="modal">

         <!-- Modal content -->
         <div class="modal-content">
             <span class="close">&times;</span>
             <p>{{$msg}}</p>
         </div>
     
     </div>

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