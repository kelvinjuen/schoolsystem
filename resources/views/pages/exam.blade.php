
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    @include('inc.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        @include('inc.topbar')
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="card o-hidden border-0 shadow-lg my-1">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="p-3">
                        <div class="row text-center">
                            <h1 class="h4 text-gray-900 mb-4">Grade
                                <span class="gradeLabel">
                                @isset($exam->grade)
                                    {{$exam->grade}}
                                @else
                                {{ Auth::user()->class }}
                                @endisset
                                </span>
                                (<span class="examTerm" >
                                    @if (isset($exam->term))
                                        term : {{$exam->term}} , exam : {{$exam->exam_type}}
                                    @else
                                        No exam entered for this grade.
                                    @endif
                                </span> )
                        </h1>
                        </div>
                        <div class="row py-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#examTableModal" data-whatever="@mdo">Select Exam Table</button>

                            </div>
                            <div class="col-6  text-right">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Enter Exam</button>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal" data-whatever="@mdo">Edit Results</button>
                                <a href="getexamreport/1/1/1" target="_blank" class="btn btn-info report">Generate Exam Report</a>
                            </div>
                        </div>
                        <table class="table table-bordered" id="exam-table" width="100%" cellspacing="0">
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
    <!-- Exam entry  modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Result For :</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="choose-class" id="classForm">
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
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Term</label>
                                <div class="col-sm-8">
                                    <select class="custom-select term-select" id="term-select">
                                        <option selected>Select Term</option>
                                        <option value="1">Term 1</option>
                                        <option value="2">Term 2</option>
                                        <option value="3">Term 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Exam</label>
                                <div class="col-sm-8">
                                    <select class="custom-select exam-select" id="exam-select">
                                        <option selected>Select Exam</option>
                                        <option value="1">Opener</option>
                                        <option value="2">Mid-term</option>
                                        <option value="3">End-term</option>
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

    <!-- end of Exam entry  modal -->

    <!-- Exam Edit  modal -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Result For :</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="choose-class" id="editForm">
                    <div class="modal-body">
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Grade</label>
                                <div class="col-sm-8">
                                    <select class="custom-select select-grade" id="select-grade2">
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
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Term</label>
                                <div class="col-sm-8">
                                    <select class="custom-select term-select" id="term-select2">
                                        <option selected>Select Term</option>
                                        <option value="1">Term 1</option>
                                        <option value="2">Term 2</option>
                                        <option value="3">Term 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Exam</label>
                                <div class="col-sm-8">
                                    <select class="custom-select exam-select" id="exam-select2">
                                        <option selected>Select Exam</option>
                                        <option value="1">Opener</option>
                                        <option value="2">Mid-term</option>
                                        <option value="3">End-term</option>
                                    </select>
                                </div>
                            </div>
                            <strong class="text-center"><span class="warning text-danger"></span></strong>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end of Exam Edits  modal -->

    <!-- select exam  modal -->
    <div class="modal fade" id="examTableModal" tabindex="-1" role="dialog" aria-labelledby="examTableModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Display Result For</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="choose-class" id="resultForm">
                    <div class="modal-body">
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Grade</label>
                                <div class="col-sm-8">
                                    <select class="custom-select select-grade" id="select-grade1">
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
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Term</label>
                                <div class="col-sm-8">
                                    <select class="custom-select term-select" id="term-select1">
                                        <option selected>Select Term</option>
                                        <option value="1">Term 1</option>
                                        <option value="2">Term 2</option>
                                        <option value="3">Term 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grade-select" class="col-sm-4 col-form-label">Select Exam</label>
                                <div class="col-sm-8">
                                    <select class="custom-select exam-select" id="exam-select1">
                                        <option selected>Select Exam</option>
                                        <option value="1">Opener</option>
                                        <option value="2">Mid-term</option>
                                        <option value="3">End-term</option>
                                    </select>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">show Results</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end of select exam  modal -->

    <script>
        var viewTable;
        $(document).ready(function() {
            //$.noConflict();
           viewTable = $('#exam-table').DataTable({
               "bPaginate": false,
               "bFilter": false,
               "bInfo":false,
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"/settable",
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                { title: "Admin No", "data": "Admission" },
                { title: "Name", "data": "name" },
                { title: "Math", "data": "math" },
                { title: "English", "data": "english" },
                { title: "Comp", "data": "composition" },
                { title: "Swahili", "data": "swahili" },
                { title: "Insha", "data": "insha" },
                { title: "Science", "data": "science" },
                { title: "Social", "data": "social" },
                { title: "Cre", "data": "cre" },
                { title: "Total", "data": "total" },
                { title: "Report",
                        "data": {exam_id :"exam_id",position : "position"},
                        "render": function(data, type, full, meta){
                            return '<a href="getexam/'+data.exam_id+'/'+data.position+'" target="_blank" class="btn btn-info btn-xs btn-user btn-block">Gen Report</a>';
                        }
                },
                ],

            });
        });

        $(document).on('submit', '#classForm', function(event){
            event.preventDefault();
            var grade = $("#select-grade").children("option:selected").val();
            var term = $("#term-select").children("option:selected").val();
            var type = $("#exam-select").children("option:selected").val();
            var type1 = $("#exam-select").children("option:selected").text();

            $.ajax({
                url:"/checkexam/"+grade+"/term/"+term+"/exam/"+type,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {

                    var obj = data.data;
                    if(obj != null){
                        $('.warning').html('Exam already entered on '+obj['time']);
                    }else{

                        window.location.href = "exam/create?grade="+grade+"&term="+term+"&exam="+type+"&type="+type1;
                    }

                }
            });
        });

        $(document).on('submit', '#editForm', function(event){
            event.preventDefault();
            var grade = $("#select-grade2").children("option:selected").val();
            var term = $("#term-select2").children("option:selected").val();
            var type = $("#exam-select2").children("option:selected").val();
            var type1 = $("#exam-select2").children("option:selected").text();

            $.ajax({
                url:"/checkexam/"+grade+"/term/"+term+"/exam/"+type,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {

                    var obj = data.data;
                    if(obj != null){
                        window.location.href = "exam/"+grade+"/edit?grade="+grade+"&term="+term+"&exam="+type+"&type="+type1;
                    }else{
                        $('.warning').html('Exam selected have not being captured ');

                    }

                }
            });
        });

        $(document).on('submit', '#resultForm', function(event){
            event.preventDefault();
            var grade = $("#select-grade1").children("option:selected").val();
            var term = $("#term-select1").children("option:selected").val();
            var type = $("#exam-select1").children("option:selected").val();
            var type1 = $("#exam-select1").children("option:selected").text();

            $.ajax({
                url:"/results/"+grade+"/term/"+term+"/exam/"+type,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {

                    var table = data.data;
                    $('.report').attr('href', 'getexamreport/'+grade+'/'+term+'/'+type);
                    viewTable.clear().rows.add(table).draw();
                    $('.gradeLabel').html(grade);
                    $('.examTerm').html('Term :'+term+' Exam :'+type1);
                    $('#examTableModal').modal('hide').data('bs.modal', null);
                    $('.modal-backdrop').hide();

                }
            });




        });
    </script>
@endsection
