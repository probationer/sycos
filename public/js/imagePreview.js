$("#profileImageEg").click(function(e) {
    $("#imageUpload").click();
});


function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
        $("#profileImageEg").attr('src', 
            window.URL.createObjectURL(uploader.files[0]) );
    }
}


$("#imageUpload").change(function(){
    fasterPreview( this );

    //first upload the image then crop
    
});