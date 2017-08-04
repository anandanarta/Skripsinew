<?php include_once 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview active">
          <a href="#"><i class="fa fa-link"></i> <span>First Stage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="starter.php">Input Frame</a></li>
            <li class="active"><a href="setting.php">Pengaturan Sampling</a></li>
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
        First Stage
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Pengaturan Sampling</h3>
        </div>
        <div class="box-body">
          <form>
            <div class="row">
              <div class="col-md-4">
                <button class="showdata">Tampilkan Data</button><br><br>
                <div class="form-group">
                  <label for="sel-alocation">Pilih Tipe Alokasi</label>
                  <select id="sel-alocation" class="form-control select" style="width: 100%;">
                    <option value="jumlah-sampel" id="equal-size">Equal Size</option>
                    <option value="alokasi-sampel" id="unequal-size">Unequal Size</option>
                  </select>
                  <br>
                  <div id="jumlah-sampel">
                    <label for="total-sampel">Masukan Jumlah Sampel</label><br>
                    <input id="total-sampel" type="number" min="1" step="1" style="width: 100%;">
                  </div>
                  <div id="alokasi-sampel">
                    <label for="upload-alokasi">Masukan Alokasi Sampling</label>
                    <input id="upload-alokasi" type="file" name="framealokasi">
                  </div>            
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <select id="sel-id" class="form-control select" style="width: 100%;">
                  <option value="jumlah-sampel" id="equal-size">Equal Size</option>
                  <option value="alokasi-sampel" id="unequal-size">Unequal Size</option>
                </select>
                <select id="sel-size" class="form-control select" style="width: 100%;">
                  <option value="jumlah-sampel" id="equal-size">Equal Size</option>
                  <option value="alokasi-sampel" id="unequal-size">Unequal Size</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" style="margin-top: 150px">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih petugas untuk bloksensus ini</h4>
        </div>
        <form action="input.php" method="POST">
        <div class="modal-body">
          <p>
            <div class="form-group">
            
          <label for="sel1">Blok Sensus:</label>
          <input type="text" name="nonks" id="text1">
          <select name="fname" class="form-control" id="sel1">
            <?php include 'connlist.php' ?>
          </select>
        </div>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-success" value="Simpan" >
        </div>
        </form>
      </div>

    </div>
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
      $(document).ready(function() {
        $('#alokasi-sampel').hide();
        $('#jumlah-sampel').hide();
        $('.showdata').click(function(event) {
          var nonks = $(this).attr('id');
          $('#myModal').modal();
          $('#text1').val(nonks);
        });
        $('#sel-alocation').change(function(){
          $('#alokasi-sampel').hide();
          $('#jumlah-sampel').hide();
          var s = $('#sel-alocation').val();
          console.log(s);
          $('#' + $(this).val()).show();
        });
      });
  </script>
<?php include_once 'footer.php'; ?>

