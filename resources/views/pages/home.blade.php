
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-2">
                <h5 class="h4 mb-0 text-gray-800">Dashboard</h5>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#registerModal" data-whatever="@mdo">Class Register</button>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Absent -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Absent students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="absent"></span> student absent</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush" id="absent-list">
                        </ul>
                    </div>
                </div>

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grade {{ Auth::user()->class }} Subject Performance</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Openner</a>
                            <a class="dropdown-item" href="#">Mid Term</a>
                            <a class="dropdown-item" href="#">End Term</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">OverAll Exam</a>
                            </div>
                        </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="performance-chart">
                            <canvas id="exam"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- end Content Row -->


        <!-- Content Row -->
        <div class="row">

            <!-- Lesson -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Todays Lessons</h6>
                        <div class="row no-gutters align-items-center mt-2">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Lesson number</div>
                                </div>
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Lesson</div>
                                </div>
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Grade</div>
                                </div>
                            </div>
                    </div>
                    <ul class="list-group list-group-flush" id="lesson-list">
                    </ul>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grade {{ Auth::user()->class }} OverAll Performance</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Openner</a>
                        <a class="dropdown-item" href="#">Mid Term</a>
                        <a class="dropdown-item" href="#">End Term</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">OverAll Exam</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                    <div class="card-body">
                        <div class="performance-chart">
                        <canvas id="exam-per"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Content Row -->

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
    <!-- search modal -->
    <div class="modal fade register-modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Grade {{ Auth::user()->class }} Register</h5>
                        <h5 class="modal-title ml-auto" id="exampleModalLabel">{{ date("d/m/y")}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table text-center" id="student-table" width="100%" cellspacing="0"></table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form id="register">
                            <div id="register_input">
                                    <input  type="hidden" id="total" name="total" value="">
                            </div>
                            {{csrf_field() }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end of search modal -->
    <!-- End of Content Wrapper -->
    <script>
        let total;
        $(document).on('submit', '#form-search', function(event){
            event.preventDefault();
            var success = false;
            var niims = $('#search-text').val();

            $.ajax({
                url:"/student/"+niims,
                method:'POST',
                async: false,
                data:new FormData(this),
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
                        var subjects = ["math","english","comp","swahili","insha","science","social","cre"];
                        var marks = [table['math'],table['english'],table['composition'],table['swahili'],table['insha'],table['science'],table['social'],table['cre']];

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

        $(document).ready(function() {
            $.ajax({
                url:"/lesson",
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.lessons;
                    var attendance = data.attendance;
                    $('.absent').html(attendance.length);
                    for (let i = 0; i < obj.length; i++) {
                        $('#lesson-list').append('<li class="list-group-item"><div class="row">'+
                        '<div class = "col">'+obj[i].lesson_time+'</div>'+
                        '<div class = "col">'+obj[i].description+'</div>'+
                        '<div class = "col">'+obj[i].grade+'</div>'+
                        '</div></li>');
                    }

                    for (let i = 0; i < attendance.length; i++) {
                        $('#absent-list').append('<li class="list-group-item">'+
                        attendance[i].name +
                        '</div></li>');
                    }

                }
            });

            $.ajax({
                url:"/performance/1",
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var table = data.exam;
                    var subjects = ["math","eng","comp","swa","insha","science","social","cre"];
                    var marks = [table['math'],table['english'],table['composition'],table['swahili'],table['insha'],table['science'],table['social'],table['cre']];

                    // Area Chart Example
                    var ctx = document.getElementById("exam");
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
                            maxTicksLimit: 10
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


                }
            });

            $.ajax({
                url:"/examchart",
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var table = data.terms;
                    var subjects = [];
                    var marks = [];
                    for (let index = 1; index <= data.total; index++) {

                        subjects[index] = 'Term'+index;
                        marks[index] = table[index];

                    }



                    // Area Chart Example
                    var ctx = document.getElementById("exam-per");
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
                            maxTicksLimit: 10
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


                }
            });
        });

        $('.register-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            user_id = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);
            total =1;

            $('#student-table').DataTable({
                "paging": false,
                "filter": false,
                "info":false,
                "ordering":false,
                "ajax":{
                    "url":"setstudenttable/{{Auth::user()->class}}",
                    "type":"GET"
                },
                columns: [
                    {   title: "Photo",
                        "data": "photo",
                        "render": function(data, type, full, meta){
                            return '<img class="img-fluid mx-auto" width="70vh"  src="/storage/student_images/'+data+'" alt="photo">';
                        }
                    },
                    { title: "Names", "data": "name" },
                    { title: "Admission No", "data": "admission_no" },
                    { title: "Attendance",
                        "data": "student_id",
                        "render": function(data, type, full, meta){
                            return '<input class="form-check-input text-center check_'+data+'" type="checkbox" id="registerCheck" value="'+data+'" checked>';
                        }
                    },
                ],
            });

        });

        $('.register-modal').on('hidden.bs.modal', function (event) {
            $('#student-table').dataTable().fnDestroy();
        });

        $(document).on('change','#registerCheck', function(event){
            event.preventDefault();
            let student_id = $(this).attr("value");
            if(!this.checked){
                $('#register_input').append('<input  type="hidden" name="student-'+total+'" value="'+student_id+'">');
                total++;

            }
        });

        $(document).on('submit', '#register', function(event){
            event.preventDefault();
            $('#total').attr('value', total);

            $.ajax({
                url:"/saveregister",
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {

                }
            });
        });

    </script>
@endsection
