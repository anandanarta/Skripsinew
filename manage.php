<?php session_start(); ?>
<?php include_once 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin Sampling</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"><h4>Sampling Module</h4></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview active">
          <a href="#"><i class="fa fa-link"></i> <span>Sampling</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="manage.php">Manajer Pengaturan Sampel</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manajer Pengaturan Sampel
        <small></small>
      </h1>
    </section>
  
    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">List Pengaturan Penarikan Sampel</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
              <button id="create" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus-square"></i>Tambah</button>
              </div>
            </div>
            <hr>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama Kuesioner</th>
                  <th>Metode</th>
                  <th>Tanggal Penambahan</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php include_once "listsetting.php" ?>
                </tbody>
              </table>
            <hr>
          </div>
        </div>
      </div>
      </div>


      <!-- MY MODAL -->
      <div class="example-modal">
        <div id="myModal" class="modal fade modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Pengaturan Sampel</h4>
              </div>
              <div class="modal-body">
                <h5>Apakah anda yakin ingin menghapus pengaturan sampel pada <span style="font-weight:bold;color:black" id="form_id"></span> ?</h5>
              </div>
              <form action="deletesampling.php" method="post" enctype="multipart/form-data">
              <input type="hidden" id="input_form_id" name="form_id">
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <button id="hapus" type="submit" class="btn btn-outline">Yakin</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>
      <!-- /.example-modal -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
  var form_id;
  $(function () {
    $("#example1").DataTable();
  });
  document.getElementById("create").onclick = function () {
        location.href = "starter.php";
  };
  $('#btnshow').click(function(e){
    form_id = $(this).closest('tr').children('td:first').text();
    console.log(form_id);
  });
  $('.remove').click(function(e){
     form_id = $(this).closest('tr').children('td:first').text();
     $('#form_id').text(form_id);
     $('#input_form_id').val(form_id);
     console.log(form_id); //debug
  }); 
  </script>
  <!-- /.content-wrapper -->
<?php include_once 'footer.php'; ?>

