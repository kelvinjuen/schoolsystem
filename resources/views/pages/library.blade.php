
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
                    <h1 class="col-12 h3 mb-2 text-gray-800 text-center">LIBRARY</h1>
                </div>
              </div>
              <div class="card-body">
                <div class="row mb-4">
                    <div class="col-9">
                        <button type="button" id="" class="btn btn-success btn-xs btn-user" data-toggle="modal" data-target=".add-modal" data-whatever="'+data+'">Add Books</button>
                        <button type="button" id="" class="btn btn-info btn-xs btn-user " data-toggle="modal" data-target=".return-modal" data-whatever="'+data+'">Return Books</button>
                    </div>
                    <div class="col-3">

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="library-table" width="100%" cellspacing="0">
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

    <!-- add modal -->
    <div class="modal fade add-modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"><span class="names">Add New Books</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addBooks" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" id="title" value="" placeholder="book-title">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="author" value="" placeholder="book-author">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="subject" value="" placeholder="book-subject">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="volume" value="" placeholder="book-volume">
                                </div>
                                <div class="col">
                                    <select class="form-control " id="grade" name="grade">
                                        <option value="" selected>select Grade</option>
                                        <option value="1">Grade 1</option>
                                        <option value="2">Grade 2</option>
                                        <option value="3">Grade 3</option>
                                        <option value="4">Grade 4</option>
                                        <option value="5">Grade 5</option>
                                        <option value="6">Grade 6</option>
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="0">General</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="copies" value="" placeholder="book-copies">
                                </div>
                                <input type="button" class="btn btn-success add-list mr-2" value="+" >
                                <input type="button" class="btn btn-danger remove" value="-" >

                            </div>
                            <div class="row text-center mt-3">
                                <h6 class="col-12">New books List</h6>
                            </div>
                            <input type="hidden" name="total" id="total" value="">
                            <table class="table table-sm mt-2">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Volume</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Number</th>
                                </tr>
                                </thead>
                                <tbody id="list-wrapper">
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                                {{csrf_field() }}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Book List</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of add model -->

    <!-- release modal -->
    <div class="modal fade release-modal" id="releaseModal" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="book-details"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="releaseForm" method="POST">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="user-type" class="col-3 col-form-label">Reader Level</label>
                                <div class="col">
                                    <select class="form-control user-type" id="user_type" name="user_type">
                                        <option value="" selected>Select User Level</option>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="user-details">

                            </div>
                            <div class="form-group row">
                                <label for="user-type" class="col-3 col-form-label">Number of Copies</label>
                                <div class="col">
                                    <input type="number" class="form-control" name="copies" id="copies" value="1" required/>
                                </div>
                            </div>
                            <div class="form-group row" id="date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="action" id="action" value="release"/>
                            <input type="hidden" class="form-control" name="book_id" id="book_id"/>
                            {{csrf_field() }}
                            <button type="button" class="btn btn-danger btn-user" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-user">Release</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of release model -->

    <!-- view modal -->
    <div class="modal fade view-modal" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="book-details"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col text-center">Total Books : <span class="total-books"></span></div>
                            <div class="col">Books Released : <span class="store-books"></span></div>
                        </div>
                        <div class="row mt-2">
                            <h5>Teachers</h5>
                            <table class="table table-bordered table-sm">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Teachers Names</th>
                                    <th scope="col">Copies</th>
                                    <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="teacherlist">

                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-2">
                            <h5>Students</h5>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">admission</th>
                                    <th scope="col">Student Names</th>
                                    <th scope="col">Copies</th>
                                    <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="studentlist">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of view model -->

    <!-- return modal -->
    <div class="modal fade return-modal" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="book-details"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="user-type" class="col-3 col-form-label">Reader Level</label>
                            <div class="col">
                                <select class="form-control return-type" id="return_type" name="return_type">
                                    <option value="" selected>Select User Level</option>
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="return-details"></div>
                        <div class="table-sm" id="table"></div>
                    </div>
                    <div class="modal-footer">
                        {{csrf_field() }}
                        <button type="button" class="btn btn-danger btn-user" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of return model -->


    <!-- Page level custom scripts -->
    <script >
        var x = 0;
        let viewTable;
        let listTable;
        let userType;
        let teacherIdArray = [];
        let teacherArray = [];
        let list = false;

        $(document).ready(function() {
            var wrapper = $("#list-wrapper");
            var add_button = $(".add-list");

            $(add_button).click(function(e){
                e.preventDefault();
                let title = $('#title').val();
                let author = $('#author').val();
                let subject = $('#subject').val();
                let volume = $('#volume').val();
                let grade = $('#grade').val();
                let copies = $('#copies').val();

                if(!!title && !!author && !!subject && !!grade && !!volume && !!copies){
                    x++;
                    $('input[id=title]').val('');
                    $('input[id=author]').val('');
                    $('input[id=subject]').val('');
                    $('input[id=volume]').val('');
                    $('input[id=grade]').val('');
                    $('input[id=copies]').val('');

                    $(wrapper).append('<tr  id="tr-wrap-'+x+'">'+
                    '<td>'+x+'</td><td>'+title+'</td><input type="hidden" name="title-'+x+'" id="title-'+x+'" value="'+title+'">'+
                    '<td>'+author+'</td><input type="hidden" name="author-'+x+'" id="author-'+x+'" value="'+author+'">'+
                    '<td>'+subject+'</td><input type="hidden" name="subject-'+x+'" id="subject-'+x+'" value="'+subject+'">'+
                    '<td>'+volume+'</td><input type="hidden" name="volume-'+x+'" id="volume-'+x+'" value="'+volume+'">'+
                    '<td>'+grade+'</td><input type="hidden" name="grade-'+x+'" id="grade-'+x+'" value="'+grade+'">'+
                    '<td>'+copies+'</td><input type="hidden" name="copies-'+x+'" id="copies-'+x+'" value="'+copies+'">'+
                    '</tr>');

                }else{
                    alert('Warning!!! : fill all the values');
                }


            });
            $(document).on("click",".remove", function(e){
                e.preventDefault();
                if(x > 0){
                    $("#tr-wrap-"+x+"").remove();
                    x--;
                }
            });

            viewTable = $('#library-table').DataTable({
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"/setlibrarytable",
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                    { title: "Title", "data": "title" },
                    { title: "Author", "data": "author" },
                    { title: "Grade", "data": "grade" },
                    { title: "subject", "data": "subject" },
                    { title: "Volume", "data": "volume" },
                    { title: "Books Out", "data": "books_out" },
                    { title: "Total Books", "data": "total_number" },
                    {   title: "Actions",
                        "data": "book_id",
                        "render": function(data, type, full, meta){
                            return '<button type="button" id="" class="btn btn-info btn-xs btn-user mr-2" data-toggle="modal" data-target=".view-modal" data-whatever="'+data+'">View Books</button><button type="button" id="" class="btn btn-success btn-xs btn-user" data-toggle="modal" data-target=".release-modal" data-whatever="'+data+'">Release Book/s</button>';
                        }
                    },

                ],
            });

            $.ajax({
                    url:"/fillselect",
                    method:'GET',
                    async: false,
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        var teacher = data.teacher;

                        if(teacher != null){
                            for (let index = 0; index < teacher.length; index++) {
                                teacherIdArray[index] = teacher[index].user_id;
                                teacherArray[index] = teacher[index].name;
                            }
                        }

                    }
                });
        });

        $(document).on('submit', '#addBooks', function(event){
            event.preventDefault();
            if(x > 0){
                $('#total').attr('value',x);
                $.ajax({
                    url:"{{route('library.store')}}",
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
                            //$('.password').html(obj['password']);
                        }else{
                            alert ("Successfully Saved");
                            viewTable.ajax.reload();
                            $("#list-wrapper").html('');
                            $('#addModal').modal('hide').data('bs.modal', null);
                            $('.modal-backdrop').hide();
                            x= 0;


                        }
                    }
                });
            }else{
                alert('Warning!!! : list is empty')
            }


        });

        $('.release-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            book_id = button.data('whatever'); // Extract info from data-* attributes

            $.ajax({
                url:"/getbookinfo/"+book_id,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.book;
                    if(obj != null){
                        $('.book-details').html('Book Title : ' + obj['title'] +' Grade '+obj['grade']+' , '+obj['volume']);
                        $('#book_id').attr('value',obj['book_id']);
                    }else{}


                }
            });
        });

        $('.view-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            book_id = button.data('whatever');

            $.ajax({
                url:"/getbookinfo/"+book_id,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    let obj = data.book;
                    let teacherlist = data.teacher_list;
                    let studentlist = data.student_list;

                    for (let index = 0; index < teacherlist.length; index++) {
                        $('#teacherlist').append('<tr><td>'+(index + 1 )+'</td>'+
                        '<td>'+teacherlist[index].name+'</td>'+
                        '<td>'+teacherlist[index].copies+'</td>'+
                        '<td>'+teacherlist[index].created_at+'</td></tr>');
                    }
                    for (let index = 0; index < studentlist.length; index++) {
                        $('#studentlist').append('<tr><td>'+(index + 1 )+'</td>'+
                        '<td>'+studentlist[index].admission_no+'</td>'+
                        '<td>'+studentlist[index].name+'</td>'+
                        '<td>'+studentlist[index].copies+'</td>'+
                        '<td>'+studentlist[index].created_at+'</td></tr>');
                    }

                    if(obj != null){
                        $('.book-details').html('Book Title : ' + obj['title'] +' Grade '+obj['grade']+' , '+obj['volume']);
                        $('#book_id').attr('value',obj['book_id']);
                        $('.total-books').html(obj['total_number']);
                        $('.store-books').html(obj['books_out']);
                    }else{}


                }
            });
        });

        $("select.user-type").change(function(){
            var type = $(this).children("option:selected").val();

            if(type === 'teacher'){
                userType = 'teacher';
                $('#user-details').html('<label for="user-type" class="col-3 col-form-label">Select Teacher :</label>'+
                '<div class="col"><select class="form-control" id="user" name="user"><option value="" selected>Select Teacher</option>'+
                '</select></div>');
                for (let index = 0; index < teacherArray.length; index++) {
                    $('#user').append($('<option></option>').attr('value',teacherIdArray[index]).text(teacherArray[index]));
                }
                $('#date').html('');
            }else if(type === 'student'){
                userType = 'student';
                $('#user-details').html('<label for="user-type" class="col-3 col-form-label">Student Admission :</label>'+
                '<div class="col"> <input type="text" class="form-control" name="user" id="user" placeholder="Admission Number" required/></div>');

                $('#date').html('<label for="user-type" class="col-3 col-form-label">Return Date :</label><div class="col">'+
                '<input type="text"  id="picker" name="return" class="form-control" placeholder="Return Date" required></div>');
            }else{
                userType = null;
            }
            $('#picker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                showDropdowns : true ,
                opens : 'right',
                drops : 'down',
            });
        });

        $("select.return-type").change(function(){
            var type = $(this).children("option:selected").val();

            if(type === 'teacher'){
                $('#return-details').html('<label for="return_id" class="col-3 col-form-label">Select Teacher :</label>'+
                '<div class="col"><select class="form-control return-id" id="return-id" name="return-id"><option value="" selected>Select Teacher</option>'+
                '</select></div>');

                for (let index = 0; index < teacherArray.length; index++) {
                    $('#return-id').append($('<option></option>').attr('value',teacherIdArray[index]).text(teacherArray[index]));
                }
                $('#table').html('');
            }else if(type === 'student'){
                $('#return-details').html('<label for="return-type" class="col-3 col-form-label">Student Admission :</label>'+
                '<div class="col"> <input type="text" class="form-control" id="admission" name="admission" placeholder="Admission Number" required/></div>');
                $('#table').html('');
            }
        });

        $(document).on("change","#return-id",function(){
            $('#table').html('<table class="table" id="listtable"></table>');
            var id = $(this).children("option:selected").val();
            getBorrowerList('teacher',id);

        });

        $(document).on('keyup','#admission', function(event){
            event.preventDefault();
            $('#table').html('<table class="table" id="listtable"></table>');
            let adm  = $('#admission').val();
            if(adm.length === 3){
                getBorrowerList('student',adm);
            }
        });

        $(document).on('submit', '#releaseForm', function(event){
            event.preventDefault();
            let id = $('#user').val();
            $.ajax({
                url:"savelibrary/"+id,
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    if(obj != null){
                        //$('.password').html(obj['password']);
                    }else{
                        alert ("Successfully Saved");
                        viewTable.ajax.reload();
                        $('#releaseModal').modal('hide').data('bs.modal', null);
                        $('.modal-backdrop').hide();
                    }
                }
            });
        });

        $(document).on('click','#return-button', function(event){
            let copies = $('#text-copies').val();
            let initialcopies = $('#borrowed-copies').val();
            let id = $('#return-button').val();
            let clearStatus = 0;






            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(copies > 0 && copies <= initialcopies){
                if(initialcopies === copies){
                    clearStatus = 1;
                }
                $.ajax({
                url:"updatereturnedbooks/"+id+"/"+copies+"/"+clearStatus,
                method:'POST',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    if(obj != null){
                        //$('.password').html(obj['password']);
                    }else{
                        alert ("Successfully updated");
                        listTable.ajax.reload();
                    }
                }
            });
            }else{
                alert('number of copies returned  error');
            }

        });

        function getBorrowerList(borrowertype , borrowerid){
            listTable = $('#listtable').DataTable({
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"fillborrowlist/"+borrowertype+"/"+borrowerid,
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                    { title: "Title", "data": "title" },
                    { title: "Taken Copies", "data": "copies" },
                    { title: "Returned Copies", "data": "returned" },
                    { title: "date", "data": "created_at" },
                    {   title: "Return",
                        "data": "remain",
                        "render": function(data, type, full, meta){
                            return '<input type="hidden" id="borrowed-copies" value="'+data+'"><input type="number" id="text-copies" name="copies" size="5" class="form-control" value="'+data+'">';
                        }
                    },
                    {   title: "Actions",
                        "data": "library_id",
                        "render": function(data, type, full, meta){
                            return '<button type="button" id="return-button" name="library_id" class="btn btn-success btn-xs btn-user btn-block" value="'+data+'">Return</button>';
                        }
                    },

                ],
            });

        }
    </script>


@endsection
