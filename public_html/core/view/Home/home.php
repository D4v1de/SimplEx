 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <!-- Basic Page Needs
    ================================================== -->
        <meta charset="utf-8">
        <title>SimplEx</title>
        <meta name="description" content="">
        <!-- Mobile Specific Metas
    ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
         <!-- CSS
         ================================================== -->
		 <!-- logo sopra la pagina-->
        <link rel="shortcut icon" href="/assets/admin/layout/img/simplexIcon.png"/>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="/assets/homepage/css/bootstrap.min.css"/>
        <!-- FontAwesome -->
        <link rel="stylesheet" href="/assets/homepage/css/font-awesome.min.css"/>
        <!-- Animation -->
        <link rel="stylesheet" href="/assets/homepage/css/animate.css" />
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="/assets/homepage/css/owl.carousel.css"/>
        <link rel="stylesheet" href="/assets/homepage/css/owl.theme.css"/>
        <!-- Pretty Photo -->
        <link rel="stylesheet" href="/assets/homepage/css/prettyPhoto.css"/>
        <!-- Main color style -->
        <link rel="stylesheet" href="/assets/homepage/css/red.css"/>
        <!-- Template styles-->
        <link rel="stylesheet" href="/assets/homepage/css/custom.css" />
        <!-- Responsive -->
        <link rel="stylesheet" href="/assets/homepage/css/responsive.css" />
        <link rel="stylesheet" href="/assets/homepage/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>
    </head>

 <body data-spy="scroll" data-target=".navbar-fixed-top">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <header id="section_header" class="navbar-fixed-top main-nav" role="banner">
    	<div class="container">
    		<!-- <div class="row"> -->
                 <div class="navbar-header ">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">
                            <img src="/assets/homepage/images/logo2.png" alt="">
                        </a>
                 </div><!--Navbar header End-->
                 	<nav class="collapse navbar-collapse navigation" id="bs-example-navbar-collapse-1" role="navigation">
                        <ul class="nav navbar-nav navbar-right ">

                            <li><a href="#service"  class="page-scroll">Lavoro svolto</a> </li>
                            <li><a href="#portfolio" class="page-scroll" >Chi siamo</a> </li>
                            <li><a href="#about" class="page-scroll">Preview </a> </li>
                            <li><a href="#team" class="page-scroll">Il nostro Team </a> </li>
                            <li><a href="#contact" class="page-scroll">Contattaci</a> </li>
                            <li><a href="/auth" class="page-scroll">Login</a> </li>
                        </ul>
                     </nav>
                </div><!-- /.container-fluid -->
</header>
 <!-- Slider start -->
    <section id="slider_part">
         <div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
            <!-- Indicators -->
         	 <ol class="carousel-indicators text-center">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
             </ol>

           	<div class="carousel-inner">
           	 	<div class="item active">
           	 		<div class="overlay-slide">
           	 			<img src="/assets/homepage/images/banner/img4.jpg" alt="" class="img-responsive">
           	 		</div>
           	 		<div class="carousel-caption">
               	 		<div class="col-md-12 col-xs-12 text-center">
                      <h2>SimplEx</h2>
               	 			<h3 class="animated2"> <b>Simple </b>Exam </h3>
               	 			<div class="line"></div>
               	 			<p class="animated3">Unique clean design</p>
               	 		</div>
           	 		</div>
           	 	</div>
                <div class="item">
                    <div class="overlay-slide">
                        <img src="/assets/homepage/images/banner/img7.jpg" alt="" class="img-responsive">
           	 		</div>
           	 		<div class="carousel-caption">
               	 		<div class="col-md-12 col-xs-12 text-center">
                    <h2>SimplEx</h2>
               	 			<h3 class="animated3"> Less <b>paper </b></h3>
               	 			<div class="line"></div>
               	 			<p class="animated2">best choice for you</p>
               	 		</div>
           	 		</div>
           	 	</div>
           	 	<div class="item">
                    <div class="overlay-slide">
                        <img src="/assets/homepage/images/banner/img6.jpg" alt="" class="img-responsive">
           	 		</div>
           	 		<div class="carousel-caption">
               	 		<div class="col-md-12 col-xs-12 text-center">
                    <h2>SimplEx</h2>
               	 			<h3 class="animated3"> We're crazy <b>coders</b></h3>
               	 			<div class="line"></div>
               	 			<p class="animated2"> way to success</p>
               	 		</div>
           	 		</div>
           	 	</div>

           	 </div> 	 <!-- End Carousel Inner -->

            <!-- Controls -->
            <div class="slides-control ">
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                	<span><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                	<span><i class="fa fa-angle-right"></i></span>
                </a>
            </div>
        </div>
  	</section>
    <!--/ Slider end -->

