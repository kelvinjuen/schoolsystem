
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
              <div class="card-header py-3">
                <div class="row">
                    <h1 class="col-8 h3 mb-2 text-gray-800">STAFF INFORMATION</h1>
                    <a href="/teacher/create" class="col-4 btn btn-success btn-user btn-block">ADD NEW STAFF</a>
                </div>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="teacher-table" width="100%" cellspacing="0">
                    </table>
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

                                <h6 class="h6 mb-0 text-gray-400">Staff Info :</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <strong class="font-weight-bold col-md-5">ID Number </strong><span class="id"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Phone Number</strong><span class="phone"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Email</strong><span class="email"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Date of Birth</strong><span class="dob"></span><br/>
                                    </div>
                                    <div class="col-6">
                                        <strong class="font-weight-bold col-md-5">Tsc No</strong><span class="tsc"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Lesson Combo</strong><span class="lesson"></span><br/>
                                        <strong class="font-weight-bold col-md-5">Grade Assigned</strong><span class="class"></span><br/>
                                    </div>
                                </div>
                                <hr class="sidebar-divider">
                                <h6 class="h6 mb-0 text-gray-400">education Background :</h6>
                                <div class="row" >
                                    <div class="col-4">
                                        <strong class="font-weight-bold ">Certificate</strong>
                                    </div>
                                    <div class="col-4">
                                        <strong class="font-weight-bold ">Certificate Type</strong>
                                    </div>
                                    <div class="col-4">
                                        <strong class="font-weight-bol col-md-6">Institution</strong>
                                    </div>
                                </div>
                                <div class="row" id= 'education'>

                                </div>
                                <hr class="sidebar-divider">
                                <h6 class="h6 mb-0 text-gray-400">Experience :</h6>
                                <div class="row" >
                                    <div class="col-4">
                                        <strong class="font-weight-bold ">Institution</strong>
                                    </div>
                                    <div class="col-4">
                                        <strong class="font-weight-bold ">Position</strong>
                                    </div>
                                    <div class="col-4">
                                        <strong class="font-weight-bol col-md-6">Years worked</strong>
                                    </div>
                                </div>
                                <div class="row" id= 'experience'>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <a id="editref" href="" class="btn btn-warning">Edit Profile</a>
                        <button type="button" class="btn btn-primary">Email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of view model -->


    <!-- Page level custom scripts -->
    <script >
        $(document).ready(function() {
            //$.noConflict();
            $('#teacher-table').DataTable({
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"/teacher/table",
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                    {   title: "Photo",
                        "data": "photo",
                        "render": function(data, type, full, meta){
                            return '<img class="img-fluid mx-auto" width="70vh"  src="/storage/teacher_images/'+data+'" alt="photo">';
                        }
                    },
                    { title: "Names", "data": "name" },
                    { title: "Grade", "data": "class" },
                    { title: "Tsc No", "data": "tsc_no" },
                    { title: "Lessons", "data": "lesson_combo" },
                    { title: "Phone No", "data": "phone_no" },
                    { title: "Role", "data": "user_type" },
                    {   title: "Action",
                        "data": "user_id",
                        "render": function(data, type, full, meta){
                            return '<button type="button" id="" class="btn btn-success btn-xs btn-user" data-toggle="modal" data-target=".search-modal" data-whatever="'+data+'">View</button> <a href="/teacher/'+data+'/edit?id='+data+'" class="btn btn-info btn-xs">Edit</a>';
                        }
                    },
                ],
            });
        });

        $('.search-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            user_id = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);

            $.ajax({
                url:"/teacher/"+user_id,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.user;
                    $('#education').html('');
                    $('#experience').html('');
                    if(obj != null){
                        $('#profile-image').attr('src','/storage/teacher_images/'+obj['photo']);
                        $('.names').html(obj['first_name']+" "+obj['second_name']+" "+obj['surname']);
                        $('.id').html(obj['id_no']);
                        $('.phone').html(obj['phone_no']);
                        $('.email').html(obj['email']);
                        $('.lesson').html(obj['lesson_combo']);
                        $('.tsc').html(obj['tsc_no']);
                        $('.class').html(obj['class']);
                        $('.dob').html(obj['dob']);
                        $('#editref').attr('href','/teacher/'+user_id+'/edit');
                        var cert = obj['cert_type'].split(",");
                        var title = obj['cert_title'].split(",");
                        var insitution = obj['institution'].split(",");

                        var company = obj['company'].split(",");
                        var position = obj['position'].split(",");
                        var years = obj['years'].split(",");

                        for (let index = 0; index < cert.length; index++) {
                            $('#education').append(' <div class="col-4">'+title[index]+'</div>'+
                            '<div class="col-4">'+cert[index]+'</div>'+
                            '<div class="col-4">'+insitution[index]+'</div>');
                        }

                        for (let index = 0; index < company.length; index++) {
                            $('#experience').append(' <div class="col-4">'+company[index]+'</div>'+
                            '<div class="col-4">'+position[index]+'</div>'+
                            '<div class="col-4">'+years[index]+'</div>');
                        }


                    }else{

                        $('#profile-image').attr('src','/storage/student_images/noimage.png');
                        $('.names').html();
                        $('.id').html();
                        $('.phone').html();
                        $('.email').html();
                        $('.lesson').html();
                        $('.tsc').html();
                        $('.class').html();




                    }


                }
            });
        });
    </script>


@endsection
