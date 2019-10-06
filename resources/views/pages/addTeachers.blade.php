
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add User</h1>
                      </div>
                      <form id="addUser" method="POST" enctype="multipart/form-data">
                        <h5>Personal details</h5>
                        <hr/>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <input type="text" class="form-control " id="firstname" name="firstname" placeholder="First Name" required>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control " id="secondname" name="secondname" placeholder="Last Name"required>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control " id="surname" name="surname" placeholder="surname Name"required>
                          </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-4">
                                <input type="text"  id="id_no" name="id_no" class="form-control" placeholder="id number" required>
                            </div>
                            <div class="col-4">
                                <input type="text"  id="tsc_no" name="tsc_no" class="form-control" placeholder="tsc number" >
                            </div>
                            <div class="col-4">
                                <input type="text"  id="picker" name="dob" class="form-control" placeholder="date of birth" required>
                            </div>

                        </div>
                        <br>
                        <div class="form-group row">
                            <dvi class="col-1">
                                <label class="form-check-label" for="inlineRadio1">Gender</label>
                            </dvi>
                            <div class="col-3">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-m" value="male"  checked>
                                <label class="form-check-label" for="gender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-f" value="female">
                                <label class="form-check-label" for="gender">Female</label>
                            </div>
                            </div>
                            <div class="col-4">
                                <select class="form-control " id="combo" name="combo">
                                    <option value="none" selected>Select Subject Proficient</option>
                                    <option>math/science</option>
                                    <option>swahili/english</option>
                                    <option>socialstudies/c.r.e</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control " id="grade" name="grade">
                                    <option value="none" selected>Select Grade Assigned</option>
                                    <option value="1">Grade 1</option>
                                    <option value="2">Grade 2</option>
                                    <option value="3">Grade 3</option>
                                    <option value="4">Grade 4</option>
                                    <option value="5">Grade 5</option>
                                    <option value="6">Grade 6</option>
                                </select>
                            </div>

                        </div>


                        <br>
                        <h5>education details</h5>
                        <hr/>

                        <div  id="education-wrapper">
                            <div class="form-group row" id="row-wrap-1">
                                <div class="col-sm-4">
                                    <select class="form-control " id="degree-1" name="degree-1">
                                        <option value="none" selected>Select</option>
                                        <option value="bachelors">Bachelors</option>
                                        <option value="diploma">Diploma</option>
                                        <option  value="certificate">Certicicate</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="cert-title-1" name="cert-title-1" placeholder="certificate title">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="institution-1" name="institution-1" placeholder="institution">
                                </div>
                                <div class="col-sm-2">
                                    <input type="button" class="btn btn-success add" value="+" >
                                    <input type="button" class="btn btn-danger remove" value="-" >
                                </div>

                            </div>
                        </div>

                        <br>
                        <h5>Experience details</h5>
                        <hr/>

                        <div  id="experience-wrapper">
                            <div class="form-group row" id="row-wrap1">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="company-1" name="company-1" placeholder="Institution">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="position-1" name="position-1" placeholder="Position">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="years-1" name="years-1" placeholder="Year/s Worked">
                                </div>
                                <div class="col-sm-2">
                                    <input type="button" class="btn btn-success add-experience" value="+" >
                                    <input type="button" class="btn btn-danger remove-experience" value="-" >
                                </div>

                            </div>
                        </div>



                        <br>
                        <h5>Additional Info</h5>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+254</span>
                                    </div>
                                    <input type="text"  id="phone_no" name="phone_no" class="form-control" placeholder="phone number" aria-label="phone_no" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="email"  id="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-4">
                                <input type="password"  id="password" name="password" class="form-control" placeholder="password" required>
                                <span class="password alert text-alert"></span>
                            </div>
                            <div class="col-4">
                                <input type="password"  id="password-confirm" name="password_confirmation" class="form-control" placeholder="confirm-password" required>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control " id="access-level" name="access-level">
                                    <option selected>choose user level</option>
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="finance">accountant</option>
                                    <option value="office">Office</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-3" for="exampleFormControlFile1">User Photo</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control-file" name="photo" id="photo">
                            </div>
                        </div>

                        <br/><br/>

                        <button type="submit" id="submit_card" class="btn btn-primary btn-user btn-block">Add User</button>
                        <hr>
                        {{csrf_field() }}
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; quavasolution.ac.ke</span>
            </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
    <script>
        $('#picker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            showDropdowns : true ,
            opens : 'right',
            drops : 'down',
        });

        $(document).on('submit', '#addUser', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"{{route('teacher.store')}}",
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    $('.photo').html('');
                    if(obj != null){

                        $('.password').html(obj['password']);
                    }else{

                        var obj = data.lastId;
                        alert ("Successfully Saved");
                        //window.location.href = "/design/create?id=" + obj;
                    }


                }
            });
        });

        $(document).ready(function(){
            var max_fields = 6;
            var wrapper = $("#education-wrapper");
            var wrapper_exp = $("#experience-wrapper");
            var add_button = $(".add");
            var add_experience = $(".add-experience");

            var x = 1;
            var exp = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;

                    $(wrapper).append('<div class="form-group row" id="row-wrap-'+x+'"><div class="col-sm-4">'+
                    '<select class="form-control " id="degree-'+x+'" name="degree-'+x+'"><option>bachelors</option><option>diploma</option><option>certicicate</option></select>'+
                    '</div>'+
                    '<div class="col-sm-3"><input type="text" class="form-control" id="cert-title-'+x+'" name="cert-title-'+x+'" placeholder="certificate title '+x+'" required></div>'+
                    '<div class="col-sm-3"><input type="text" class="form-control" id="institution-'+x+'" name="institution-'+x+'" placeholder="institution '+x+'" required></div>'+
                    '</div>');
                }
            });

            $(add_experience).click(function(e){
                e.preventDefault();
                if(exp < max_fields){
                    exp++;

                    $(wrapper_exp).append('<div class="form-group row" id="row-wrap1-'+exp+'"><div class="col-sm-4">'+
                    '<input type="text" class="form-control" id="company-'+exp+'" name="company-'+exp+'" placeholder="Institution '+exp+'" required></div>'+
                    '<div class="col-sm-3"><input type="text" class="form-control" id="position-'+exp+'" name="position-'+exp+'" placeholder="Position '+exp+'" required></div>'+
                    '<div class="col-sm-3"><input type="text" class="form-control" id="years-'+exp+'" name="years-'+exp+'" placeholder="Year/s worked" required></div>'+
                    '</div>');
                }
            });
            $(wrapper).on("click",".remove", function(e){
                e.preventDefault();
                if(x > 1){
                    $("#row-wrap-"+x+"").remove();
                    x--;
                }
            });

            $(wrapper_exp).on("click",".remove-experience", function(e){
                e.preventDefault();
                if(exp > 1){
                    $("#row-wrap1-"+exp+"").remove();
                    exp--;
                }
            });
        });


        function remove_field(id){
            document.getElementById(id).innerHTML="<p></p>";
        }
    </script>
@endsection
