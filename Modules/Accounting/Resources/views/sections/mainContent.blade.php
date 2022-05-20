  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('contentHeaderTitle')</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
		
          <div class="card col-12">
            <!-- /.card-header -->
            <div class="card-body">
              @yield('pageContent')
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
          


        <!-- /.row -->
      </div>
	  <!-- /.container-fluid -->
    </div>
    </section>

    <!-- /.content -->
	
  </div>
  <!-- /.content-wrapper -->
