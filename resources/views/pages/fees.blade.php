
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
            <!--Fee DataTable-->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row">
                    <h1 class="col-9 h3 mb-2 text-gray-800">Fees Table</h1>
                    <button type="button" class="col-3 btn btn-success btn-user btn-block" data-toggle="modal" data-target="#feesModal" data-whatever="@mdo">Add a Fee receipt</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="fee-table" width="100%" cellspacing="0"></table>
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


    <div class="modal fade" id="feesModal" tabindex="-1" role="dialog" aria-labelledby="feesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="feesModalLabel">Add A Receipt</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="feeForm" id="feeForm" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

            <div class="form-group row">
                <div class="col-4">
                    <label for="recipient-name" class="col-form-label">Admission No</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" id="admission" name="admission" placeholder="Admission number"  required>
                </div>
            </div>
            <div class="row my-2"><strong class="font-weight-bold col-md-5">Student Name </strong><span class="names"></span></div>
            <div class="form-group row">
                <div class="col-4">
                    <label for="recipient-name" class="col-form-label">Amount</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount paid" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-4">
                    <label for="recipient-name" class="col-form-label">Description:</label>
                </div>
                <div class="col-8">
                    <select class="form-control" id="description" name="description">
                        <option>tuition</option>
                        <option>Transport</option>
                        <option>Food</option>
                        <option>field Trip</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-4">
                    <label for="exampleFormControlFile1">Receipt Scan</label>
                </div>
                <div class="col-8 dropzone" id="dropzone"> 0.

                </div>
            </div>
            {{csrf_field() }}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add receipt</button>

        </div>
        </form>
        </div>
    </div>
    </div>


    <!-- Page level custom scripts -->
    <script >
        var viewTable;
        $(document).ready(function() {
            viewTable = $('#fee-table').DataTable({
                "bFilter":false,
                "processing": true,
                "serverSide":false,
                "ajax":{
                    "url":"/setfeetable",
                    "type":"GET"
                },
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
                columns: [
                    { title: "Student Admission", "data": "admission_no" },
                    { title: "Names", "data": "names" },
                    { title: "Description", "data": "description" },
                    { title: "Amount", "data": "amount_paid" },
                    { title: "Date Paid", "data": "created_at" },
                    {   title: "Action",
                        "data": "fee_id",
                        "render": function(data, type, full, meta){
                            return '<button type="button" id="" class="btn btn-success btn-xs btn-user" data-toggle="modal" data-target="#viewModal" data-whatever="'+data+'">View</button>';
                        }
                    },
                ],
            });
        });

        Dropzone.options.dropzone =
        {
            maxFilesize: 2,
            paramName: 'receipt',
            clickable: true,
            dictDefaultMessage: '+ Click Here To Upload Receipt Scan',
            url:"{{route('fees.store')}}",
            renameFile: function(file){
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles:".jpeg,.jpg,.png,.gif",
            addRemoveLinks:true,
            timeout: 5000,
            success: function(file, response){
                console.log(response);
            },
            error: function(file, response){
                return false;
            }
        }

        $(document).on('keyup','#admission', function(event){
            event.preventDefault();
            let adm  = $('#admission').val();
            if(adm.length === 3){
                $.ajax({
                    url:"getfeename/"+adm,
                    method:'GET',
                    async: false,
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        var obj = data.name;
                        if(obj != null){
                            $('.names').html(obj['names']);
                        }else{
                            $('.names').html('');
                        }
                    }
                });
            }
        });

        $(document).on('submit', '#feeForm', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"{{route('fees.store')}}",
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
                        alert ("Successfully Saved");
                        viewTable.ajax.reload();
                        $('#feesModal form :input').val('');
                        $('#feesModal').modal('hide').data('bs.modal', null);
                        $('.modal-backdrop').hide();
                    }
                }
            });
        });


    </script>
@endsection
