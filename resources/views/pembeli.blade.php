<!DOCTYPE html>
 
<html lang="en">
<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> Data Pembeli Lil Kind</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('../image/favicon.png') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
 
<div class="container">
<h2>Data Pembeli</h2>
 
<table class="table table-bordered table-striped" id="laravel_datatable">
   <thead>

      <tr>
         <th>ID</th>
         <th>NAMA</th>
         <th>USERNAME</th>
         <th>EMAIL</th>
         <th>PASSWORD</th>
         <th>TELP</th>
         <th>ALAMAT</th>
         <th>Action</th>
      </tr>
   </thead>
</table>
</div>
 
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="userCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="userForm" name="userForm" class="form-horizontal">
           <input type="hidden" name="id_pembeli" id="id_pembeli">
            <div class="form-group">
                <label for="nama_pembeli" class="col-sm-2 control-label">NAMA</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" placeholder="Masukan Nama" value="" maxlength="50" required="">
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">USERNAME</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" value="" maxlength="15" required="">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">EMAIL</label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" value="" maxlength="150" required="">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">PASSWORD</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password"
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-2 control-label">TELP</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="no_pembeli" name="no_pembeli" placeholder="Masukan Nomor" value="20" required="">
                </div>
            </div>

            <div class="form-group">
                <label for="alamat_pembeli" class="col-sm-2 control-label">ALAMAT</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="alamat_pembeli" name="alamat_pembeli" placeholder="Masukan Alamat" value="" maxlength="200" required="">
                </div>
            </div>


    </div>
    </div>


            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Simpan
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>
</body>

<script>
var SITEURL = '{{URL::to('')}}';
 $(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('#laravel_datatable').DataTable({
         processing: false,
         serverSide: true,
         ajax: "{{ route('api.pembeli') }}",
         columns: [
                  {data: 'id_pembeli', name: 'id_pembeli'},
                  {data: 'nama_pembeli', name: 'nama_pembeli' },
                  {data: 'username', name: 'username' },
                  {data: 'email', name: 'email' },
                  {data: 'password', name: 'password' },
                  {data: 'no_pembeli', name: 'no_pembeli' },
                  {data: 'alamat_pembeli', name: 'alamat_pembeli' },
                  {data: 'action', name: 'action', orderable: false},
               ],
      });
 /*  When user click add user button */
    $('#create-new-user').click(function () {
        $('#btn-save').val("create-user");
        $('#id_pembeli').val('');
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-crud-modal').modal('show');
    });
 
   /* When click edit user */
    $('body').on('click', '.edit-user', function () {
      var id_pembeli = $(this).data('id_pembeli');
      $.get('ajax-crud-list/' + user_id +'/edit', function (data) {
         $('#name-error').hide();
         $('#email-error').hide();
         $('#userCrudModal').html("Edit User");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#id_pembeli').val(data.id_pembeli);
          $('#nama_pembeli').val(data.nama_pembeli);
          $('#username').val(data.username);
          $('#email').val(data.email);
          $('#password').val(data.password);
          $('#no_pembeli').val(data.no_pembeli);
          $('#alamat_pembeli').val(data.alamat_pembeli);
          
      })
   });
    $('body').on('click', '#delete-user', function () {
 
        var user_id = $(this).data("id_pembeli");
        confirm("Are You sure want to delete !");
 
        $.ajax({
            type: "get",
            url: SITEURL + "ajax-crud-list/delete/"+id_pembeli,
            success: function (data) {
            var oTable = $('#laravel_datatable').dataTable(); 
            oTable.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
   });
 
if ($("#userForm").length > 0) {
      $("#userForm").validate({
 
     submitHandler: function(form) {
 
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#userForm').serialize(),
          url: SITEURL + "ajax-crud-list/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
 
              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Simpan');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Simpan');
          }
      });
    }
  })
}
</script>
</html>