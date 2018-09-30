
    $(document).ready(function(){
        $("#articleSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#articleTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
    });

    $(document).ready(function(){
        $("#searchInPage").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#content tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
    });

    $(document).ready(function(){
        $("#searchInPage").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#wholeContainer #content").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
    });

    //link with searchPage
    $(document).ready(function(){
        $("#contentSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".middle-section-inside .container-fluid").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
    });