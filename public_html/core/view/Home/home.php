<?php
/**
 * La HomePage di SimplEx
 *
 * @author Alina Korniychuk
 * @version 1.0
 * @since 27/11/15
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
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
    <link rel="shortcut icon" href="/assets/homepage/images/simplexIcon.png"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/assets/homepage/css/bootstrap.min.css"/>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="/assets/homepage/css/font-awesome.min.css"/>
    <!-- Animation -->
    <link rel="stylesheet" href="/assets/homepage/css/animate.css"/>
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="/assets/homepage/css/owl.carousel.css"/>
    <link rel="stylesheet" href="/assets/homepage/css/owl.theme.css"/>
    <!-- Pretty Photo -->
    <link rel="stylesheet" href="/assets/homepage/css/prettyPhoto.css"/>
    <!-- Main color style -->
    <link rel="stylesheet" href="/assets/homepage/css/red.css"/>
    <!-- Template styles-->
    <link rel="stylesheet" href="/assets/homepage/css/custom.css"/>
    <!-- Responsive -->
    <link rel="stylesheet" href="/assets/homepage/css/responsive.css"/>
    <link rel="stylesheet" href="/assets/homepage/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen"/>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>
</head>

<body data-spy="scroll" data-target=".navbar-fixed-top">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<header id="section_header" class="navbar-fixed-top main-nav" role="banner">
    <div class="container">
        <!-- <div class="row"> -->
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
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

                <li><a href="#service" class="page-scroll">Lavoro svolto</a></li>
                <li><a href="#portfolio" class="page-scroll">Chi siamo</a></li>
                <li><a href="#team" class="page-scroll">Il nostro Team </a></li>
                <li><a href="#about" class="page-scroll">Preview </a></li>
                <li><a href="#contact" class="page-scroll">Contattaci</a></li>
                <li><a href="/auth"
                       class="page-scroll"><?php

                        echo (@$_SESSION['loggedin']) ? ("Home " . $_SESSION['user']->getTipologia()) : "Login"; ?></a>
                </li>
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

                        <h3 class="animated2">More <b> Exam</b></h3>

                        <div class="line"></div>
                        <p class="animated3">way to success</p>
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
                        <p class="animated2">Nature is the art of God</p>
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

                        <h3 class="animated3"> Simple <b>Exam</b></h3>

                        <div class="line"></div>
                        <p class="animated2"> best choice for you</p>
                    </div>
                </div>
            </div>

        </div>     <!-- End Carousel Inner -->

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
                    <h4 class="feature_sub">L’obiettivo del progetto &egrave; stato quello di apportare all'<b>Universit&agrave;
                            degli studi di Salerno</b>, in particolare al <b>dipartimento di Informatica</b>,
                        un beneficio dal punto di vista dei costi (risparmiando sull’acquisto di carta) e
                        dell'efficienza.
                        <br>Il docente ha la possibilità di creare facilmente dei test, sia a carattere esercitativo
                        che valutativo, inserendo sia domande a risposta multipla che
                        domande a risposta aperta. Il sistema, nel caso di test con domande a risposta multipla, é in
                        grado di valutare la prova sulla base delle risposte corrette
                        segnalate dal docente. In questo modo il docente, e gli stessi studenti, hanno la possibilit&agrave;
                        di conoscere quasi in tempo reale il risultato dei test.
                            Inoltre lo studente ha la possibilità di valutare al meglio il proprio studio ed eventualmente
                        venire incontro alle proprie carenze attraverso le esercitazioni proposte dal docente.
                        <br>Il sistema &egrave; capace di gestire più corsi contemporaneamente. La gestione dei corsi
                        comprende anche la possibilità di condurre esercitazioni ed esami relativi
                        a quest’ultimi. Ogni utente avr&agrave; a disposizione una serie di esercitazioni che aiuteranno
                        nella comprensione degli argomenti e l’accompagneranno di volta in volta verso
                        il conseguimento dell’esame. Questa &egrave; una caratteristica fondamentale del sistema: <b>
                            semplificare ed incentivare lo studente</b>.</h4>

                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
        </div>
        <div class="row">
            <div class="main_feature text-center">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="feature_content">
                        <a href="http://5.9.123.184/Documentazione/RAD.pdf" target="_black">  <i class="fa fa-pencil"></i>
                            <h5>RAD</h5></a>

                        <p><b>Requirement Analysis Document</b>.<br> Documento di analisi dei requisiti funzionali e non funzionali del sistema software <b>SimplEx</b>.</p>

                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="feature_content">
                        <a href="ftp://5.9.123.184/Documentazione/SDD.pdf" target="_black">  <i class="fa fa-pencil"></i>
                            <h5>SDD</h5></a>

                        <p><b>System Design Document</b>.<br> Documento di specifica degli obiettivi di design del sistema software <b>SimplEx</b>. </p>

                    </div>
                </div> <!-- Col-md-4 Single_feature End -->
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="feature_content">
                        <a href="http://5.9.123.184/Documentazione/ODD.pdf" target="_black"> <i class="fa fa-pencil"></i> <h5>ODD</h5></a></li>


                        <p><b>Object Design Document</b>.<br> Documento che descrive gli oggetti di design.</p>

                    </div>
                </div> <!-- Col-md-4 Single_feature End -->
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="feature_content">
                        <a href="http://5.9.123.184/Documentazione/TestPlan.pdf" target="_black"> <i class="fa fa-pencil"></i>
                        <h5>Test Plan</h5></a>

                        <p>Documento contenente il <b>piano di test</b> previsto per il sistema software <b>SimplEx</b>.</p>

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
                                <div class="graph-left-half"></div>
                            </div>
                        </div>
                        <div class="graph-right-side">
                            <div class="graph-right-container">
                                <div class="graph-right-half"></div>
                            </div>
                        </div>
                        <i class="fa fa-envelope-o fa-3x fw"></i>

                        <div class="facts-wrap-num">
                            <span class="counter">1200</span>
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
                                <div class="graph-left-half"></div>
                            </div>
                        </div>
                        <div class="graph-right-side">
                            <div class="graph-right-container">
                                <div class="graph-right-half"></div>
                            </div>
                        </div>
                        <i class="fa fa-weixin fa-3x fw"></i>

                        <div class="facts-wrap-num"><span class="counter">10000</span></div>
                    </div>
                    <h6>Messaggi</h6>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6 columns">
                <div class="facts-wrap">
                    <div class="graph">
                        <div class="graph-left-side">
                            <div class="graph-left-container">
                                <div class="graph-left-half"></div>
                            </div>
                        </div>
                        <div class="graph-right-side">
                            <div class="graph-right-container">
                                <div class="graph-right-half"></div>
                            </div>
                        </div>
                        <i class="fa fa-group fa-3x fw"></i>

                        <div class="facts-wrap-num"><span class="counter">18</span></div>
                    </div>
                    <h6>Meeting</h6>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6 columns">
                <div class="facts-wrap">
                    <div class="graph">
                        <div class="graph-left-side">
                            <div class="graph-left-container">
                                <div class="graph-left-half"></div>
                            </div>
                        </div>
                        <div class="graph-right-side">
                            <div class="graph-right-container">
                                <div class="graph-right-half"></div>
                            </div>
                        </div>
                        <i class="fa fa-check-square-o fa-3x fw"></i>

                        <div class="facts-wrap-num"><span class="counter">1300</span></div>
                    </div>
                    <h6>Commit</h6>
                </div>
            </div>
        </div> <!-- Conatainer End -->
    </div>    <!-- Fact div ENd -->
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
                    <h4 class="feature_sub">Il sistema <b>SimplEx</b> &egrave; stato realizzato come progetto per l'esame di <b>Ingegneria del software</b>, questo sistema &egrave; stato sviluppato da un gruppo di studenti dell'<b>Universita degli Studi di Salerno</b> del <b>dipartimento di Informatica</b>. </h4>

                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
        </div>
    </div>

</section>  <!-- Portfolio Section End -->



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
                        <img class="img-circle" src="/assets/homepage/images/team/DeLucia.jpg" alt="testimonial">
                    </div>
                    <div class="testimonial-content">
                        <h3 class="name">Professore Andrea De Lucia <span><b>Top Manager</b></span></h3>

                        <p class="testimonial-text">
                            La mia attivit&agrave; didattica &egrave; incentrata sull'<b>Ingegneria del Software</b>, coerentemente alla mia attivit&agrave; di ricerca.
                            Il mio obiettivo è da sempre quello di trasferire agli studenti i principi, i metodi e gli strumenti per lo sviluppo, l'evoluzione e la gestione del software, fornendo allo stesso tempo esperienze pratiche significative (tipicamente nell'ambito di un progetto), che potranno essere utili quando entreranno nel mondo del lavoro.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-thumb">
                        <img class="img-circle" src="/assets/homepage/images/team/Alex.png" alt="testimonial">
                    </div>
                    <div class="testimonial-content">
                        <h3 class="name">Alessandro Longo <span><b>Project Manager</b></span></h3>

                        <p class="testimonial-text">
                            Sono uno studente della laurea magistrale in <b>IT & Management</b> dell'<b>Università degli Studi di Salerno</b>.
                            Questa Magistrale mi ha aperto a nuove prospettive,
                            come il <b>Project Management</b> che coniugato con l'<b>Ingegneria del Software</b> rappresenta un trampolino di lancio nel mondo
                            del lavoro. Da sempre ricoprono incarichi di responsabilità, ad ogni livello e mi ritrovo a coniugare spesso le
                            esigenze di diverse persone. Prossimo obiettivo è il conseguimento della certificazione CAPM e della laurea Magistrale.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-thumb">
                        <img class="img-circle" src="/assets/homepage/images/team/Davide.png" alt="testimonial">
                    </div>
                    <div class="testimonial-content">
                        <h3 class="name wow bounceInLeft">Davide De Chiara<span><b>Project Manager</b></span></h3>

                        <p class="testimonial-text">
                            Sono uno studente della laurea magistrale in <b>Tecnologie Informatiche e Management</b> dell’<b>Università degli Studi di Salerno</b>,
                            da quando ho conosciuto il mondo dell’<b>Ingegneria del Software</b> non ne ho potuto più fare a meno, &egrave; diventata la mia passione
                            che mi ha portato a ottenere tante belle soddisfazioni. Il mio obiettivo è rapportarmi a realt&agrave; che mi consentano di
                            sfruttare al meglio le mie competenze e capacit&agrave; relazionali, nonché la mia predisposizione al lavoro di squadra e al
                            problem-solving.
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
                    <h4 class="feature_sub">Tutti i membri del progetto. </h4>

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
                                    <li><a href="https://www.facebook.com/andrea.delucia.5686?fref=ts"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://plus.google.com/u/0/116598927567654271356/posts"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAkAAADyWAMBD27_vJoLSc5XNrmdA7RtLp9wPLA&authType=NAME_SEARCH&authToken=5V0u&locale=it_IT&trk=tyah&trkInfo=clickedVertical%3Amynetwork%2CclickedEntityId%3A15882243%2CauthType%3ANAME_SEARCH%2Cidx%3A1-1-1%2CtarId%3A1450817493260%2Ctas%3Aandrea%20de%20lucia"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p> Top Manager</p>
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
                                    <li><a href="https://github.com/alexl87"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://plus.google.com/u/0/105812069876884913820/posts"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=ADEAAAhAnPcBaq_rcApOeZSw2VTlFE3j7TO_1Hw&authType=NAME_SEARCH&authToken=I1n9&locale=it_IT&srchid=4674249261450817344258&srchindex=1&srchtotal=104&trk=vsrp_people_res_name&trkInfo=VSRPsearchId%3A4674249261450817344258%2CVSRPtargetId%3A138452215%2CVSRPcmpt%3Aprimary%2CVSRPnm%3Atrue%2CauthType%3ANAME_SEARCH"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p> Project Manager</p>
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
                                    <li><a href="https://github.com/D4v1de"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://plus.google.com/u/0/107433973753755438977/posts"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAkAAA7wPCUBSBZYb7M0n6mXsh1rIm7KveZu348&authType=NAME_SEARCH&authToken=tjFv&locale=it_IT&trk=tyah&trkInfo=clickedVertical%3Amynetwork%2CclickedEntityId%3A250625061%2CauthType%3ANAME_SEARCH%2Cidx%3A1-1-1%2CtarId%3A1450817378306%2Ctas%3Adavide%20de%20chiara"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p> Project Manager</p>
                            </div>
                        </div>
                        <h3>Davide De Chiara</h3>
                        <h5>Project Manager</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Dario.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/dariocast"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://www.google.com/+DarioCastellano94"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=" https://www.linkedin.com/in/dario-castellano-4aa617100"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Tester </p>
                            </div>
                        </div>
                        <h3>Dario Castellano</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Luca.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/AntonioLuca"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://www.facebook.com/antonioluca.davanzo?fref=ts"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAkAABwB25sB6LTa4ABFitFa8KhmDWMFr3SeXiU&authType=NAME_SEARCH&authToken=0rco&locale=it_IT&trk=tyah&goback="><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Software Developer</p>
                            </div>
                        </div>
                        <h3>Antonio Luca D'Avanzo</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Christian.jpg" alt="" class="img-responsive">
                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=" https://github.com/christian161291"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href=" https://www.facebook.com/christian.deblasio.16"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/preview?vpa=pub&locale=it_IT"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p> IT Architect</p>
                            </div>
                        </div>
                        <h3>Christian De Blasio</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Fede.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=" https://github.com/fede3ro"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAIAABvcVqEBUXXbZCjzwBl07ooQcs0buNEk8YQ&trk=nav_responsive_tab_profile"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Liaison and Software Developer</p>
                            </div>
                        </div>
                        <h3>Federico De Rosa</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Carlo.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href=" https://github.com/chardido"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://it.linkedin.com/in/carlo-di-domenico-651658110"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Software Developer</p>
                            </div>
                        </div>
                        <h3>Carlo Di Domenico</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Fabio.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/fabesp1994"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href=" https://plus.google.com/u/0/?hl=it"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                                <p>Software Developer</p>
                            </div>
                        </div>
                        <h3>Fabio Esposito</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Alina.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/alert22"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://plus.google.com/u/0/117270428071805224670/posts"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAIAABvcVp4BSdMe_XvYyATRQ1B-jO-_nHISiSs&trk=nav_responsive_tab_profile_pic"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Front-end Developer and Tester</p>
                            </div>
                        </div>
                        <h3>Alina Korniychuk</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Pasquale.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/PasqualeMartiniello"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://it.linkedin.com/in/pasquale-martiniello-651129111"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Software Developer</p>
                            </div>
                        </div>
                        <h3>Pasquale Martiniello</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Fabiano.png" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/fabianopecorelli"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://plus.google.com/u/0/110805340083652923912"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="https://www.linkedin.com/profile/view?id=AAIAABvcTB4BBQnZ-h5XKhjYQpHS83kKsVuY560"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Graphic Designer and Software Developer</p>
                            </div>
                        </div>
                        <h3>Fabiano Pecorelli</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Sergio.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/mrneutro"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://it.linkedin.com/in/sergey-shevchenko-b6122353"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Access and Security Manager</p>
                            </div>
                        </div>
                        <h3>Sergiy Shevchenko</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Giusy.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/giusytufano"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href=" https://plus.google.com/108198214576312534670/posts"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/giusy-tufano-b42884110"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Tester</p>
                            </div>
                        </div>
                        <h3>Giuseppina Tufano</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
                <div class="item text-center">
                    <div class="single-member">
                        <div class="overlay-hover">
                            <img src="/assets/homepage/images/team/Elvira.jpg" alt="" class="img-responsive">

                            <div class="overlay-effect">
                                <ul class="social list-inline">
                                    <li><a href="https://github.com/elvis1994"><i class="fa fa-github-square"></i></a></li>
                                    <li><a href="https://www.facebook.com/ElviraZanin"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://it.linkedin.com/in/elvira-zanin-330893110"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                                <p>Database Manager, Requirements Manager and Tester</p>
                            </div>
                        </div>
                        <h3>Elvira Zanin</h3>
                        <h5>Team Member</h5>
                    </div>
                </div>  <!-- item wrapper end -->
            </div>
        </div>
    </div> <!-- Conatiner Team end -->

</section>  <!-- Section TEam End -->

<!-- About us start -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title">Preview di <b>SimplEx</b></h3>
                    <h4 class="feature_sub">Di seguito un'anteprima di SimplEx. </h4>

                    <div class="divider"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="feature-tab">
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <ul class="nav nav-tabs main-tab-list text-center" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                </div>
                                <h4>Web</h4>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                </div>
                                <h4>Home docente</h4>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile1" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                </div>
                                <h4>Home studente</h4>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile2" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                </div>
                                <h4>Creazione test</h4>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile3" role="tab" data-toggle="tab">
                                <div class="single-tab">
                                    <div class="f-icon">
                                        <i class="fa fa-laptop"></i>
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
                                <img src="/assets/homepage/images/about/web2.jpg" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-12 col-sm-9">
                                <div class="c-tab">
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="col-md-12 col-sm-9">
                                <img src="/assets/homepage/images/about/HomeDocente.png" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-12 col-sm-9">
                                <div class="c-tab">
                                    <h4>La pagina Home del Docente</h4>

                                    <p>La Home del Docente mostra la lista dei corsi da lui tenuti. Una volta selezionato un corso specifico viene visualizzata la pagina con tutte le sessioni, i test e gli argomenti del relativo corso. Inoltre da qui il Docente ha la possibilit&agrave; di accedere a tutti i corsi di laurea dell'ateneo.</p>
                                    <br>


                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile1">
                            <div class="col-md-12 col-sm-9">
                                <img src="/assets/homepage/images/about/homestudente.png" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-12 col-sm-9">
                                <div class="c-tab">
                                    <h4>La pagina Home dello Studente</h4>

                                    <p>La Home dello Studente mostra la lista di tutti i corsi da lui seguiti. Una volta selezionato un corso, lo Studente ha la possibilita di visualizzare le sessioni con i relativi test. Inoltre da qui lo Studente ha la possibilità di visulizzare tutti i corsi di Laurea dell'ateneo e di conseguenza inscriversi.</p>
                                    <br>


                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile2">
                            <div class="col-md-12 col-sm-9">
                                <img src="/assets/homepage/images/about/creaTest.png" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-12 col-sm-9">
                                <div class="c-tab">
                                    <h4>La pagina di creazione test</h4>

                                    <p>In questa pagina il Docente ha la possibilità di creare un test in modo manuale o in automatico, ovvero lasciando che le domande vengano scelte casualmente.</p>
                                    <br>

                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile3">
                            <div class="col-md-12 col-sm-9">
                                <img src="/assets/homepage/images/about/eseguitest.png" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-12 col-sm-9">
                                <div class="c-tab">
                                    <h4>La pagina di esecuzione test</h4>

                                    <p>Lo Studente ha la possibilità di partecipare ad una sessione, rispondendo alle domande contenute nel test assegnatogli..</p>
                                    <br>

                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</section>
<!-- About us End -->
<div class="clearfix"></div>
<!-- Contact Area Start-->

<script>
    function goBack()
    {
        window.history.back()
    }
</script>



<?php

$my_email = "alinakim@libero.it"; //il mio indirizzo
$flag= false;

if (isset($_REQUEST['email'])) {
    //send email
    $email = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];
    $name = $_REQUEST['name'];

   if ($subject == "") {
        $errore = "Inserire il numero di telefono!";
        echo "<script type='text/javascript'>alert('$errore');</script>";
    }
    else if ($message == "") {
        $errore = "Inserire il testo da inviare!";
        echo "<script type='text/javascript'>alert('$errore');</script>";

    }
    else if ($name == "") {
        $errore = "Inserire il tuo nome!";
        echo "<script type='text/javascript'>alert('$errore');</script>";

    }else {

        $subject = $name . $subject;

       if(mail($my_email, $subject, $message, "From:" . $email)==true){
           $invio = "L'email è stata inviata!";
           echo "<script type='text/javascript'>alert('$invio');</script>";
       }else{
           $invio = "L'email non è stata inviata!";
           echo "<script type='text/javascript'>alert('$invio');</script>";
       }
    }
}
if($flag==false){
    echo"<form method='post' action='/'>
    <section id='contact'>
      <div class='container'>
        <div class='row'>
  			<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='feature_header text-center'>
                    <h3 class='feature_title'> <b>Contattaci</b></h3>
                    <h4 class='feature_sub'>Per qualsiasi informazione su SimplEx compila il modulo e verrai ricontattato. </h4>
                    <div class='divider'></div>
                </div>
  			</div>
        </div>
        <div class='row'>
             <div class='contact_full'>
                <div class='col-md-6 left'>
                    <div class='left_contact'>
                        <form action='role'>
                            <div class='form-level'>
                                <input name='name' placeholder='Il tuo nome' id='name'  value='' type='text' class='input-block'>
                                <span class='form-icon fa fa-user'></span>
                            </div>
                            <div class='form-level'>
                                <input name='email' placeholder='La tua email' id='mail' class='input-block' value='' type='email'>
                                <span class='form-icon fa fa-envelope-o'></span>
                            </div>
                            <div class='form-level'>
                                <input name='subject' placeholder='Il tuo telefono' id='phone' class='input-block' value='' type='text'>
                                <span class='form-icon fa fa-phone'></span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class='col-md-6 right'>
                    <div class='form-level'>
                        <textarea name='message' id='messege'  rows='5' class='textarea-block' placeholder='Il messaggio per lo staff'></textarea>
                        <span class='form-icon fa fa-pencil'></span>
                    </div>
                </div>
                <div class='col-md-12 text-center'>
                    <input type='submit' class='btn btn-main featured' value='Invio'>
                </div>
            </div>
        </div>
    </div>
</section>";
}
?>

<div id="g-map" class="no-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="map" id="map"></div>
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
                        <li><a href="https://github.com/D4v1de/SimplEx"><i class="fa fa-github-square"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

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
        lat: 40.774706,
        lng: 14.789771,
        scrollwheel: false,
        panControl: false,
        zoomControl: false
    });

    map.addMarker({
        lat: 40.774706,
        lng: 14.789771,
        title: 'Dipartimento di Informatica, Sesa Lab',
        infoWindow: {
            content: '<p>Via Ponte don Melillo, 132,84084 Fisciano SA</p>'
        },
        icon: "/assets/homepage/images/map1.png"
    });
</script>

</body>
</html>
