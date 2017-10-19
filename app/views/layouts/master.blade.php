<!DOCTYPE html>
<html>
  <head>
    <title>CLINIC MANAGEMENT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- STYLES START -->
    {{ HTML::style('css/materialize.min.css') }}
    {{ HTML::style('css/datatables.min.css') }}
    {{ HTML::style('css/style.css') }}
    <!-- STYLES END -->
  </head>
  <body>
    <header>
      <!-- NAVBAR GOES HERE -->
      <div class="navbar-fixed">
        <nav class="blue darken-1">
          <div class="nav-wrapper">
            <span class="app-name">Clinic Management</span>
            <ul id="slide-out" class="side-nav fixed">
              <!-- might be horrible to put div inside ul but it works -->
              <!-- the only horrible thing happened in this world is your face -->
              <div class="logo">
                <div class="row">
                    <div class="col l4 m6 s12">
                      {{ HTML::image('img/logo_2.jpg', 'logo', array('class' => 'responsive-img circle')) }}
                    </div>
                    <div class="col l8 m6 s12">
                      <p class="bold blue-text text-accent-4">{{ Session::get('user_name') }}</p>
                      <hr>
                      <p class="small"><b>{{ Session::get('user_desc') }}</b></p>
                      <hr>
                      <p class="small">Branch: <b>{{ Session::get('user_b') }}</b></p>
                    </div>
                  </div>

                {{-- <img class="responsive-img circle" src="img/logo_1.jpg"/> --}}
              </div>
              <div class="account-pane center-align">
                <!-- use amber for admin, blue for employee, ?? for manager -->
                
              </div>
              <li class="bold {{ strpos(Request::url(), 'index') !== false ? 'active' : '' }}">
			       <a href="/index" class="row">
				       <span class="col l3 m6 s12">{{ HTML::image('img/dashboard.png', 'dashboard', array('class' => 'responsive-img circle')) }}</span>
				       <span  class="col l7 m6 s12">Dashboard</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'schedules') !== false ? 'active' : '' }}">
			       <a href="/schedules" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/sched.png', 'schedule', array('class' => 'responsive-img circle')) }}</span>
						<span  class="col l7 m6 s12">Schedules</span>
				   </a>
			  </li>
        <!-- cut -->
              <li class="bold {{ strpos(Request::url(), 'service') !== false ? 'active' : '' }}">
			       <a href="/service" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/service.png', 'service', array('class' => 'responsive-img circle')) }}</span>
						<span  class="col l7 m6 s12">Service History</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'inventory') !== false ? 'active' : '' }}">
			       <a href="/inventory" class="row">
                        <span class="col l3 m6 s12">{{ HTML::image('img/inventory.png', 'inventory', array('class' => 'responsive-img circle')) }}</span>
				        <span  class="col l7 m6 s12">Inventory</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'sales') !== false ? 'active' : '' }}">
			        <a href="/sales" class="row">
					     <span class="col l3 m6 s12">{{ HTML::image('img/sales.png', 'sales', array('class' => 'responsive-img circle')) }}</span>
						 <span  class="col l7 m6 s12">Sales</span>
					</a>
			  </li>
              <li class="bold">
			       <a href="/logout" class="row">
				         <span class="col l3 m6 s12">{{ HTML::image('img/logout.png', 'logout', array('class' => 'responsive-img circle')) }}</span>
				         <span  class="col l7 m6 s12">Log out</span>
				   </a>
			  </li>
            </ul>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
          </div>
        </nav>
      </div>
    </header>

     <!-- SCRIPTS START -->
    {{ HTML::script('js/jquery-2.1.4.min.js') }}
    {{ HTML::script('js/jquery.validate.min.js') }}
    {{ HTML::script('js/materialize.min.js') }}
    {{ HTML::script('js/datatables.min.js') }}
    {{ HTML::script('js/app.js') }}
    <!-- SCRIPTS END -->

    <main>
      @yield('content')
    </main>

    @yield('scripts')
  </body>
</html>
<!--  -->