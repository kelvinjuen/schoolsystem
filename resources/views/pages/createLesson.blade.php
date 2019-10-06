
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    @include('inc.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        @include('inc.topbar')
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-1">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Grade {{$_GET['grade']}} Lessons</h1>
                      </div>
                      <form class="createLesson" id="createLesson" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <input type="hidden" id="grade" name="grade" value="{{$_GET['grade']}}" />
                            <label for="grade-select" class=" col-2 form-label">Select Day</label>
                            <div class="col-sm-4">
                                <select class="custom-select" id="select-day" name="select-day">
                                    <option selected>Choose Day</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                </select>
                            </div>
                        </div>
                        <h6>Assign Lessons</h6>
                        <hr/>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-1" name="lesson-number-1" value="1" />
                            <input type="hidden" id="lesson-time-1" name="lesson-time-1" value="1" />
                            <select class="col-5 custom-select" id="lesson1-select" name="lesson-select-1">
                                <option selected>Select lesson 1</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson1-teacher" name="lesson-teacher-1">
                                <option selected>Select lesson 1 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach

                            </select>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-2" name="lesson-number-2" value="2" />
                            <input type="hidden" id="lesson-time-2" name="lesson-time-2" value="2" />
                            <select class="col-5 custom-select" id="lesson-select-2" name="lesson-select-2">
                                <option selected>Select lesson 2</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-2" name="lesson-teacher-2">
                                <option selected>Select lesson 2 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="break">
                            <input type="hidden" id="lesson-time-3" name="lesson-time-3" value="0" />
                            <input type="hidden" id="lesson-number-3" name="lesson-number-3" value="3" />
                            <input type="hidden" id="lesson-select-3" name="lesson-select-3" value="Break" />
                            <input type="hidden" id="llesson-teacher-3" name="lesson-teacher-3" value="0" />
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-4" name="lesson-number-4" value="4" />
                            <input type="hidden" id="lesson-time-4" name="lesson-time-4" value="3" />
                            <select class="col-5 custom-select" id="lesson-select-4" name="lesson-select-4">
                                <option selected>Select lesson 3</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-4" name="lesson-teacher-4">
                                <option selected>Select lesson 3 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-5" name="lesson-number-5" value="5" />
                            <input type="hidden" id="lesson-time-5" name="lesson-time-5" value="4" />
                            <select class="col-5 custom-select" id="lesson-select-5" name="lesson-select-5">
                                <option selected>Select lesson 4</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-5" name="lesson-teacher-5">
                                <option selected>Select lesson 4 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="break">
                            <input type="hidden" id="lesson-time-6" name="lesson-time-6" value="0" />
                            <input type="hidden" id="lesson-number-6" name="lesson-number-6" value="6" />
                            <input type="hidden" id="lesson-select-6" name="lesson-select-6" value="Break" />
                            <input type="hidden" id="llesson-teacher-6" name="lesson-teacher-6" value="0" />
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-7" name="lesson-number-7" value="7" />
                            <input type="hidden" id="lesson-time-7" name="lesson-time-7" value="5" />
                            <select class="col-5 custom-select" id="lesson-select-7" name="lesson-select-7">
                                <option selected>Select lesson 5</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-7" name="lesson-teacher-7">
                                <option selected>Select lesson 5 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-8" name="lesson-number-8" value="8" />
                            <input type="hidden" id="lesson-time-8" name="lesson-time-8" value="6" />
                            <select class="col-5 custom-select" id="lesson-select-8" name="lesson-select-8">
                                <option selected>Select lesson 6</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-8" name="lesson-teacher-8">
                                <option selected>Select lesson 6 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="lunch">
                            <input type="hidden" id="lesson-time-9" name="lesson-time-9" value="0" />
                            <input type="hidden" id="lesson-number-9" name="lesson-number-9" value="9" />
                            <input type="hidden" id="lesson-select-9" name="lesson-select-9" value="Lunch" />
                            <input type="hidden" id="llesson-teacher-9" name="lesson-teacher-9" value="0" />
                        </div>

                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-10" name="lesson-number-10" value="10" />
                            <input type="hidden" id="lesson-time-10" name="lesson-time-10" value="7" />
                            <select class="col-5 custom-select" id="lesson-select-10" name="lesson-select-10">
                                <option selected>Select lesson 7</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-10" name="lesson-teacher-10">
                                <option selected>Select lesson 7 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="lesson-number-11" name="lesson-number-11" value="11" />
                            <input type="hidden" id="lesson-time-11" name="lesson-time-11" value="8" />
                            <select class="col-5 custom-select" id="lesson-select-11" name="lesson-select-11">
                                <option selected>Select lesson 8</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                            <div class="col-2"></div>
                            <select class="col-5 custom-select" id="lesson-teacher-11" name="lesson-teacher-11">
                                <option selected>Select lesson 8 Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher-> user_id}}">{{$teacher-> first_name}} {{$teacher-> second_name}} {{$teacher-> surname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="break">
                            <input type="hidden" id="lesson-time-12" name="lesson-time-12" value="0" />
                            <input type="hidden" id="lesson-number-12" name="lesson-number-12" value="12" />
                            <input type="hidden" id="lesson-select-12" name="lesson-select-12" value="Break" />
                            <input type="hidden" id="llesson-teacher-12" name="lesson-teacher-12" value="0" />
                        </div>
                        <div class="game">
                            <input type="hidden" id="lesson-time-13" name="lesson-time-13" value="0" />
                            <input type="hidden" id="lesson-number-13" name="lesson-number-13" value="13" />
                            <input type="hidden" id="lesson-select-13" name="lesson-select-13" value="Games" />
                            <input type="hidden" id="llesson-teacher-13" name="lesson-teacher-13" value="0" />
                        </div>
                        <br/>
                        <button type="submit" id="submit_Lessons" class="btn btn-primary btn-user btn-block">Save Lessons</button>
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


        $(document).on('submit', '#createLesson', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"{{route('timetable.store')}}",
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

                    }else{

                        var obj = data.lastId;
                        alert ("lessons saved successfully");
                        //window.location.href = "/design/create?id=" + obj;
                    }


                }
            });
        });
    </script>
@endsection
