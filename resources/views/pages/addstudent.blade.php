
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    @include('inc.sidebar')
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
                        <h1 class="h4 text-gray-900 mb-4">Add Student</h1>
                      </div>
                      <form class="addStudent" id="addStudent" method="POST" enctype="multipart/form-data">
                        <h5>student details</h5>
                        <hr/>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <input type="text" class="form-control " id="firstname" name="firstname" placeholder="First Name">
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control " id="secondname" name="secondname" placeholder="Last Name">
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control " id="surname" name="surname" placeholder="surname Name">
                          </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                              <div class="dates">
                                  <input type="text"  id="picker" name="dob" class="form-control" placeholder="date of birth">
                              </div>
                            </div>
                            <div class="col-4">
                              <select class="form-control " id="grade-select" name="grade">
                                <option>Grade</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                              </select>
                            </div>
                            <dvi class="col-1">
                              <label class="form-check-label" for="inlineRadio1">Gender</label>
                            </dvi>
                            <div class="col-3">

                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                                <label class="form-check-label" for="gender">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                                <label class="form-check-label" for="gender">Female</label>
                              </div>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control " id="niims" name="niims" placeholder="niims number">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control " id="previous" name="previous" placeholder="previous school">
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control " id="admission" name="admission" placeholder="Adminssion number">
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="special">Special Needs</label>
                          <textarea class="form-control" id="special" name="special" rows="4"></textarea>
                        </div>
                        <br>
                        <h5>parents details</h5>
                        <hr/>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="father-name" name="fathernames" placeholder="Father names">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="father-contact" name="fathercontact" placeholder="Father Contact">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="father-email" name="fatheremail" placeholder="Father Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mother-name" name="mothernames" placeholder="Mother names">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mother-contact" name="mothercontact" placeholder="Mother Contact">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mother-email" name="motheremail" placeholder="Mother Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="guardian-name" name="guardiannames" placeholder="Guardian names">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="guardian-contact" name="guardiancontact" placeholder="Guardian Contact">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="guardian-email" name="guardianemail" placeholder="Guardian Email">
                            </div>
                        </div>

                        <br>
                        <h5>Additional Info</h5>
                        <hr/>

                        <div class="form-group row">
                            <label class="col-sm-3" for="exampleFormControlFile1">Student Passport</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control-file" name="passport" id="passport">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="exampleFormControlFile1">Student Birth Certificate</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control-file" name="upload" id="upload">
                            </div>
                        </div>
                        <br/><br/>

                        <button type="submit" id="submit_card" class="btn btn-primary btn-user btn-block">Add Student</button>
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

        $(document).on('submit', '#addStudent', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"{{route('student.store')}}",
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

                        $('#firstname').attr('placeholder',obj['firstname']);
                        $('#secondname').attr('placeholder',obj['secondname']);
                        $('#surname').attr('placeholder',obj['surname']);
                        $('#picker').attr('placeholder',obj['dob']);
                        $('#niims').attr('placeholder',obj['niims']);
                        $('#previous').attr('placeholder',obj['previous']);
                        $('#passport').html(obj['passport']);
                    }else{

                        var obj = data.lastId;
                        alert ("Successfully Saved");
                        //window.location.href = "/design/create?id=" + obj;
                    }


                }
            });
        });
    </script>
@endsection
