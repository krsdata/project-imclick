<header class="main-header">
        <!-- sign  -->
        <a class="logo" href="{{ url('admin') }}">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav role="navigation" class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a role="button" data-toggle="offcanvas" class="sidebar-toggle" href="#">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">2</span>
                </a>
              <ul class="dropdown-menu">
                <li class="header">You have 2 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img alt="User Image" class="img-circle" src="{{ URL::asset('assets/dist/img/user2-160x160.jpg') }}">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      <li>
                        <a href="#">   
                          <div class="pull-left">
                            <img alt="User Image" class="img-circle" src="{{ URL::asset('assets/dist/img/user2-160x160.jpg') }} ">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                       
                    </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
               
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <img alt="User Image" class="user-image" src="{{ URL::asset('assets/dist/img/user2-160x160.jpg') }} ">
                  <span class="hidden-xs">Welcome Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img alt="User Image" class="img-circle" src="{{ URL::asset('assets/dist/img/user2-160x160.jpg') }}">
                    <p>
                     Admin
                      
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a class="btn btn-default btn-flat" href="#">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="{{ url('logout')}}">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>