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
                <div class="row">
                <div class="col l4 m6 s12">    
                  {{ HTML::image('img/logo_2.jpg', 'logo', array('class' => 'responsive-img circle')) }}
                  </div>
                  <div class="col l8 m6 s12">
                    <p class="bold blue-text text-accent-4">{{ Session::get('user_name') }}</p>
                    <hr>
                    <p class="small"><b>Patient</b></p>
                  </div>
                </div>

                {{-- <img class="responsive-img circle" src="img/logo_1.jpg"/> --}}
              </div>
              <div class="account-pane center-align">
                <!-- use amber for admin, blue for employee, ?? for manager -->
                
               <!-- Last Visited Branch: <span class="bold">Brgy. Sangandaan Branch</span> -->
              </div>
              <li class="bold {{ strpos(Request::url(), 'patient-home') !== false ? 'active' : '' }}">
			       <a href="/patient-home" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/home.png', 'home', array('class' => 'responsive-img circle')) }}</span>
						Home
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'patient-sched') !== false ? 'active' : '' }}">
			       <a href="/patient-schedules" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/sched.png', 'sched', array('class' => 'responsive-img circle')) }}</span>
						<span  class="col l7 m6 s12">Schedules</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'patient-records') !== false ? 'active' : '' }}">
			       <a href="/patient-records" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/patient records.png', 'patient records', array('class' => 'responsive-img circle')) }}</span>
						<span  class="col l7 m6 s12">Records</span>
				   </a>
			  </l>
              <li class="bold {{ strpos(Request::url(), 'patient-sales') !== false ? 'active' : '' }}">
			       <a href="/patient-sales" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/accounts.png', 'accounts', array('class' => 'responsive-img circle')) }}</span>
						<span  class="col l7 m6 s12">Account</span>
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

    <main>
      @yield('content')
    </main>

    <!-- SCRIPTS START -->
    {{ HTML::script('js/jquery-2.1.4.min.js') }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    {{ HTML::script('js/materialize.min.js') }}
    {{ HTML::script('js/datatables.min.js') }}
    {{ HTML::script('js/app.js') }}
    <!-- SCRIPTS END -->

    @yield('scripts')
  </body>
</html>
<!--  -->