<!-- Service Area start -->

    <section id="service">
        <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="feature_header text-justify">
                            <h3 class="feature_title text-center">Il lavoro <b>svolto</b></h3>
                            <h4 class="feature_sub">L’obiettivo del progetto &egrave; stato quello di apportare all'<b>Universit&agrave; degli studi di Salerno</b>, in particolare al <b>dipartimento di Informatica</b>,
                                 un beneficio dal punto di vista dei costi (risparmiando sull’acquisto di carta) e dell'efficienza.
                                <br> Il docente ha la possibilità di creare facilmente dei test, sia a carattere esercitativo che valutativo, inserendo sia domande a risposta multipla che
                                domande a risposta aperta. Il sistema, nel caso di test con domande a risposta multipla, é in grado di valutare la prova sulla base delle risposte corrette
                                segnalate dal docente. In questo modo il docente, e gli stessi studenti, hanno la possibilit&agrave; di conoscere quasi in tempo reale il risultato dei test.
                                Inoltre lo studente ha la possibilità di valutare al meglio il proprio studio ed eventualmente venire incontro alle proprie carenze attraverso le esercitazioni proposte dal docente.
                                <br>Il sistema &egrave; capace di gestire più corsi contemporaneamente. La gestione dei corsi comprende anche la possibilità di condurre esercitazioni ed esami relativi
                                a quest’ultimi. Ogni utente avr&agrave; a disposizione una serie di esercitazioni che aiuteranno nella comprensione degli argomenti e l’accompagneranno di volta in volta verso
                                il conseguimento dell’esame. Questa &egrave; una caratteristica fondamentale del sistema: <b> semplificare ed incentivare lo studente</b>.</h4>
                            <div class="divider"></div>
                        </div>
                    </div>  <!-- Col-md-12 End -->
                </div>
                <div class="row">
                    <div class="main_feature text-center">
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-lightbulb-o"></i>
                                    <h5>Lightweight</h5>
                                    <p>You can not ignore mobile devices anymore and with this theme all your visitors will be very pleased how they see your website.</p>
  
                                </div>
                            </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-pencil"></i>
                                    <h5>Beautiful Typrography</h5>
                                    <p>This theme integrates with WordPress in the most awesome way! Functionality is separated from style through uncreadble useful for user. </p>
                                    
                                </div>
                        </div> <!-- Col-md-4 Single_feature End -->
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-cog"></i>
                                    <h5>Full time Support</h5>
                                    <p>Full Time support. Very much helpful and possesive at the same time. With all this in mind you won’t be outdated anytime soon. Really!! </p>
                                   
                                </div>
                        </div> <!-- Col-md-4 Single_feature End -->
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-desktop"></i>
                                    <h5>Ultra Responsive</h5>
                                    <p>Shadow is as optimized as it gets. No useless wrappers, no double headings, everything is coded with SEO in mind. Content is KING! </p>
                                    
                                </div>
                        </div> <!-- Col-md-4 Single_feature End -->
                        <!-- <button class="btn btn-main"> Read More</button> -->
                    </div>
            </div>  <!-- Row End -->
        </div>  <!-- Container End -->
    </section>
