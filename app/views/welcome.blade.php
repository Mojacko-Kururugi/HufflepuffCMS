<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Welcome | Connie's Optical Clinic</title>

  <!-- CSS  -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Template styles -->
    <style rel="stylesheet">
        /* TEMPLATE STYLES */
        /* Necessary for full page carousel*/
        
        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/
        
        .navbar {
            background-color: rgba(0, 102, 255, 0.5);
          
        }
        
        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
        
        .top-nav-collapse {
            background-color: rgba(0, 102, 255, 0.3);
        }
        
        footer.page-footer {
            background-color: #1C2331;
            margin-top: 0;
        }
        
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #1C2331;
            }
        }
        /* Carousel*/
        
        .carousel,
        .carousel-item,
        .active {
            height: 100%;
        }
        
        .carousel-inner {
            height: 100%;
        }
        /*Caption*/
        
        .flex-center {
            color: #fff;
        }
        
        @media (min-width: 776px) {
            .carousel .view ul li {
                display: inline;
            }
            .carousel .view .full-bg-img ul li .flex-item {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
      <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark fixed-top scrolling-navbar">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand">
                <strong>WELCOME!</strong>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav1">
                <ul class="right navbar-nav mr-auto hide-on-med-and-down"">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Log In</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <!--/.Navbar-->


    <!--Carousel Wrapper-->
    <div id="carousel-example-3" class="carousel slide carousel-fade white-text" data-ride="carousel" data-interval="false">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-3" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-3" data-slide-to="1"></li>
            <li data-target="#carousel-example-3" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">

            <!-- First slide -->
            <div class="carousel-item active view hm-black-light" style="background-image: url('img/bg2.jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Caption -->
                <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeInUp col-md-12">
                        <li>
                            <h1 class="h1-responsive flex-item " style="font-size: 90px">Coonie's Optical Clinic</h1>
                            <li>
                                <p class="flex-item" style="font-size: 30px">Bright Vision. Bright Future</p>
                            </li>
                            <!--
                            <li>
                                <a target="_blank" href="http://mdbootstrap.com/getting-started/" class="btn btn-primary btn-lg flex-item">Sign up!</a>
                            </li>
                            <li>
                                <a target="_blank" href="http://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-default btn-lg flex-item">Learn more</a>
                            </li>
                            -->
                    </ul>
                </div>
                <!-- /.Caption -->

            </div>
            <!-- /.First slide -->

            <!-- Second slide -->
            <div class="carousel-item view hm-black-light" style="background-image: url('http://mdbootstrap.com/img/Photos/Horizontal/Nature/full%20page/img%20(22).jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Caption -->
                <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeInUp col-md-12">
                        <li>
                            <h1 class="h1-responsive">Lots of tutorials at your disposal</h1>
                        </li>
                        <li>
                            <p>And all of them are FREE!</p>
                        </li>
                        <li>
                            <a target="_blank" href="http://mdbootstrap.com/bootstrap-tutorial/" class="btn btn-primary btn-lg">Start learning</a>
                        </li>
                    </ul>
                </div>
                <!-- /.Caption -->

            </div>
            <!-- /.Second slide -->

            <!-- Third slide -->
            <div class="carousel-item view hm-black-light" style="background-image: url('http://mdbootstrap.com/img/Photos/Horizontal/Nature/full%20page/img%20(24).jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Caption -->
                <div class="full-bg-img flex-center white-text">
                    <ul class="animated fadeInUp col-md-12">
                        <li>
                            <h1 class="h1-responsive">Visit our clinic now!</h1></li>
                        <li>
                            <p>We can help you with any question</p>
                        </li>
                        <li>
                            <a target="_blank" href="http://mdbootstrap.com/forums/forum/support/" class="btn btn-default btn-lg">Support forum</a>
                        </li>
                    </ul>
                </div>
                <!-- /.Caption -->

            </div>
            <!-- /.Third slide -->
            
        </div>
        <!--/.Slides-->

        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-3" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-3" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
    
    <!--/.Main layout-->

  <a name= "about"></a>
     <div class= "container">
         <div class ="row">
             <h1>About</h1>
                 <p class="lead" style="font-size: 18px;">
                 Coonee's Optical Clinic started as small scale clinic that began its full operation back in the year 2014, and being run by Dra. Connie Galgana. Before the clinic was fully accredited, it moved from one place to another. Offering quality service to evrey customer. Eventually, another clinic branches opened which now is co-managed by her husband.                           

                 Currently CO Optical is considered one of the leading provider of quality eyewear products in the Philippines such as eyeglasses, contact lenses, and sunglasses. They are maintaining their permanent address at Quezon City.                             

                 A comprehensive eye checkup performed by our trained and competent optometrist is what we offer that will help you determine the right eyewear for you with the help of only the newest and up-to-the-minute facilities and eye care equipment. 

                 Get your eyes checked with the most reliable optical clinic in town!
                 </p>
            </div>
     </div>

  <footer class="page-footer light-blue darken-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">About the Developers</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project for our subjects System Analysis and Design/Capstone Project.</p>


        </div>
        <!--
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>

        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        -->
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Copyright <a class="brown-text text-lighten-3" href="http://materializecss.com">Tonet, Pam, Joselle, Joseph, RJ</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
   <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>


  <script type="text/javascript">
    $(document).ready(function(){
       // $(".button-collapse").sideNav();
       // $('.collapsible').collapsible();
    });
  </script>

  </body>
</html>
