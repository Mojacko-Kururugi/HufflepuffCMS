<!DOCTYPE html>
<html>
  <head>
    <title>PATIENT | CO Clinic</title>
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
            <span class="app-name">Connie's Optical Clinic</span>
            <ul id="slide-out" class="side-nav fixed">
              <!-- might be horrible to put div inside ul but it works -->
              <div class="logo">
                {{ HTML::image('img/user2.jpg', 'logo', array('class' => 'responsive-img circle')) }}

                {{-- <img class="responsive-img circle" src="img/logo_1.jpg"/> --}}
              </div>
              <div class="account-pane center-align">
                <!-- use amber for admin, blue for employee, ?? for manager -->
                Logged in as: <span class="bold blue-text text-accent-4">Joseph Gallardo </span>
                <br/>
               <!-- Last Visited Branch: <span class="bold">Brgy. Sangandaan Branch</span> -->
              </div>
              <li class="bold {{ strpos(Request::url(), 'patient-home') !== false ? 'active' : '' }}"><a href="/patient-home">Home</a></li>
              <li class="bold {{ strpos(Request::url(), 'patient-sched') !== false ? 'active' : '' }}"><a href="/patient-schedules">Schedules</a></li>
              <li class="bold {{ strpos(Request::url(), 'patient-records') !== false ? 'active' : '' }}"><a href="/patient-records">Records</a></l>
              <li class="bold {{ strpos(Request::url(), 'patient-sales') !== false ? 'active' : '' }}"><a href="/patient-sales">Account</a></li>
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