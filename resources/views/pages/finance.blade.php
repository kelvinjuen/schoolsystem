
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
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                    <div class="row">
                        <h1 class="col-8 h3 mb-2 text-gray-800">Finance Requests</h1>
                        <button type="button" class="col-4 btn btn-success btn-user btn-block" data-toggle="modal" data-target="#requestModal" data-whatever="@mdo">Make New request</button>
                    </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="account-table" width="100%" cellspacing="0">

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


    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Request Finance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="requestForm" id="requestForm" method="POST">
            <div class="modal-body">

                <div class="form-group row">
                    <div class="col-4">
                        <label for="recipient-name" class="col-form-label">Amount:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label for="recipient-name" class="col-form-label">Department:</label>
                    </div>
                    <div class="col-8">
                        <select class="form-control" id="department" name="department">
                            <option>Academic</option>
                            <option>Kitchen</option>
                            <option>Adminstration</option>
                            <option>Transport</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label for="message-text" class="col-form-label">Description:</label>
                    </div>
                    <div class="col-8">
                        <textarea class="form-control" id="description-text" name="description-text" required></textarea>
                    </div>

                </div>
                {{csrf_field() }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Request</button>

            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <img class="img-fluid rounded"  id="profile-image"   width="40%"  src="/storage/student_images/noimage.png" alt="photo">
                    <h5 class="modal-title" id="requestModalLabel"><span class="modal-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="statusForm" id="statusForm" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div id="status-warning" class="col-12 alert alert-dark text-center" role="alert">
                                    <strong class="font-weight-bold">Request Status : <span class="status"></span></strong><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <strong class="font-weight-bold col-5">Requested Amount: </strong><br/>
                                <strong class="font-weight-bold col-5">Request Date: </strong><br/>
                                <strong class="font-weight-bold col-5">Department:</strong><br/>
                                <strong class="font-weight-bold col-5">Requested for:</strong><br/>
                            </div>
                            <div class="col-6">

                                <span class="amount-request"></span><br/>
                                <span class="date"></span><br/>
                                <span class="department"></span><br/>
                                <span class="description"></span><br/>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row mt-3">
                            <div class="col-6 text-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input approve" type="radio" name="status" id="status" value="approved">
                                    <label class="form-check-label" for="inlineRadio1">Approve</label>
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input decline" type="radio" name="status" id="status" value="declined">
                                    <label class="form-check-label" for="inlineRadio2">Decline</label>
                                </div>
                            </div>
                        </div>
                        <strong class="text-center"><span class="warning text-danger "></span></strong>
                        <input type="hidden" name="_method" id="_method" value="PUT">
                        {{csrf_field() }}
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>

                    </div>
                </form>
                </div>
            </div>
        </div>


    <!-- Page level custom scripts -->
    <script >
        var viewTable;
        var request_id;
        $(document).ready(function() {
            //$.noConflict();
            viewTable = $('#account-table').DataTable({
                "bFilter":false,
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"/setfinancetable",
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                    { title: "Date Requested", "data": "created_at" },
                    { title: "Amount", "data": "amount" },
                    { title: "Requested By", "data": "names" },
                    { title: "Description", "data": "description" },
                    { title: "Status", "data": "status" },
                    { title: "Department", "data": "department" },
                    {   title: "Action",
                        "data": "transaction_id",
                        "render": function(data, type, full, meta){
                            return '<button type="button" id="" class="btn btn-success btn-xs btn-user" data-toggle="modal" data-target="#viewModal" data-whatever="'+data+'">View request</button>';
                        }
                    },
                ],
            });
        });

        $(document).on('submit', '#requestForm', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"{{route('finance.store')}}",
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

                        alert (obj['amount']);
                    }else{

                        var obj = data.lastId;

                        alert ('Request Made successfully');
                        $('#account-table').DataTable().ajax.reload();
                        $('#requestModal').modal('hide').data('bs.modal', null);
                        $('.modal-backdrop').hide();
                    }


                }
            });
        });

        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            request_id = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);
            $.ajax({
                url:"/finance/"+request_id,
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.account;
                    modal.find('.modal-title').text('Request By ' + obj['first_name'] +' '+obj['surname']);
                    $('#profile-image').attr('src','/storage/teacher_images/'+obj['photo']);
                    if(obj['status'] == 'approved'){
                        $('#status-warning').attr('class','col-12 alert alert-success text-center');
                    }else if(obj['status'] == 'declined'){
                        $('#status-warning').attr('class','col-12 alert alert-danger text-center');

                    }else{
                        $('#status-warning').attr('class','col-12 alert-warning text-center');
                    }
                    $('.status').html(obj['status']);
                    $('.amount-request').html(obj['amount']);
                    $('.date').html(obj['created_at']);
                    $('.department').html(obj['department']);
                    $('.description').html(obj['description']);
                    //modal.find('.modal-body input').val(recipient);
                }
            });


        });

        $(document).on('submit', '#statusForm', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"finance/"+request_id,
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    if(obj != null){
                        $('.warning').html(obj['status']);
                    }else{

                        var obj = data.lastId;

                        alert ('Request Made successfully');
                        $('#account-table').DataTable().ajax.reload();
                        $('#viewModal').modal('hide').data('bs.modal', null);
                        $('.modal-backdrop').hide();
                    }


                }
            });
        });
    </script>
@endsection
