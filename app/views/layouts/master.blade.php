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
                      {{ HTML::image('img/user1.jpg', 'logo', array('class' => 'responsive-img circle')) }}
                    </div>
                    <div class="col l8 m6 s12">
                      <p class="bold blue-text text-accent-4">Dra. Joselle Lopez </p>
                      <hr>
                      <p class="small">Branch: <b>Brgy. Sangandaan Branch</b></p>
                    </div>
                  </div>

                {{-- <img class="responsive-img circle" src="img/logo_1.jpg"/> --}}
              </div>
              <div class="account-pane center-align">
                <!-- use amber for admin, blue for employee, ?? for manager -->
                
              </div>
              <li class="bold {{ strpos(Request::url(), 'index') !== false ? 'active' : '' }}"><a href="/index">Dashboard</a></li>
              <li class="bold {{ strpos(Request::url(), 'schedules') !== false ? 'active' : '' }}"><a href="/schedules">Schedules</a></li>
              <li class="bold {{ strpos(Request::url(), 'records') !== false ? 'active' : '' }}"><a href="/records">Patient Records</a></li>
              <li class="bold {{ strpos(Request::url(), 'inventory') !== false ? 'active' : '' }}"><a href="/inventory">Inventory</a></li>
              <li class="bold {{ strpos(Request::url(), 'sales') !== false ? 'active' : '' }}"><a href="/sales">Sales</a></li>
              <li class="bold"><a href="/logout">Log out</a></li>
            </ul>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
          </div>
        </nav>
      </div>
    </header>

    <main>
      @yield('content')
    </main>

    <!-- SCRIPTS START -->
    {{ HTML::script('js/jquery-2.1.4.min.js') }}
    {{ HTML::script('js/materialize.min.js') }}
    {{ HTML::script('js/datatables.min.js') }}
    {{ HTML::script('js/app.js') }}
    <!-- SCRIPTS END -->

    @yield('scripts')
  </body>
</html>
<!--  -->