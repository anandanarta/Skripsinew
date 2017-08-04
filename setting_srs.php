<?php session_start();?>
<?php include_once 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"><h4>Sampling Module</h4></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview active">
          <a href="#"><i class="fa fa-link"></i> <span>Penarikan Sampel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="manage.php">Manajer Pengaturan Sampel</a></li>
            <li><a href="starter.php">Pilih Kuesioner</a></li>
            <li class="active"><a href="setting.php">Pengaturan Penarikan Sampel</a></li>
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
        Pengaturan Simple Random Sampling
        <small></small>
      </h1>
    </section>
  
    <!-- Main content -->
    <section class="content">
      <form action="uploadmetodepref.php" method="post" enctype="multipart/form-data">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Identifikasi Kuesioner</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label for="sel-var_id">Pilih Variabel yang Digunakan Sebagai Wilayah Cacah</label>
                  <select name="var_id" id="sel-var_id" class="form-control" data-placeholder="Pilih Variabel Wilayah Cacah" required style="width: 100%;">
                    <?php include 'list_var.php' ?>
                  </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4">
                  <label for="sel-order_id">Pilih Variabel yang Digunakan Sebagai ID Unit</label>
                  <select name="order_id" id="sel-order_id" class="form-control" data-placeholder="Pilih Variabel ID Unit" required style="width: 100%;">
                    <?php include 'list_var.php' ?>
                  </select>
              </div>
            </div>
          </div>
        </div>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Pengaturan Jumlah Sampel</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label for="input_jumlah">Jumlah Sampel per ID</label>
                  <input id="input_jumlah" name="jumlah" type="number" min="1" step="1" style="width: 100%;">
              </div>
            </div>
            <hr>
            <div class="row" id="rowsubmit">
              <div class="col-md-4">
                  <input class="btn btn-primary" type="submit" value="Submit" name="submit">
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    $('select').select2();
    $(document).ready(function() {
      var s;  
      $('#sel-var_id').change(function(){
          $('#' + s).show();
          $('#sel-var_order option[id='+s+']').show();
          console.log($(this).val());
          s = $('#sel-var_id').val();
          $('#sel-var_order option[id='+s+']').hide();
          $('#' + $(this).val()).hide();
          s = $('#sel-var_id').val();
      });
      var t;
      $('#sel-kuesioner-cacah').change(function(){
          $('#' + t).show();
          $('#sel-kuesioner-listing option[id='+t+']').show();
          console.log($(this).val());
          t = $('#sel-kuesioner-cacah').val();
          $('#sel-kuesioner-listing option[id='+t+']').hide();
          $('#' + $(this).val()).hide();
          t = $('#sel-kuesioner-cacah').val();
      });          
    });
  </script>
  <!-- /.content-wrapper -->
<?php include_once 'footer.php'; ?>

