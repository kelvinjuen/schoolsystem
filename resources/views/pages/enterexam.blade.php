
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper -->
    @include('inc.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        @include('inc.topbar')
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-2">
              <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add Grade {{$_GET['grade']}} Term {{$_GET['term']}} {{$_GET['type']}} Results</h1>
                      </div>
                      <form class="addResult" id="addResult" method="POST" enctype="multipart/form-data">
                        <table class="table" id="formTable">
                            <thead class="thead-dark">
                                <th>Admission No</th>
                                <th>Name</th>
                                <th>Math</th>
                                <th>English</th>
                                <th>Comp</th>
                                <th>Swahili</th>
                                <th>Insha</th>
                                <th>Science</th>
                                <th>Social</th>
                                <th>C.R.E</th>
                            </thead>
                            <tbody id="resultWrapper">

                            </tbody>

                        </table>
                        <input type="hidden" name="term" id="term" value="{{$_GET['term']}}">
                        <input type="hidden" name="exam-type" id="exam-type" value="{{$_GET['exam']}}">
                        <input type="hidden" name="grade" id="grade" value="{{$_GET['grade']}}">
                        <button type="submit" id="submit_result" class="btn btn-success btn-user btn-block">Add Grade {{$_GET['grade']}} Results</button>
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
        $(document).ready(function(event){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var grade = url.searchParams.get('grade');
            $.ajax({
                url:"/examtable/"+grade,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.students;


                    for (let i = 0; i < obj.length; i++) {
                        var username = obj[i].first_name+' '+obj[i].second_name+' '+obj[i].surname;

                        if(!(i + 1 < obj.length)) {
                            $('#resultWrapper').append('<tr>'+
                            '<input type="hidden" name="admission-'+i+'" id="admission-'+i+'" value="'+obj[i].id+'">'+
                            '<td>'+obj[i].id+'</td>'+
                            '<td>'+username+'</td>'+
                            '<td><input type="text" name="math-'+i+'" id="math-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="eng-'+i+'" id="eng-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="comp-'+i+'" id="comp-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="swa-'+i+'" id="swa-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="ins-'+i+'" id="ins-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="sce-'+i+'" id="sce-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="ss-'+i+'" id="ss-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="cre-'+i+'" id="cre-'+i+'" size="1" class="form-control" required></td>'+
                            '<input type="hidden" name="number" id="number" value="'+obj.length+'"></td>'+
                            '</tr>');
                        }else{
                            $('#resultWrapper').append('<tr>'+
                            '<input type="hidden" name="admission-'+i+'" id="admission-'+i+'" value="'+obj[i].id+'"></td>'+
                            '<td>'+obj[i].id+'</td>'+
                            '<td>'+username+'</td>'+
                            '<td><input type="text" name="math-'+i+'" id="math-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="eng-'+i+'" id="eng-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="comp-'+i+'" id="comp-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="swa-'+i+'" id="swa-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="ins-'+i+'" id="ins-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="sce-'+i+'" id="sce-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="ss-'+i+'" id="ss-'+i+'" size="1" class="form-control" required></td>'+
                            '<td><input type="text" name="cre-'+i+'" id="cre-'+i+'" size="1" class="form-control" required></td>'+
                            '</tr>');
                        }
                    }



                }
            });
        });

        $(document).on('submit', '#addResult', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"{{route('exam.store')}}",
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    if(obj != null){


                    }else{

                        var obj = data.lastId;
                        alert ("Successfully Saved");
                        window.location.href = "/exam";
                    }


                }
            });
        });
    </script>
@endsection
