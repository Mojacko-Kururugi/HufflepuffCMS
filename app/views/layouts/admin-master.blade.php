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
                  <div class="col l5 m6 s12">
                    {{ HTML::image('img/logo_2.jpg', 'logo', array('class' => 'responsive-img circle')) }}
                  </div>
                  <div class="col l7 m6 s12">
                    <!-- Logged in as: <span class="bold blue-text text-accent-4">System Admin </span> -->
                    <span class="bold blue-text text-accent-4">System Admin </span>
                  </div>
                </div>

                {{-- <img class="responsive-img circle" src="img/logo_1.jpg"/> --}}
              </div>
              <div class="account-pane center-align">
                <!-- use amber for admin, blue for employee, ?? for manager -->
                <!-- Branch: <span class="bold">Brgy. Sangandaan Branch</span> -->
              </div>
              <li class="bold {{ strpos(Request::url(), 'admin') !== false ? 'active' : '' }}">
			       
			       <a href="/admin"  class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/dashboard.png', 'dashboard', array('class' => 'responsive-img circle')) }}</span>
						<span  class="col l7 m6 s12">Dashboard</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'branches') !== false ? 'active' : '' }}">
			       <a href="/branches" class="row">
				       <span class="col l3 m6 s12">{{ HTML::image('img/branches.png', 'branches', array('class' => 'responsive-img circle')) }}</span>
				       <span  class="col l7 m6 s12">Branches</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'doctors') !== false ? 'active' : '' }}">
			       <a href="/doctors" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/doctor.png', 'doctor', array('class' => 'responsive-img circle')) }}</span>
				         <span  class="col l7 m6 s12">Optometrists</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'employees') !== false ? 'active' : '' }}">
			       <a href="/employees" class ="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/employee.png', 'employee', array('class' => 'responsive-img circle')) }}</span>
				        <span  class="col l7 m6 s12">Employees</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'product-type') !== false ? 'active' : '' }}">
			       <a href="/product-type" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/product type.png', 'product type', array('class' => 'responsive-img circle')) }}</span>
				        <span  class="col l7 m6 s12">Product Types</span>
				   </a>
			  </li>
              <li class="bold {{ strpos(Request::url(), 'products') !== false ? 'active' : '' }}">
			       <a href="/products" class="row">
				         <span class="col l3 m6 s12">{{ HTML::image('img/products.png', 'products', array('class' => 'responsive-img circle')) }}</span>
				        <span  class="col l7 m6 s12">Products</span>
				   </a>
			 </li>
              <li class="bold {{ strpos(Request::url(), 'services') !== false ? 'active' : '' }}">
			       <a href="/services" class="row">
				        <span class="col l3 m6 s12">{{ HTML::image('img/service.png', 'services', array('class' => 'responsive-img circle')) }}</span>
				        <span  class="col l7 m6 s12">Services</span>
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
    {{ HTML::script('js/materialize.min.js') }}
    {{ HTML::script('js/datatables.min.js') }}
    {{ HTML::script('js/app.js') }}
    <!-- SCRIPTS END -->

    @yield('scripts')
  </body>
</html>
<!--  -->