<!-- Service Area End -->

        <!-- Counter Strat -->

        <section id="counter_area">
            <div class="facts">
                <div class="container">
                    <div class="col-md-3 col-xs-12 col-sm-6 columns">
                        <div class="facts-wrap">
                            <div class="graph">
                                <div class="graph-left-side">
                                    <div class="graph-left-container">
                                        <div class="graph-left-half"> </div>
                                    </div>
                                </div>
                                <div class="graph-right-side">
                                    <div class="graph-right-container">
                                        <div class="graph-right-half"></div>
                                    </div>
                                </div>
                                <i class="fa fa-envelope-o fa-3x fw"></i>
                                <div class="facts-wrap-num">
                                    <span class="counter">87</span>
                                </div>
                            </div>
                            <h6>Email</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-6 columns">
                        <div class="facts-wrap">
                            <div class="graph">
                                <div class="graph-left-side">
                                    <div class="graph-left-container">
                                        <div class="graph-left-half"> </div>
                                    </div>
                                </div>
                                <div class="graph-right-side">
                                    <div class="graph-right-container">
                                        <div class="graph-right-half"></div>
                                    </div>
                                </div>
                                <i class="fa fa-weixin fa-3x fw"></i>
                                <div class="facts-wrap-num"><span class="counter">25</span></div>
                            </div>
                            <h6>Messaggi</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-6 columns">
                        <div class="facts-wrap">
                            <div class="graph">
                                <div class="graph-left-side">
                                    <div class="graph-left-container">
                                        <div class="graph-left-half"> </div>
                                    </div>
                                </div>
                                <div class="graph-right-side">
                                    <div class="graph-right-container">
                                        <div class="graph-right-half"></div>
                                    </div>
                                </div>
                                <i class="fa fa-group fa-3x fw"></i>
                                <div class="facts-wrap-num"><span class="counter">68</span></div>
                            </div>
                            <h6>Meeting</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-6 columns">
                        <div class="facts-wrap">
                            <div class="graph">
                                <div class="graph-left-side">
                                    <div class="graph-left-container">
                                        <div class="graph-left-half"> </div>
                                    </div>
                                </div>
                                <div class="graph-right-side">
                                    <div class="graph-right-container">
                                        <div class="graph-right-half"></div>
                                    </div>
                                </div>
                                <i class="fa fa-check-square-o fa-3x fw"></i>
                                <div class="facts-wrap-num"><span class="counter">46</span></div>
                            </div>
                            <h6>Commit</h6>
                        </div>
                    </div>
                </div> <!-- Conatainer End -->
            </div>	<!-- Fact div ENd -->
        </section>
        <!-- Counter End -->

        <!-- Counter End -->
<!-- Portfolio works Start -->

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="feature_header text-center">
                        <h3 class="feature_title">Chi <b>siamo</b></h3>
                        <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                        <div class="divider"></div>
                    </div>
                </div>  <!-- Col-md-12 End -->
            </div>
        </div>

	</section>  <!-- Portfolio Section End -->

<div class="clearfix"></div>

