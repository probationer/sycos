function ChangeStatus(){
    var attribute = document.getElementById("StatusId").hasAttribute("checked");
    
    if(attribute){
        document.getElementById("StatusId").removeAttribute("checked");
        document.getElementById("below_profile_status").innerHTML  = "Unavailable";
        
    }else{
        document.getElementById("StatusId").setAttribute("checked","checked");
        document.getElementById("below_profile_status").innerHTML  = "Available";
    }
    
}

function ChangeStatusStuedent(){
    var attribute = document.getElementById("StatusId").hasAttribute("checked");
    
    if(attribute){
        document.getElementById("StatusId").removeAttribute("checked");
        document.getElementById("below_profile_status").innerHTML  = "Teacher not require";
        
    }else{
        document.getElementById("StatusId").setAttribute("checked","checked");
        document.getElementById("below_profile_status").innerHTML  = "Teacher Require";
    }
    
}