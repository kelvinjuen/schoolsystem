
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    @include('inc.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        @include('inc.topbar')
        <div class="container-fluid">
            <div class="card o-hidden border-0 shadow-lg my-2">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="p-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Grade
                                <span class="gradeLabel">
                                    @if (Auth::user()->class == 0)
                                        1
                                    @else
                                        {{ Auth::user()->class }}
                                    @endif

                                </span>
                                TimeTable
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <form>
                                    <div class="form-group row">
                                        <label for="grade-select" class="col-sm-4 col-form-label">Select Grade</label>
                                        <div class="col-sm-6">
                                            <select class="custom-select grade-select" id="grade-select">
                                                <option selected >Choose Grade</option>
                                                <option value="1">Grade 1</option>
                                                <option value="2">Grade 2</option>
                                                <option value="3">Grade 3</option>
                                                <option value="4">Grade 4</option>
                                                <option value="5">Grade 5</option>
                                                <option value="6">Grade 6</option>
                                                <option value="7">Grade 7</option>
                                                <option value="8">Grade 8</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#createTimeModal" data-whatever="@mdo">Create TimeTable</button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModal" data-whatever="@mdo">Update TimeTable</button>
                                <a href="printtimetable/1" target="_blank" class="btn btn-info timetable">Print</a>
                            </div>
                        </div>

                        <table class="table table-sm table-bordered " id="time-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">DAY</th>
                                    <th scope="col">Les 1</th>
                                    <th scope="col">Les 2</th>
                                    <th scope="col"></th>
                                    <th scope="col">Les 3</th>
                                    <th scope="col">Les 4</th>
                                    <th scope="col"></th>
                                    <th scope="col">Les 5</th>
                                    <th scope="col">Les 6</th>
                                    <th scope="col"></th>
                                    <th scope="col">Les 7</th>
                                    <th scope="col">Les 8</th>
                                    <th scope="col"></th>
                                    <th scope="col">Games</th>
                                </tr>
                            </thead>

                        </table>

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
    <!-- create time Table -->
    <div class="modal fade" id="createTimeModal" tabindex="-1" role="dialog" aria-labelledby="createTimeLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create TimeTable For:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="choose-class" id="selectGradeForm">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="grade-select" class="col-sm-4 col-form-label">Select Grade</label>
                            <div class="col-sm-8">
                                <select class="custom-select select-grade" id="select-grade">
                                    <option selected value="1">Grade 1</option>
                                    <option value="2">Grade 2</option>
                                    <option value="3">Grade 3</option>
                                    <option value="4">Grade 4</option>
                                    <option value="5">Grade 5</option>
                                    <option value="6">Grade 6</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                </select>
                            </div>
                        </div>
                        <strong class="text-center"><span class="warning text-danger "></span></strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update TimeTable</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="updateForm" id="updateForm" method="POST">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="grade-select" class="col-sm-4 col-form-label">Select Grade</label>
                    <div class="form group col-sm-8">
                        <select class="custom-select update-grade-select" id="update-grade-select">
                            <option selected value="select">Select Grade</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                        </select>
                        <small id="grade_warning" class="form-text text-danger"></small>
                    </div>

                </div>
                <fieldset id="fieldset1" disabled>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="custom-select select-day" id="select-day" name="select-day">
                                <option selected value="select">Choose Day</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="custom-select select-Lesson" id="select-Lesson">
                                <option selected value="select">Select Lesson</option>
                                <option value="1">Lesson 1</option>
                                <option value="2">Lesson 2</option>
                                <option value="3">Lesson 3</option>
                                <option value="4">Lesson 4</option>
                                <option value="5">Lesson 5</option>
                                <option value="6">Lesson 6</option>
                                <option value="7">Lesson 7</option>
                                <option value="8">Lesson 8</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="fieldset2" disabled>
                    <div class="form-row ">
                            <div class="form-group col-6">
                            <small id="current_lesson" class="form-text text-muted">Current Lesson</small>
                            <strong id="currentlesson" class="form-text text-muted"></strong>
                        </div>
                        <div class="form-group col-6">
                            <small id="current_teacher" class="form-text text-muted">Current teacher</small>
                            <strong id="currentteacher" class="form-text text-muted"></strong>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <select class="custom-select" id="new-lesson" name="new-lesson">
                                <option selected value="select">Select New lesson</option>
                                <option value="math">Math</option>
                                <option value="english">English</option>
                                <option value="swahili">Swahili</option>
                                <option value="social studies">Social Studies</option>
                                <option value="cre">Cre</option>
                                <option value="science">Science</option>
                                <option value="p.e">P.E</option>
                                <option value="music">Music</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <select class="custom-select lesson-teacher" id="lesson-teacher" name="lesson-teacher">
                                <option selected value="select">Select New lesson Teacher</option>
                            </select>
                            <input type="hidden" name="_method" id="_method" value="PUT">

                        </div>
                        {{csrf_field() }}
                        <strong id="teacher_warning" class="form-text text-danger"></strong>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="update-btn" class="btn btn-warning" disabled>Update TimeTable</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <!-- end of create timetable modal -->

    <script>
        var viewTable;
        var updateGrade;
        var updateDay;
        var updateLesson;
        var lesson_id;
        var selectedteacher = 'select';
        $(document).ready(function() {

            //$.noConflict();
           viewTable = $('#time-table').DataTable({
                "paging": false,
                "filter": false,
                "info":false,
                "ordering":false,
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                "ajax":{
                    "url":"/gettimetable/"+{{ Auth::user()->class }},
                    "type":"GET"
                },
                columns: [
                    {
                         "data": "0",
                         "defaultContent":""
                    },
                    {
                        "data": "1",
                        "defaultContent":""
                    },
                    {
                        "data": "2",
                        "defaultContent":""

                    },
                    {
                        "data": "3",
                        "defaultContent":"<h1>B</h1>"
                    },
                    {
                        "data": "4",
                        "defaultContent":""
                    },
                    {
                        "data": "5",
                        "defaultContent":""
                    },
                    {
                        "data": "6",
                        "defaultContent":"<h1>B</h1>"
                    },
                    {
                        "data": "7",
                        "defaultContent":""
                    },
                    {
                        "data": "8",
                        "defaultContent":""
                    },
                    {
                        "data": "9",
                        "defaultContent":"<h1>L</h1>"
                    },
                    {
                        "data": "10",
                        "defaultContent":""
                    },
                    {
                        "data": "11",
                        "defaultContent":""
                    },
                    {
                        "data": "12",
                        "defaultContent":"<h1>B</h1>"
                    },
                    {
                        "data": "13",
                        "defaultContent":"Games"
                    },
                ],

            });
        });

        $('#updateModal').on('hidden.bs.modal',  function(e){

        });

        $("select.grade-select").change(function(){
            var selectedGrade = $(this).children("option:selected").val();
            loadTable(selectedGrade);
        });

        $("select.update-grade-select").change(function(){
            updateGrade = $(this).children("option:selected").val();

            if(updateGrade !== 'select'){
                $.ajax({
                    url:"/checktimetable/"+updateGrade,
                    method:'GET',
                    async: false,
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {

                        var obj = data.data;
                        if(obj != null){
                            $('#grade_warning').html('');
                            $('#fieldset1').prop('disabled',false);
                            $('.select-Lesson').val('select');
                        }else{
                            $('#grade_warning').html('Timetable for grade '+updateGrade+' has not been created');
                            $('.select-Lesson').val('select');
                            $('#fieldset1').prop('disabled',true);
                            $('#fieldset2').prop('disabled',true);
                            $('#update-btn').prop('disabled',true);
                        }

                    }
                });
            }
        });

        $("select.select-day").change(function(){
            updateDay = $(this).children("option:selected").val();
            $('.select-Lesson').val('select');
            $('#currentlesson').html('');
            $('#currentteacher').html('');
        });

        $("select.select-Lesson").change(function(){
            updateLesson = $(this).children("option:selected").val();

            if(updateLesson !== 'select' && updateDay !== 'select'){
                $.ajax({
                    url:'getlesson/'+updateGrade+'/'+updateLesson+'/'+updateDay,
                    method:'GET',
                    async: false,
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {

                        var obj = data.data;
                        var teacher = data.teacher;
                        if(obj != null){
                            $('#currentlesson').html(obj['description']);
                            $('#currentteacher').html(obj['name']);
                            lesson_id = obj['lesson_id'];
                            $('#fieldset2').prop('disabled',false);
                            $('#update-btn').prop('disabled',false);


                            for (let index = 0; index < teacher.length; index++) {
                                $('#lesson-teacher').append($('<option></option>').attr('value',teacher[index].user_id).text(teacher[index].name));
                            }

                        }

                    }
                });
            }
        });

        $("select.lesson-teacher").change(function(){
            selectedteacher = $(this).children("option:selected").val();

            $.ajax({
                url:'checkteacher/'+selectedteacher+'/'+updateDay+'/'+updateLesson,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var teacher = data.teacher;
                    if(teacher != null){
                        $('#teacher_warning').html('the teacher has '+teacher['description']+' lesson in Grade '+teacher['grade']);
                    }else{
                        $('#teacher_warning').html('');
                    }

                }
            });
        });

        $(document).on('submit', '#selectGradeForm', function(event){
            event.preventDefault();
            var grade = $("#select-grade").children("option:selected").val();

            $.ajax({
                url:"/checktimetable/"+grade,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {

                    var obj = data.data;
                    if(obj != null){
                        $('.warning').html('Timetable for grade '+grade+' created on '+obj['time']);
                    }else{
                        window.location.href = "timetable/create?grade="+grade;
                    }

                }
            });
        });

        $(document).on('submit', '#updateForm', function(event){
            event.preventDefault();
            newLesson = $('#new-lesson').children("option:selected").val();

            if(newLesson !== 'select' && selectedteacher !== 'select'){
                $.ajax({
                    url:"/timetable/"+lesson_id,
                    method:'POST',
                    async: false,
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert ('Edit successfully Made');
                        onclose();
                        $('#updateModal').modal('hide').data('bs.modal', null);

                        $('.modal-backdrop').hide();
                        loadTable(updateGrade);

                    }
                });
            }else{
                alert('select new lesson and teacher');
            }


        });

        function loadTable(grade){
            $.ajax({
                url:"/gettimetable/"+grade,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {

                    var table = data.data;
                    $('.timetable').attr('href', 'printtimetable/'+grade);
                    $('.gradeLabel').html(grade);
                    viewTable.clear().rows.add(table).draw();

                }
            });
        }

        function onclose(){
            $('.select-Lesson').val('select');
            $('.new-lesson').val('select');
            $('.lesson-teacher').val('select');
            $('#fieldset1').prop('disabled',true);
            $('#fieldset2').prop('disabled',true);
            $('#update-btn').prop('disabled',true);

        }

    </script>
@endsection
