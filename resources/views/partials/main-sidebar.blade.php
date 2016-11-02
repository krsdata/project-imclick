<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img alt="User Image" class="img-circle" src="{{ URL::asset('assets/dist/img/user2-160x160.jpg') }}">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form class="sidebar-form" method="get" action="#">
            <div class="input-group">
              <input type="text" placeholder="Search..." class="form-control" name="q">
              <span class="input-group-btn">
                <button class="btn btn-flat" id="search-btn" name="search" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{ url('admin') }}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
              </ul>
            </li>
            
            
           <!--  <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Advertisement</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="admin/advertisement/create"><i class="fa fa-circle-o"></i> Create Advertisement</a></li>
                <li><a href="admin/adminadvertisement"><i class="fa fa-circle-o"></i> View Advertisement</a></li>
              </ul>
            </li> -->

            <li class="treeview {{ (isset($page_action) && $page_title=='Group')?"active":'' }}">
              <a href="#">
                 <i class="fa fa-group"></i>
                <span>Group</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ (isset($page_action) && $page_action=='Create')?"active":'' }}"><a href="{{ route('group.create')}}"><i class="fa fa-user-plus"></i> Create Group</a></li>
                <li class="{{ (isset($page_action) && $page_action=='Groups')?"active":'' }}"><a href="{{ route('group')}}"><i class="fa  fa-list"></i> View Group</a></li>
              </ul>
            </li>


            <li class="treeview {{ (isset($page_action) && $page_title=='User')?"active":'' }} ">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Manage Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ (isset($page_action) && $page_action=='Create User')?"active":'' }}" ><a href="{{ route('user.create')}}"><i class="fa fa-user-plus"></i> Create User</a></li>
                <li class="{{ (isset($page_action) && $page_action=='View User')?"active":'' }}"><a href="{{ route('user')}}"><i class="fa  fa-list"></i> View User</a></li>
              </ul>
            </li>
            
            <li class="treeview {{ (isset($page_action) && $page_title=='Package')?"active":'' }} ">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Manage Package</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ (isset($page_action) && $page_action=='Create Package')?"active":'' }}" ><a href="{{ route('package.create')}}"><i class="fa fa-user-plus"></i> Create Package</a></li>
                <li class="{{ (isset($page_action) && $page_action=='View Package')?"active":'' }}"><a href="{{ route('package')}}"><i class="fa  fa-list"></i> View Package</a></li>
              </ul>
            </li>


            <li class="treeview {{ (isset($page_action) && $page_title=='Building')?"active":'' }} ">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Manage Building</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <!--  <li class="{{ (isset($page_action) && $page_action=='Create Building')?"active":'' }}" ><a href="{{ route('building.create')}}"><i class="fa fa-user-plus"></i> Create Building</a></li>
                --> <li class="{{ (isset($page_action) && $page_action=='View Building')?"active":'' }}"><a href="{{ route('building')}}"><i class="fa  fa-list"></i> View Building</a></li>
              </ul>
            </li> 

 
            <li class="treeview {{ (isset($page_action) && $page_title=='System Alert Search')?"active":'' }} ">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>System Alert Search</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li class="{{ (isset($page_action) && $page_action=='View System Alert Search')?"active":'' }}"><a href="{{ route('systemAlertSearch')}}"><i class="fa   fa-list"></i> View System alert search</a></li>
              </ul>
            </li> 

            <li class="treeview {{ (isset($page_action) && $page_title=='Transaction')?"active":'' }} ">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Transactions</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li class="{{ (isset($page_action) && $page_action=='View Transaction')?"active":'' }}"><a href="{{ route('transaction')}}"><i class="fa   fa-list"></i> View Transaction</a></li>
              </ul>
            </li>

            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>