<!-- About us start -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title">Preview di <b>SimplEx</b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="feature-tab">
               <div class="col-md-2 col-sm-3 col-xs-12">
                    <ul class="nav nav-tabs main-tab-list text-center" role="tablist">
                          <li role="presentation" class="active">
                            <a href="#home" role="tab" data-toggle="tab" >
                              <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                </div>
                                 <h4>Web</h4>
                            </a>
                          </li>
						   <li role="presentation" >
                            <a href="#profile" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-send"></i>
                                    </div>
                                </div>
                                <h4>Home docente</h4>
                            </a>
                          </li>
                            <li role="presentation" >
                            <a href="#profile" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-send"></i>
                                    </div>
                                </div>
                               <h4>Home studente</h4>
                            </a>
                          </li>
                          <li role="presentation" >
                            <a href="#profile" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-send"></i>
                                    </div>
                                </div>
                                <h4>Creazione test</h4>
                            </a>
                          </li>
                          <li role="presentation" >
                            <a href="#profile" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-send"></i>
                                    </div>
                                </div>
                                <h4>Esecuzione test</h4>
                            </a>
                          </li>
                         
                    </ul>
                </div>  <!-- col-md-12 end -->
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <div class="tab-content main-tab-content">
                          <div role="tabpanel" class="tab-pane active " id="home">
                                <div class="col-md-12 col-sm-9">
                                     <img src="/assets/homepage/images/about/web1.png" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-12 col-sm-9">
                                    <div class="c-tab">
                                         <h4>Web Design and Development</h4>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus praesentium dolore sequi excepturi recusandae reprehenderit, distinctio.</p>
                                         <br>
                                         <p>
                                             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dolorum, quisquam eum eaque. Excepturi nisi necessitatibus, inventore explicabo corporis expedita fugit aspernatur harum reprehenderit temporibus, pariatur esse laborum qui quisquam.
                                         </p>
                                         <br>
                                         <a href="#"> Learn More</a>
                                    </div>
                                </div>
                                
                          </div>
                          <div role="tabpanel" class="tab-pane" id="profile">
                                <div class="col-md-12 col-sm-9">
                                     <img src="/assets/homepage/images/about/browse.png" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-12 col-sm-9">
                                    <div class="c-tab">
                                         <h4>Email and Socail Marketing</h4>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus praesentium dolore sequi excepturi recusandae reprehenderit, distinctio.</p>
                                         <br>
                                         <p>
                                             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dolorum, quisquam eum eaque. Excepturi nisi necessitatibus, inventore explicabo corporis expedita fugit aspernatur harum reprehenderit temporibus, pariatur esse laborum qui quisquam.
                                         </p>
                                         <br>
                                         <a href="#"> Learn More</a>
                                    </div>
                                </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="messages">
                               <div class="col-md-12 col-sm-9">
                                     <img src="/assets/homepage/images/about/web1.png" alt="" class="img-responsive">
                                </div>
                               <div class="col-md-12 col-sm-9">
                                    <div class="c-tab">
                                         <h4>Graphics Brand Identity</h4>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus praesentium dolore sequi excepturi recusandae reprehenderit, distinctio.</p>
                                         <br>
                                         <p>
                                             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dolorum, quisquam eum eaque. Excepturi nisi necessitatibus, inventore explicabo corporis expedita fugit aspernatur harum reprehenderit temporibus, pariatur esse laborum qui quisquam.
                                         </p>
                                         <br>
                                        <a href="#"> Learn More</a>
                                    </div>
                                </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="photo">
                               <div class="col-md-12 col-sm-9">
                                     <img src="/assets/homepage/images/about/graphics.png" alt="" class="img-responsive">
                                </div>
                               <div class="col-md-12 col-sm-9">
                                    <div class="c-tab">
                                        <h4>Photography Design</h4>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus praesentium dolore sequi excepturi recusandae reprehenderit, distinctio.</p>
                                         <br>
                                         <p>
                                             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dolorum, quisquam eum eaque. Excepturi nisi necessitatibus, inventore explicabo corporis expedita fugit aspernatur harum reprehenderit temporibus, pariatur esse laborum qui quisquam.
                                         </p>
                                         <br>
                                        <a href="#"> Learn More</a>
                                    </div>
                                </div>
                          </div>
                            <div role="tabpanel" class="tab-pane" id="ios">
                                <div class="col-md-12 col-sm-9">
                                     <img src="/assets/homepage/images/about/web1.png" alt="" class="img-responsive">
                                </div>
                               <div class="col-md-12 col-sm-9">
                                    <div class="c-tab">
                                         <h4>ios application</h4>
                                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus praesentium dolore sequi excepturi recusandae reprehenderit, distinctio.</p>
                                         <br>
                                         <p>
                                             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae dolorum, quisquam eum eaque. Excepturi nisi necessitatibus, inventore explicabo corporis expedita fugit aspernatur harum reprehenderit temporibus, pariatur esse laborum qui quisquam.
                                         </p>
                                         <br>
                                         <a href="#"> Learn More</a>
                                    </div>
                                </div>
                             </div>
                    </div>
                </div>

                 
            </div>
        </div>
    </div>
</section>
<!-- About us End -->



<!-- Testimonial Start -->

