<?php session_start(); ?>
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
            <li class="active"><a href="starter.php">Pilih Kuesioner</a></li>
            <li><a href="setting.php">Pengaturan Metode Sampling</a></li>
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
        Pilih Kuesioner
        <small></small>
      </h1>
    </section>
  
    <!-- Main content -->
    <section class="content">
      <form action="uploadpref.php" method="post" enctype="multipart/form-data">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Pemilihan Kuesioner</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label for="sel-kuesioner-listing">Pilih Kuesioner Listing</label>
                  <select name="listing" id="sel-kuesioner-listing" class="form-control select2" required style="width: 100%;">
                    <option disabled selected value> -- select an option -- </option>
                    <?php include 'list_kues.php' ?>
                  </select>
              </div>
            </div>
            <hr>
        <!--<div class="row">
              <div class="col-md-4">
                  <label for="sel-kuesioner-cacah">Pilih Kuesioner Pencacahan</label>
                  <select name="cacah" id="sel-kuesioner-cacah" class="form-control select2" required style="width: 100%;">
                    <option disabled selected value> -- select an option -- </option>
                    <?php //include 'list_kues.php' ?>
                  </select>
              </div>
            </div>
            <hr>-->
            <div class="row">
              <div class="col-md-4">
                  <label for="metode">Pilih Metode Sampling</label>
                  <select name="metode" id="sel-metode" class="form-control select" required style="width: 100%;">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="srs" id="srs">Simple Random Sampling</option>
                    <option value="systematic" id="systematic">Systematic Sampling</option>
                    <option value="pps" id="pps">Probability Proportional to Size Sampling</option>
                  </select>
              </div>
            </div>
            <hr>
            <div class="row" id="rowsubmit">
              <div class="col-md-4">
                  <input id="next" class="btn btn-primary" type="submit" value="Confirm" name="submit">
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      var s;  
      $('#sel-kuesioner-listing').on("change", function(){
          $('#' + s).show();
          $('#sel-kuesioner-cacah option[id='+s+']').show();
          console.log($(this).val());
          s = $('#sel-kuesioner-listing').val();
          $('#sel-kuesioner-cacah option[id='+s+']').hide();
          $('#' + $(this).val()).hide();
          s = $('#sel-kuesioner-listing').val();
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

