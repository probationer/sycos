@extends('components.site_forms.form_layout');


@section('content')
<div class="middle">
    <div class="container" id="wholeForm">
        <div class="text-center">
            
                
             
            <form method="post" class="form-horizontal" action="guardian_join_data.php" >
                           
                        <div class="form-group">
                             <div class="col-sm-12" id="heading">Some Details About Your Choices</div>
                         </div>
                
 <!--                        <div id="profile-container">
                             <center><image id="profileImage" src="avater2.png"  class="img-responsive" style="width:150px;"/></center>
                             <p style="font:500 18px roboto;">Upload Your Image</p>
                         </div>
                         <input id="imageUpload" type="file"name="profile_img" placeholder="Photo" capture>
 
 
                         <script>
                             $("#profileImage").click(function(e) {
                                 $("#imageUpload").click();
                             });
 
                             function fasterPreview( uploader ) {
                                 if ( uploader.files && uploader.files[0] ){
                                       $('#profileImage').attr('src', 
                                          window.URL.createObjectURL(uploader.files[0]) );
                                 }
                             }
 
                             $("#imageUpload").change(function(){
                                 fasterPreview( this );
                             });
                         </script> -->
                         
                         <div class="form-group">
                         <div class="col-sm-12">
                             <label for="TextArea" class="col-sm-12" style="font:400 20px roboto;">Your Name</label>
                             <input type="text" class="form-control" name="name" placeholder="Enter guardian name" required="" />
                             
                         </div>
                     </div>
                
                         <div class="form-group">
                         <label class="col-sm-12" for="TextArea" style="font:400 20px roboto;">Select Your Subject(s)</label>
                         <div class="col-sm-12">
                             <select class="selectpicker show-menu-arrow form-control" name="subj[]"  required="" multiple  data-live-search="true" data-max-options="12">
                                 <option value="Accounts">Accounts</option>
                                 <option value="Bank">Bank</option>
                                 <option value="Biology">Biology</option>
                                 <option value="Business Studies">Business Studies</option>
                                 <option value="C or C++">C or C++</option>
                                 <option value="CA">CA</option>
                                 <option value="Chemistry">Chemistry</option>
                                 <option value="CS">CS</option>
                                 <option value="Economics">Economics</option>
                                 <option value="English">English</option>
                                 <option value="French">French</option>
                                 <option value="Geography">Geography</option>
                                 <option value="German">German</option>
                                 <option value="Hindi">Hindi</option>
                                 <option value="History">History</option>
                                 <option value="Html">Html</option>
                                 <option value="Java">Java</option>
                                 <option value="Mathematics">Mathematics</option>
                                 <option value="Physics">Physics</option>
                                 <option value="Political Science">Political Science</option>
                                 <option value="Sanskrit">Sanskrit</option>
                                 <option value="Science">Science</option>
                                 <option value="Social Science">Social Science</option>
                                 <option value="SSC">SSC</option>
 
                             </select>
                         </div>
                     </div>
 
                     <div class="form-group">
                         <label for="TextArea" class="col-sm-12" style="font:400 20px roboto;">Select Your Classes</label>
                         <div class="col-sm-12">
                             <select class="selectpicker show-menu-arrow form-control" name="clas[]" required="" multiple data-live-search="true" data-max-options="6">
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                                 <option value="9">9</option>
                                 <option value="10">10</option>
                                 <option value="11">11</option>
                                 <option value="12">12</option>
                                 <option value="B.A">B.A</option>
                                 <option value="B.Com">B.Com</option>
                                 <option value="B.Sc">B.Sc</option>                                            
                                 <option value="B.TECH">B.TECH</option>
                             </select>
                         </div>
                     </div>
                         
                
                     <div class="form-group">
                         <label for="basic2" class="col-sm-12" style="font:400 20px roboto;">State/City</label>
                         <div class="col-sm-12 control-label">
                             <select class="selectpicker show-tick form-control" name="state" required="" data-live-search="true">
                             <option value="Agartala">Agartala</option> 
                              <option value="Ahmedabad">Ahmedabad</option> 
                              <option value="Aizawl">Aizawl</option> 
                              <option value="Andhra Pradesh">Andhra Pradesh</option> 
                              <option value="Arunachal Pradesh">Arunachal Pradesh</option> 
                              <option value="Assam">Assam</option> 
                              <option value="Bangalore">Bangalore</option> 
                              <option value="Bhopal">Bhopal</option> 
                              <option value="Bhubaneswar">Bhubaneswar</option> 
                              <option value="Bihar">Bihar</option> 
                              <option value="Chandigarh">Chandigarh</option> 
                              <option value="Chennai">Chennai</option> 
                              <option value="Chhattisgarh">Chhattisgarh</option> 
                              <option value="Dehradun">Dehradun</option> 
                              <option value="Delhi">Delhi</option> 
                              <option value="Dispur">Dispur</option> 
                              <option value="Faridabad">Faridabad</option> 
                              <option value="Gandhinagar">Gandhinagar</option> 
                              <option value="Gangtok">Gangtok</option> 
                              <option value="Ghaziabad">Ghaziabad</option> 
                              <option value="Goa">Goa</option> 
                              <option value="Gujarat">Gujarat</option> 
                              <option value="Haryana">Haryana</option> 
                              <option value="Himachal Pradesh">Himachal Pradesh</option> 
                              <option value="Hyderabad">Hyderabad</option> 
                              <option value="Imphal">Imphal</option> 
                              <option value="Itanagar">Itanagar</option> 
                              <option value="Jaipur">Jaipur</option> 
                              <option value="Jammu">Jammu</option> 
                              <option value="Jharkhand">Jharkhand</option> 
                              <option value="Kanpur">Kanpur</option> 
                              <option value="Karnataka">Karnataka</option> 
                              <option value="Kashmir">Kashmir</option> 
                              <option value="Kerala">Kerala</option> 
                              <option value="Kohima">Kohima</option> 
                              <option value="Kolkata">Kolkata</option> 
                              <option value="Lucknow">Lucknow</option> 
                              <option value="Madhya Pradesh">Madhya Pradesh</option> 
                              <option value="Maharashtra">Maharashtra</option> 
                              <option value="Manipur">Manipur</option> 
                              <option value="Meghalaya">Meghalaya</option> 
                              <option value="Mizoram">Mizoram</option> 
                              <option value="Mumbai">Mumbai</option> 
                              <option value="Nagaland">Nagaland</option> 
                              <option value="Nagpur">Nagpur</option> 
                              <option value="Orissa">Orissa</option> 
                              <option value="Panaji">Panaji</option> 
                              <option value="Patna">Patna</option> 
                              <option value="Pune">Pune</option> 
                              <option value="Punjab">Punjab</option> 
                              <option value="Raipur">Raipur</option> 
                              <option value="Rajasthan">Rajasthan</option> 
                              <option value="Ranchi">Ranchi</option> 
                              <option value="Shillong">Shillong</option> 
                              <option value="Shimla">Shimla</option> 
                              <option value="Sikkim">Sikkim</option> 
                              <option value="Srinagar">Srinagar</option> 
                              <option value="Surat">Surat</option> 
                              <option value="Tamil Nadu">Tamil Nadu</option> 
                              <option value="Telangana">Telangana</option> 
                              <option value="Thiruvananthapuram">Thiruvananthapuram</option> 
                              <option value="Tripura">Tripura</option> 
                              <option value="Uttar Pradesh">Uttar Pradesh</option> 
                              <option value="Uttarakhand">Uttarakhand</option> 
                              <option value="Visakhapatnam">Visakhapatnam</option> 
                              <option value="West Bengal">West Bengal</option> 
                             </select>
                         </div>
                     </div>
                
                
                     <div class="form-group">
                         <div class="col-sm-12">
                             <label for="TextArea" class="col-sm-12" style="font:400 20px roboto;">Pin-code</label>
                             <input type="numeric" class="form-control" name="pincode" placeholder="Enter 6-digit picode" required="" onchange="PincodeCheck()"/>
                             <span id='pincodeNo' style="font-family: roboto;font-size: 11px; font-style: italic; color: red;"></span>
                         </div>
                     </div>
                
                     
                     <div class="form-group">
                         <div class="col-sm-12">
                             <label>Your Location<span style="font-size: 12px; font-style: italic; color:blue;"> (eg: Laxmi Nagar)</span></label>
                             <input type="text" class="form-control" name="locality" placeholder="Enter your location or locality" /> 
                         </div>
                     </div>
                     
                     
                     <div class="form-group">
                         <div class="col-sm-12">
                             <label>Mobile Number<span style="font-weight: 400;font-size: 12px;color:blue;"> (this will not shown to other)</span></label>
                             <input type="numeric" class="form-control" name="contactNo" placeholder="Enter 10-digit mobile number" onchange="PhoneNumberValidation()" required/>
                             <span id='ContactNumber' style="font-family: roboto;font-size: 11px; font-style: italic; color: red;"></span>
                         </div>
                     </div>
 
                         
 
                         <div class="form-group">
                             <div class="col-sm-12">
                                 
                                <button type="button" id="submit" class="button login" name="submit"> Submit </button>
                             </div>   
                         </div>
                             
                    </form>
       </div>
 
   </div>
 
 </div>
@endsection('content')