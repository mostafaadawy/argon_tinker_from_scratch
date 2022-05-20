  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('accounting.sidebar.main') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-cog"></i>
                      <p>
                        {{ __('accounting.sidebar.codesettings') }}
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
      
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                        <a href="{{route('accounting.codesettings.index',['type'=>'revenue'])}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('accounting.sidebar.codesettings_reven') }}</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('accounting.codesettings.index',['type'=>'expenses'])}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('accounting.sidebar.codesettings_expen') }}</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('accounting.codesettings.index',['type'=>'accounts'])}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('accounting.sidebar.codesettings_acc') }}</p>
                        </a>
                      </li>

                  </ul>


                </li>





                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-receipt    "></i>
                    <p>
                      {{ __('accounting.sidebar.dailyrecord') }}
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
    
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{route('accounting.dailyrecords.index',['type'=>'revenue'])}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('accounting.sidebar.dailyrecord_reven') }}</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{route('accounting.dailyrecords.index',['type'=>'expenses'])}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('accounting.sidebar.dailyrecord_expen') }}</p>
                      </a>
                    </li>
                </ul>



                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-cog"></i>
                    <p>
                      {{ __('accounting.sidebar.budgetterms') }}
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
    
                <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-list"></i>
                      <p>
                        {{ __('accounting.revenue') }}
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
      
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                        <a href="{{route('accounting.budgetterms.index',['type'=>'revenue'])}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('accounting.terms') }}</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('accounting.budgetterms.misc',['type'=>'revenue'])}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>{{ __('accounting.misc') }}</p>
                        </a>
                      </li>
                  </ul>


                </li>

                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-list"></i>
                    <p>
                      {{ __('accounting.expenses') }}
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
    
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{route('accounting.budgetterms.index',['type'=>'expenses'])}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('accounting.terms') }}</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{route('accounting.budgetterms.misc',['type'=>'expenses'])}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('accounting.misc') }}</p>
                      </a>
                    </li>
                </ul>


              </li>


                </ul>


              </li>





                <li class="nav-item">
                  <a href="{{route('accounting.report.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-file-excel "></i>
                    <p>
                      {{ __('accounting.sidebar.report') }}
                    </p>
                  </a>
    
                </li>

              </li>




            </ul>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