<section id="testimonial" class="wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title">I <b>Manager </b> del progetto</h3>
                 <!--   <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4> -->
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
        </div>
                <div class="row">
                    <div id="testimonial-carousel" class="owl-carousel owl-theme text-center testimonial-slide">
                        <div class="item">
                          <div class="testimonial-thumb">
                            <img class="img-circle" src="/assets/homepage/images/team/DeLucia.jpg" alt="testimonial" >
                          </div>
                          <div class="testimonial-content">
                            <h3 class="name">Professore Andrea De Lucia <span><b>Top Manager</b></span></h3>
                            <p class="testimonial-text">
                              iLorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose. Lorem Ipsum is that it as opposed to using.
                            </p>
                          </div>
                        </div>
                        <div class="item">
                          <div class="testimonial-thumb">
                            <img class="img-circle" src="/assets/homepage/images/team/Alex.png" alt="testimonial" >
                          </div>
                          <div class="testimonial-content">
                          	<h3 class="name">Alessandro Longo <span><b>Project Manager</b></span></h3>
                            <p class="testimonial-text">
                              Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose. Lorem Ipsum is that it as opposed to using.
                            </p>
                          </div>
                        </div>
                        <div class="item">
                          <div class="testimonial-thumb">
                            <img class="img-circle" src="/assets/homepage/images/team/Davide.png" alt="testimonial" >
                          </div>
                          <div class="testimonial-content">
                          	<h3 class="name wow bounceInLeft">Davide De Chiara<span><b>Project Manager</b></span></h3>
                            <p class="testimonial-text">
                              Lorem Ipsum as their default model text, and a search for ‘lorem ipsum’ will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose. Lorem Ipsum is that it as opposed to using.
                            </p>
                          </div>
                        </div>
                    </div>
                  	<!-- Navigation start -->
                  	<div class="customNavigation cyprass-carousel-controller">
                        <a class="prev left">
                        	<i class="fa fa-chevron-left"></i>
                       	</a>
                        <a class="next right">
                          <i class="fa fa-chevron-right"></i>
                        </a>
                	</div>
                	<!-- Navigation ENd -->
                </div>
            </div> <!-- Row End -->
</section> <!-- Section Testimonial End -->

<!-- Testimonial Area End -->

<!-- Team MEmber Start -->
<section id="team">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title">Il nostro <b> Team Members</b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->

            <div id="owl-demo" class="owl-carousel owl-theme team-items">
                
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/DeLucia.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Andrea De Lucia</h3>
                        <h5>Top Manager</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Alex.png" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Alessandro Longo</h3>
                        <h5>Project Manager</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Davide.png" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Davide De Chiara</h3>
                        <h5>Project Manager</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic2.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Dario Castellano</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Antonio Luca D'Avanzo</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic4.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Christian De Blasio</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic4.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Federico De Rosa</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Carlo Di Domenico</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Fabio Esposito</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Alina Korniychuk</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Pasquale Martiniello</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Fabiano Pecorelli</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Sergiy Shevchenko</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Giuseppina Tufano</h3>
                        <h5>Team Member</h5>
                    </div>
				</div>  <!-- item wrapper end -->
				<div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/pic5.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque. </p>
                            </div>
                        </div>
                        <h3>Elvira Zanin</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
            </div>
        </div>
    </div> <!-- Conatiner Team end -->
     </div> 

</section>  <!-- Section TEam End -->

<!-- Conatct Area Start-->

<section id="contact">
    <div class="container">
        <div class="row">
  			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title"> <b>Contattaci</b></h3>
                    <h4 class="feature_sub">Per qualsiasi informazione su SimplEx compila il modulo e verrai ricontattato. </h4>
                    <div class="divider"></div>
                </div>
  			</div>
        </div>
        <div class="row">
             <div class="contact_full">
                <div class="col-md-6 left">
                    <div class="left_contact">
                        <form action="role">
                            <div class="form-level">
                                <input name="name" placeholder="Il tuo nome" id="name"  value="" type="text" class="input-block">
                                <span class="form-icon fa fa-user"></span>
                            </div>
                            <div class="form-level">
                                <input name="email" placeholder="La tua email" id="mail" class="input-block" value="" type="email">
                                <span class="form-icon fa fa-envelope-o"></span>
                            </div>
                            <div class="form-level">
                                <input name="name" placeholder="Il tuo telefono" id="phone" class="input-block" value="" type="text">
                                <span class="form-icon fa fa-phone"></span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6 right">
                    <div class="form-level">
                        <textarea name="" id="messege"  rows="5" class="textarea-block" placeholder="Il messaggio per lo staff"></textarea>
                        <span class="form-icon fa fa-pencil"></span>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button class="btn btn-main featured">Invia</button>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="g-map" class="no-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="map" id="map"></div>
		</div>
	</div>
