
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    @include('inc.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
        @include('inc.topbar')
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->



            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-2">
                <div class="row">
                    <h1 class="col-7 h3 mb-2 text-gray-800">GRADE <span class="gradeLabel">1</span> Student Table</h1>
                    <div class="col-5">
                            <form>
                                <div class="form-group row">
                                    <label for="grade-select" class="col-sm-4 col-form-label">Select Grade</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select grade-select" id="grade-select">
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
                            </form>
                        </div>
                </div>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="teacher-table" width="100%" cellspacing="0"></table>
                </div>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->

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

    <!-- view modal -->
    <div class="modal fade search-modal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="names"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <img class="img-fluid"  id="profile-image"   width="80%"  src="/storage/student_images/noimage.png" alt="photo">
                            </div>
                            <div class="col-9">

                                <h6 class="h6 mb-0 text-gray-400">Student Info :</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <strong class="font-weight-bold col-md-5">Date of Birth </strong><span class="dob"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Class</strong><span class="class"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Niims</strong><span class="niims"></span><br/>
                                    </div>
                                    <div class="col-6">
                                        <strong class="font-weight-bold col-md-5">Admin No</strong><span class="admission"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Previous School</strong><span class="previous"></span><br/>
                                    </div>
                                </div>
                                <hr class="sidebar-divider">
                                <div class="row">
                                    <div class="col-6">
                                        <strong class="font-weight-bold col-md-6">Fathers Names</strong><span class="father-name"></span><br/>
                                        <strong class="font-weight-bold col-md-6">Fathers Contacts</strong><span class="father-contact"></span><br/>
                                    </div>
                                    <div class="col-6">
                                        <strong class="font-weight-bold col-md-6">Mothers Names</strong><span class="mother-name"></span><br/>
                                        <strong class="font-weight-bold col-md-6">Mothers Contacts</strong><span class="mother-contact"></span><br/>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Divider -->
                        <hr class="sidebar-divider">
                        <div class="d-sm-flex align-items-center justify-content-between mb-auto mt-3">
                            <h4 class="h5 mb-0 text-gray-800">Performance Info :</h4>
                        </div>
                        <div class="row">
                            <div class="card shadow mb-4 col-12">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Exam overview</h6>
                                    <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                    <canvas id="myExamChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-auto mt-3">
                            <h4 class="h5 mb-0 text-gray-800">Fees Info :</h4>
                        </div>
                        <div  class="row">
                            <div class="row my-2"><strong class="font-weight-bold col-md-5">balance</strong><span class="national"></span></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning">Edit student Details</button>
                        <button type="button" class="btn btn-primary">Send parent message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Page level custom scripts -->
    <script >
        var viewTable;
        $(document).ready(function() {
            //$.noConflict();
            viewTable = $('#teacher-table').DataTable({
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"setstudenttable/{{Auth::user()->class}}",
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                    {   title: "Photo",
                        "data": "photo",
                        "render": function(data, type, full, meta){
                            return '<img class="img-fluid mx-auto" width="70vh"  src="/storage/student_images/'+data+'" alt="photo">';
                        }
                    },
                    { title: "Names", "data": "name" },
                    { title: "Admission No", "data": "admission_no" },
                    { title: "Niims", "data": "niims" },
                    { title: "Special Needs", "data": "special_needs" },
                    { title: "Attendance", "data": "attendance" },
                    {   title: "View",
                        "data": "admission_no",
                        "render": function(data, type, full, meta){
                            return '<button type="button" id="" class="btn btn-success btn-xs btn-user" data-toggle="modal" data-target=".search-modal" data-whatever="'+data+'">View</button>';
                        }
                    },
                    {   title: "Edit",
                        "data": "student_id",
                        "render": function(data, type, full, meta){
                            return '<a href="/student/'+data+'/edit?id='+data+'" class="btn btn-info btn-xs">Edit</a>';
                        }
                    },
                ],
            });
        });


        $("select.grade-select").change(function(){
            var selectedGrade = $(this).children("option:selected").val();

            $.ajax({
                url:"/setstudenttable/"+selectedGrade,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {

                    var table = data.data;
                    $('.gradeLabel').html(selectedGrade);
                    viewTable.clear().rows.add(table).draw();

                }
            });
        });

        $('.search-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            admission_no = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);

            $.ajax({
                url:"/student/"+admission_no,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.student;
                    var table =data.exam;
                    if(obj != null){
                        $('#profile-image').attr('src','/storage/student_images/'+obj['photo']);
                        $('.names').html(obj['first_name']+" "+obj['second_name']+" "+obj['surname']);
                        $('.dob').html(obj['dob']);
                        $('.class').html(obj['grade']);
                        $('.niims').html(obj['niims']);
                        $('.admission').html(obj['admission_no']);
                        $('.previous').html(obj['previous_school']);
                        $('.father-name').html(obj['father_names']);
                        $('.father-contact').html(obj['father_contact']);
                        $('.mother-name').html(obj['mother_names']);
                        $('.mother-contact').html(obj['mother_contact']);
                        var subjects = [];
                        var marks = [];
                        for (let index = 1; index <= data.total; index++) {

                            subjects[index] = 'Term'+index;
                            marks[index] = table[index];

                        }

                        // Area Chart Example
                        var ctx = document.getElementById("myExamChart");
                        var data ={
                            labels: subjects,
                            datasets:[
                                {
                                    label: "Subjects",
                                    data: marks,
                                    backgroundColor:"blue",
                                    borderColor:"lightblue",
                                    fill: false,
                                    lineTension:0,
                                    radius:5
                                }
                            ]
                        };
                        var options = {
                            responsive:true,
                            maintainAspectRatio: false,
                            layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                            },
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false,
                                drawBorder: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                maxTicksLimit: 5,
                                padding: 10,

                                },
                                gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }

                        }

                        var chart = new Chart(ctx, {
                            type:"line",
                            data:data,
                            options: options
                        });


                    }else{

                        $('#profile-image').attr('src','/storage/student_images/noimage.png');
                        $('.names').html();
                        $('.dob').html();
                        $('.class').html();
                        $('.niims').html();
                        $('.admin-no').html();
                        $('.year-joined').html();
                        $('.previous').html();
                        $('.father-name').html();
                        $('.father-contact').html();
                        $('.mother-name').html();
                        $('.mother-contact').html();
                    }


                }
            });
        });
    </script>


@endsection
