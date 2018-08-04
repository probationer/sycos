


function openTab(evt, name) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(name).style.display = "block";
    evt.currentTarget.className += " active";
}

function Rating(rate,className){
    var book = document.getElementsByClassName(className);

    for(var i =0 ; i<5; i++){
        if(i<rate)
            book[i].style.color = '#ffe800';
        else
            book[i].style.color = 'black';
    }

    document.getElementsByName('rating')[0].value = rate;
}
    