</div>

               

            </div>
        </div>
    </div>

    <div class="footer_b">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer_bottom">
                        <p class="text-block"> &copy; Copyright reserved to <span>SimplEx </span></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer_mid pull-right">
                        <ul class="social-contact list-inline">
                            <li> <a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li> <a href="#"><i class="fa fa-rss"></i></a></li>
                            <li> <a href="#"><i class="fa fa-google-plus"></i> </a></li>
                            <li><a href="#"> <i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"> <i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Footer Area End -->

<!-- Back To Top Button -->
    <div id="back-top">
        <a href="#slider_part" class="scroll" data-scroll>
            <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-up"></i></button>
        </a>
    </div>
    <!-- End Back To Top Button -->



<!-- Javascript Files
    ================================================== -->
    <!-- initialize jQuery Library -->

		<!-- initialize jQuery Library -->
        <!-- Main jquery -->
		    <script type="text/javascript" src="/assets/homepage/js/jquery.js"></script>
        <!-- Bootstrap jQuery -->
         <script src="/assets/homepage/js/bootstrap.min.js"></script>
        <!-- Owl Carousel -->
        <script src="/assets/homepage/js/owl.carousel.min.js"></script>
        <!-- Isotope -->
        <script src="/assets/homepage/js/jquery.isotope.js"></script>
        <!-- Pretty Photo -->
		    <script type="text/javascript" src="/assets/homepage/js/jquery.prettyPhoto.js"></script>
        <!-- SmoothScroll -->
        <script type="text/javascript" src="/assets/homepage/js/smooth-scroll.js"></script>
        <!-- Image Fancybox -->
        <script type="text/javascript" src="/assets/homepage/js/jquery.fancybox.pack.js?v=2.1.5"></script>
        <!-- Counter  -->
        <script type="text/javascript" src="/assets/homepage/js/jquery.counterup.min.js"></script>
        <!-- waypoints -->
        <script type="text/javascript" src="/assets/homepage/js/waypoints.min.js"></script>
        <!-- Bx slider -->
        <script type="text/javascript" src="/assets/homepage/js/jquery.bxslider.min.js"></script>
        <!-- Scroll to top -->
        <script type="text/javascript" src="/assets/homepage/js/jquery.scrollTo.js"></script>
        <!-- Easing js -->
        <script type="text/javascript" src="/assets/homepage/js/jquery.easing.1.3.js"></script>
   		 <!-- PrettyPhoto -->
        <script src="/assets/homepage/js/jquery.singlePageNav.js"></script>
      	<!-- Wow Animation -->
        <script type="/assets/homepage/js/javascript" src="/assets/homepage/js/wow.min.js"></script>
        <!-- Google Map  Source -->
        <script type="text/javascript" src="/assets/homepage/js/gmaps.js"></script>
			 <!-- Custom js -->
        <script src="/assets/homepage/js/custom.js"></script>
	     <script>
		// Google Map - with support of gmaps.js
     var map;
        map = new GMaps({
          div: '#map',
          lat: 40.7687158,
          lng: 14.7898292,
          scrollwheel: false,
          panControl: false,
          zoomControl: false,
        });

        map.addMarker({
          lat: 40.7687158,
          lng: 14.7898292,
          title: 'Smilebuddy',
          infoWindow: { 
            content: '<p> Smilebuddy, Dhanmondhi 27</p>'
          },
          icon: "/assets/homepage/images/map1.png"
        });
      	</script>
 
    </body>
</html>
