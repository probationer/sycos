        <link rel="stylesheet" type="text/css" href="{{asset('css/tag.css')}}">
        <script src="{{asset('js/tag.js')}}"></script>
        <div class="modal fade" id="newGroup" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                
                <div class="modal-body">
                    <form method="post" action="{{asset('/groupifyNew')}}">
                            {{ csrf_field() }}
                        <div class="form-group" >
                            <input class="form-control" type="text" name="gname" placeholder="Enter Group Name" />
                            <input class="form-control" type="text" name="tags" placeholder="Enter tag" />
                            <input type="hidden" name="page" value="{{SycosFunctions::pageAddress()}}" />
                            <select name="link" class="selectpicker show-menu-arrow form-control" required="" data-max-options="1" data-live-search="true">
                                {!!SycosFunctions::content_list(SycosFunctions::pageAddress())!!}
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit" >Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button close" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addtoGroup" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                    
                    <div class="modal-body">
                        <form method="post" action="{{asset('/groupify')}}">
                                {{ csrf_field() }}
                            <div class="form-group" >
                                Select Group
                                <select  name="group" class="selectpicker show-menu-arrow form-control" required="" data-max-options="1" data-live-search="true" placeholder="Select Group">
                                    <option></option>
                                    {!!SycosFunctions::group_list()!!}
                                </select>
                                <input type="hidden" name="page" value="{{SycosFunctions::pageAddress()}}" />
                                    Select Article
                                <select  name="link" class="selectpicker show-menu-arrow form-control" required="" data-max-options="1" data-live-search="true">
                                    <option></option>
                                    {!!SycosFunctions::content_list(SycosFunctions::pageAddress())!!}
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit" >Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button close" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function(){
                    $('[data-toggle="popover"]').popover({html: true});   
                });

                // get modal id
                var modal = document.getElementById('newGroup');
                

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function(event) {
                    if(even.target == span){
                        modal.style.display = "none";
                    }
                   
                }
            </script>