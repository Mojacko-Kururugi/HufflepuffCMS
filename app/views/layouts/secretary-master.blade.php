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
              <div class="logo">
                <div class="row">
                  <div class="col l4 m6 s12">
                    {{ HTML::image('img/logo_2.jpg', 'logo', array('class' => 'responsive-img circle')) }}
                  </div>
                  <div class="col l8 m6 s12">
                    <p class="bold blue-text text-accent-4">{{ Session::get('user_name') }}</p>
                    <hr>
                    <p class="small">Branch: <b>{{ Session::get('user_b') }}</b></p>
                  </div>
                </div>


                {{-- <img class="responsive-img circle" src="img/logo_1.jpg"/> --}}
              </div>
              <div class="account-pane center-align">
                <!-- use amber for admin, blue for employee, ?? for manager -->
                <!-- Branch: <span class="bold">Brgy. Sangandaan Branch</span> -->
              </div>
              <li class="bold {{ strpos(Request::url(), 'sec-home') !== false ? 'active' : '' }}"><a href="/sec-home">Dashboard</a></li>
              <li class="bold {{ strpos(Request::url(), 'sec-prod') !== false ? 'active' : '' }}"><a href="/sec-prod">Products</a></li>
              <li class="bold {{ strpos(Request::url(), 'sec-inv') !== false ? 'active' : '' }}"><a href="/sec-inv">Inventory</a></li>
             <!-- <li class="bold {{ strpos(Request::url(), 'sec-sched') !== false ? 'active' : '' }}"><a href="/sec-sched">Employee Schedules</a></li> -->
              <li class="bold {{ strpos(Request::url(), 'sec-order') !== false ? 'active' : '' }}"><a href="/sec-order">Orders</a></li>
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