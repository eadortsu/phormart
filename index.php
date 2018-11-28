<?php require_once 'inc/functions.php';
$info = select('settings', '*', "lang_id = '1'", '', '1');
$info = mysqli_fetch_assoc($info);
?>
<!doctype html>
<html lang="zxx">


<!-- Mirrored from exill.tn/demo/flexi_html/template/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Nov 2018 14:23:25 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Title -->
    <title>
        <?= $info['application_name'] ?>
    </title>

    <meta name="keywords"
          content="phormart,P.O.P Ceiling, Well Skimming, Plaster Board Installation, Arc Designing, Pillar works, Painting, Wallpaper, Interior & Exterior Decoration"/>

    <meta name="author" content="eadortsu"/>
    <meta name="title" content="<?= $info['application_name'] ?>"/>

    <meta name="robots" content=""/>


    <meta property="og:title" content="<?= $info['application_name'] ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content="img/header-area.jpg"/>
    <meta property="image" content="img/header-area.jpg"/>

    <meta property="og:description"
          content="We render special services in P.O.P Ceiling, Well Skimming, Plaster Board Installation, Arc Designing, Pillar works, Painting, Wallpaper, Interior & Exterior Decoration, etc."/>
    <meta property="og:locale" content="en_GB"/>
    <meta property="og:locale:alternate" content="fr_FR"/>
    <meta property="og:locale:alternate" content="es_ES"/>
    <meta property="og:site_name" content="Phormart Ventures"/>


    <!-- Description -->
    <meta name="description"
          content="We render special services in P.O.P Ceiling, Well Skimming, Plaster Board Installation, Arc Designing, Pillar works, Painting, Wallpaper, Interior & Exterior Decoration, etc.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
    <!-- CSS Assets -->
    <link rel="stylesheet" href="css/bootstrap-custom.min.css">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400%7CPoppins:300,400,500,600,700%7CRaleway:300,400,500,600,700,800"
          rel="stylesheet">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/hamburgers-custom.min.css">
    <link rel="stylesheet" href="css/lity.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/colors/main-cyan.css" id="color-scheme">
    <!--removeIf(delDemoTool)-->
    <!-- inject:demoToolCSS:css -->
    <link rel="stylesheet" href="https://exill.tn/demo/flexi_html/demo_tool/demo-tool.css">
    <!-- endinject -->
    <!--endRemoveIf(delDemoTool)-->
</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-section preloader-right">
    </div>
    <div class="preloader-section preloader-left">
    </div>
    <div class="preloader-icon">
        <span class="loading-dot loading-dot-1"></span>
        <span class="loading-dot loading-dot-2"></span>
        <span class="loading-dot loading-dot-3"></span>
    </div>
</div>
<header>
    <!-- Navbar Area -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand logo-scrolled" style="display: none;" data-scroll href="#header-area"><img
                        style="width: 200px;" src="img/logo-dark.png"></a>
            <a class="navbar-brand logo-unscrolled" data-scroll href="#header-area"><img style="width: 200px;"
                                                                                         src="img/logo-ligth2.png"></a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="nav-btn">Menu</span>
            </button>
            <div class="d-flex flex-row  order-0 order-lg-1">
                <div class="navbar-nav flex-row">
                    <button id="navBtn" class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
            <div id="navbarSupportedContent" class="collapse navbar-collapse order-1 order-lg-0">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#header-area">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-area">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services-area">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio-area">Portfolio</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#testimonials-area">Clients</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/contact">Contact</a>
                    </li>
                </ul>
            </div>
            <div style="display: none!important;" class="sidebar" id="sidebar">
                <button id="sidebarBtn" class="hamburger hamburger--slider is-active" type="button">
                        <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                        </span>
                </button>
                <div class="about-me">
                    <img class="img-fluid img-thumbnail d-block mx-auto avatar" src="img/sidebar-avatar.jpg"
                         alt="About me">
                    <address>
                        <ul class="list-unstyled">
                            <li>
                                <span>Name</span>
                                <p>Daniel Smith</p>
                            </li>
                            <li>
                                <span>Curriculum Vitae</span>
                                <p><a href="#0">Download CV</a></p>
                            </li>
                            <li>
                                <span>Skills</span>
                                <p>Photoshop, JavaScript, PHP, HTML/CSS, Python, Node.js</p>
                            </li>
                            <li>
                                <span>Email</span>
                                <p><a href="mailto:daniel@example.com">daniel@example.com</a></p>
                            </li>
                            <li>
                                <span>Address</span>
                                <p>4155 Mann Island, Liverpool L3, United Kingdom.</p>
                            </li>
                            <li>
                                <span>Age</span>
                                <p>21</p>
                            </li>
                            <li>
                                <span>Date of Birth</span>
                                <p>24 September 1996</p>
                            </li>
                            <li>
                                <span>Phone</span>
                                <p><a href="tel:+441632967704">+44 1632 967704</a></p>
                            </li>
                            <li>
                                <span>Residence</span>
                                <p>UK</p>
                            </li>
                            <li>
                                <span>Freelance Status</span>
                                <p>Available</p>
                            </li>
                        </ul>
                    </address>
                    <div class="social-medias">
                        <a href="#0">
                            <i class="icon ion-logo-twitter"></i>
                        </a>
                        <a href="#0">
                            <i class="icon ion-logo-instagram"></i>
                        </a>
                        <a href="#0">
                            <i class="icon ion-logo-linkedin"></i>
                        </a>
                        <a href="#0">
                            <i class="icon ion-logo-youtube"></i>
                        </a>

                        <a href="#0">
                            <i class="icon ion-logo-facebook"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Header Area (Home) -->
    <section class="header-area section-fixed-bg section-overlay-bg" id="header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-lg-8 home-content text-center">
                    <h5 class="greet">Hello, welcome to <b>Phormart Ventures</b></h5>
                    <h1 class="skills cd-headline clip">We do
                        <span class="cd-words-wrapper single-skill">
                             <b class="is-visible">P.O.P Ceiling</b>
                             <b>Well Skimming</b>
                             <b>Wallpaper</b>
                             <b>Painting</b>
                             <b>Deco</b>
                          </span>
                    </h1>
                    <p class="description">We render special services in P.O.P Ceiling, Well Skimming, Plaster Board
                        Installation, Arc Designing, Pillar works, Painting, Wallpaper, Interior & Exterior Decoration,
                        etc. </p>
                    <a class="btn work" data-scroll href="#portfolio-area" role="button">Our Work</a>
                    <a class="btn hire button-scheme" data-scroll href="#contact-area" role="button">Hire Us</a>
                </div>
                <div class="scroll-icon">
                    <a data-scroll href="#about-area">
                        <div class="mouse">
                            <div class="wheel"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</header>
<!-- About Area -->
<section class="single-section about-area" id="about-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5">
                        <img class="img-fluid img-thumbnail about-img" src="img/1.jpg" alt="About Picture">
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="content-block">
                            <h2 class="about-title">About Us</h2>
                            <h6 class="about-role"><!--I am a Full-Stack Web Developer--></h6>
                            <p class="about-description">We render special services in P.O.P Ceiling, Well Skimming,
                                Plaster Board Installation, Arc Designing, Pillar works, Painting, Wallpaper, Interior &
                                Exterior Decoration, etc.</p>
                            <p class="about-description last"> </p>
                            <!-- <address>
                                 <ul class="list-inline about-info">
                                     <li class="list-inline-item">
                                         <span>Name:</span>
                                         <p>Daniel Smith</p>
                                     </li>
                                     <li class="list-inline-item">
                                         <span>Email:</span>
                                         <p><a href="mailto:daniel@example.com">daniel@example.com</a></p>
                                     </li>
                                     <li class="list-inline-item mb-0">
                                         <span>Age:</span>
                                         <p>21</p>
                                     </li>
                            <li class="list-inline-item mb-0">
                                <span>From:</span>
                                <p>Liverpool, United Kingdom</p>
                            </li>
                            </ul>
                            </address>-->
                            <!-- <a class="btn button-scheme" href="#0" role="button">Download CV</a>
                            --><!-- <button type="button" class="btn button-outline details">More Details</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Area -->
<section class="single-section silver-bg services-area" id="services-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h2 class="section-title">Services</h2>
                    <p class="section-description">We render a wide range of services including but not limited to the
                        fallowing</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-service">
                    <i class="icon ion-md-rocket"></i>
                    <div class="service-body">
                        <h6 class="service-title">P.O.P Ceiling</h6>
                        <p class="service-description"></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-service">
                    <i class="icon ion-md-heart-half"></i>
                    <div class="service-body">
                        <h6 class="service-title">Well Skimming</h6>
                        <p class="service-description"></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-service">
                    <i class="icon ion-md-images"></i>
                    <div class="service-body">
                        <h6 class="service-title">Plaster Board</h6>
                        <p class="service-description"></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-service mb-lg-0">
                    <i class="icon ion-md-color-palette"></i>
                    <div class="service-body">
                        <h6 class="service-title">Arc Designing</h6>
                        <p class="service-description"></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-service mb-md-0">
                    <i class="icon ion-logo-wordpress"></i>
                    <div class="service-body">
                        <h6 class="service-title">Pillar Works</h6>
                        <p class="service-description"></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-service mb-0">
                    <i class="icon ion-md-move"></i>
                    <div class="service-body">
                        <h6 class="service-title">Painting & Wellpaper</h6>
                        <p class="service-description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hire Area -->
<section class="single-section section-fixed-bg section-overlay-bg hire-area" id="hire-area">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="hire-title">Let's Work Together!</h1>
                <p class="hire-description">I am available for freelance projects. Hire me and get your project
                    done.</p>
                <a class="btn hire" data-scroll href="#contact-area" role="button">Hire Me</a>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Area -->
<section class="single-section portfolio-area" id="portfolio-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h2 class="section-title">Portfolio</h2>
                    <p class="section-description">Check out some of our works</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <ul class="list-inline filter-control d-flex justify-content-center" role="group"
                    aria-label="Filter Control">

                    <li class="list-inline-item tab-active" data-group="all">All</li>
                    <?php $gallery_categories = select('gallery_categories', 'name');
                    foreach ($gallery_categories as $gallery_category) {
                        ?>

                        <li class="list-inline-item"
                            data-group="<?= $gallery_category['name'] ?>"><?= $gallery_category['name'] ?></li>

                    <?php } ?>
                </ul>
                <div class="shufflejs" id="shufflejs">

                    <?php $galleries = select('photos');
                    foreach ($galleries as $gallery) {

                        $cart_id = $gallery['category_id'];
                        $cart = select('gallery_categories', 'name', "id = '$cart_id'");
                        $cart = mysqli_fetch_assoc($cart);
                        ?>


                        <div class="js-item col-6 col-lg-4" data-groups='["<?= $cart['name'] ?>"]'>
                            <div class="item-overlay">
                                <img class="img-fluid" alt="Item" src="blog/<?= $gallery['path_small'] ?>">
                                <div class="overlay-content">
                                    <h6 class="overlay-title"><?= $gallery['title'] ?></h6>
                                    <div class="overlay-icons">
                                        <a class="popup-item" href="blog/<?= $gallery['path_big'] ?>" data-lity>
                                            <i class="icon ion-md-eye"></i>
                                        </a>
                                        <a href="#0">
                                            <i class="icon ion-md-link"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- <div class="js-item col-6 col-lg-4" data-groups='["photos"]'>
                         <div class="item-overlay">
                             <img class="img-fluid" alt="Item" src="img/item-2.jpg">
                             <div class="overlay-content">
                                 <h6 class="overlay-title">Anime Art</h6>
                                 <div class="overlay-icons">
                                     <a class="popup-item" href="img/item-2.jpg" data-lity>
                                         <i class="icon ion-md-eye"></i>
                                     </a>
                                     <a href="#0">
                                         <i class="icon ion-md-link"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="js-item col-6 col-lg-4" data-groups='["design"]'>
                         <div class="item-overlay">
                             <img class="img-fluid" alt="Item" src="img/item-3.jpg">
                             <div class="overlay-content">
                                 <h6 class="overlay-title">Exhibition</h6>
                                 <div class="overlay-icons">
                                     <a class="popup-item" href="img/item-3.jpg" data-lity>
                                         <i class="icon ion-md-eye"></i>
                                     </a>
                                     <a href="#0">
                                         <i class="icon ion-md-link"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="js-item col-6 col-lg-4 mb-lg-0" data-groups='["brand"]'>
                         <div class="item-overlay">
                             <img class="img-fluid" alt="Item" src="img/item-4.jpg">
                             <div class="overlay-content">
                                 <h6 class="overlay-title">Business Card</h6>
                                 <div class="overlay-icons">
                                     <a class="popup-item" href="img/item-4.jpg" data-lity>
                                         <i class="icon ion-md-eye"></i>
                                     </a>
                                     <a href="#0">
                                         <i class="icon ion-md-link"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="js-item col-6 mb-0 col-lg-4 mb-lg-0" data-groups='["brand"]'>
                         <div class="item-overlay">
                             <img class="img-fluid" alt="Item" src="img/item-5.jpg">
                             <div class="overlay-content">
                                 <h6 class="overlay-title">Folder</h6>
                                 <div class="overlay-icons">
                                     <a class="popup-item" href="img/item-5.jpg" data-lity>
                                         <i class="icon ion-md-eye"></i>
                                     </a>
                                     <a href="#0">
                                         <i class="icon ion-md-link"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="js-item col-6 mb-0 col-lg-4 mb-lg-0" data-groups='["photos"]'>
                         <div class="item-overlay">
                             <img class="img-fluid" alt="Item" src="img/item-6.jpg">
                             <div class="overlay-content">
                                 <h6 class="overlay-title">Final Fantasy Cosplay</h6>
                                 <div class="overlay-icons">
                                     <a class="popup-item" href="img/item-6.jpg" data-lity>
                                         <i class="icon ion-md-eye"></i>
                                     </a>
                                     <a href="#0">
                                         <i class="icon ion-md-link"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
 -->

                    <div class="col-6 col-lg-4 sizer-element"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Area -->
<section style="display: none !important;" class="single-section section-fixed-bg section-overlay-bg testimonials-area" id="testimonials-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading only-title">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="owl-carousel owl-theme">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="single-review text-center">
                        <i class="icon ion-md-quote quote-icon"></i>
                        <p class="client-review">Daniel did an excellent job, creative, addressing my request, and also
                            providing his own graphic insight. Quick and professional. I would highly recommend, and
                            also will use again!</p>
                        <div class="flex-row client-details">
                            <div class="media justify-content-center">
                                <img src="img/client-1.jpg" alt="Client" class="img-fluid rounded-circle client-avatar">
                                <div class="align-self-center">
                                    <h6 class="client-name">Julia Sakura</h6>
                                    <span class="client-role">Envato Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="single-review text-center">
                        <i class="icon ion-md-quote quote-icon"></i>
                        <p class="client-review">Daniel did an excellent job, creative, addressing my request, and also
                            providing his own graphic insight. Quick and professional. I would highly recommend, and
                            also will use again!</p>
                        <div class="flex-row client-details">
                            <div class="media justify-content-center">
                                <img src="img/client-2.jpg" alt="Client" class="img-fluid rounded-circle client-avatar">
                                <div class="align-self-center">
                                    <h6 class="client-name">John Santana</h6>
                                    <span class="client-role">Entrepreneur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="single-review text-center">
                        <i class="icon ion-md-quote quote-icon"></i>
                        <p class="client-review">Daniel did an excellent job, creative, addressing my request, and also
                            providing his own graphic insight. Quick and professional. I would highly recommend, and
                            also will use again!</p>
                        <div class="flex-row client-details">
                            <div class="media justify-content-center">
                                <img src="img/client-3.jpg" alt="Client" class="img-fluid rounded-circle client-avatar">
                                <div class="align-self-center">
                                    <h6 class="client-name">Maria Wilson</h6>
                                    <span class="client-role">Envato Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Area -->

<section style="display: none !important;" class="single-section blog-area" id="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h2 class="section-title">My Blog</h2>
                    <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Ratione!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <a href="#0">
                        <img class="card-img-top" src="img/post-1.jpg" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="#0">
                            <h5 class="card-title">5 tips for Photographers</h5>
                        </a>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, porro rem
                            quod illo quam, eum alias id, repellendus magni, quas.</p>
                        <div class="media post-summary">
                            <a class="align-self-center" href="#0">
                                <img src="img/sidebar-avatar.jpg" alt="Author"
                                     class="img-fluid rounded-circle author-avatar">
                            </a>
                            <div class="media-body align-self-center">
                                <a href="#0">
                                    <h6 class="author-name">Daniel Smith</h6>
                                </a>
                                <span class="post-date">15 Aug 18</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <a href="#0">
                        <img class="card-img-top" src="img/post-2.jpg" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="#0">
                            <h5 class="card-title">Take a tour of my office</h5>
                        </a>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, porro rem
                            quod illo quam, eum alias id, repellendus magni, quas.</p>
                        <div class="media post-summary">
                            <a class="align-self-center" href="#0">
                                <img src="img/avatar.jpg" alt="Author" class=" img-fluid rounded-circle author-avatar">
                            </a>
                            <div class="media-body align-self-center">
                                <a href="#0">
                                    <h6 class="author-name">Daniel Smith</h6>
                                </a>
                                <span class="post-date">8 Aug 18</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-0">
                    <a href="#0">
                        <img class="card-img-top" src="img/post-3.jpg" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="#0">
                            <h5 class="card-title">How i became a Web Designer</h5>
                        </a>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, porro rem
                            quod illo quam, eum alias id, repellendus magni, quas.</p>
                        <div class="media post-summary">
                            <a class="align-self-center" href="#0">
                                <img src="img/avatar.jpg" alt="Author" class=" img-fluid rounded-circle author-avatar">
                            </a>
                            <div class="media-body align-self-center">
                                <a href="#0">
                                    <h6 class="author-name">Daniel Smith</h6>
                                </a>
                                <span class="post-date">27 July 18</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Area -->
<section  class="single-section contact-area silver-bg" id="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h2 class="section-title">Get in Touch</h2>
                    <p class="section-description">We Would love to hear from you!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <!-- <form class="contact-form" id="contact-form" method="post"
                       action="blog/home/contact_post">
                     <h4 class="form-title">Message Me</h4>
                     <div class="row">
                         <div class="col-12 col-md-6 form-group">
                             <input type="text" name="name" class="form-control" id="contact-name" placeholder="Name"
                                    required>
                         </div>
                         <div class="col-12 col-md-6 form-group">
                             <input type="email" name="email" class="form-control" id="contact-email" placeholder="Email"
                                    required>
                         </div>
                         <div class="col-12 form-group">
                             <input type="text" name="subject" class="form-control" id="contact-subject"
                                    placeholder="Subject" required>
                         </div>
                         <div class="col-12 form-group custom-margin">
                             <textarea name="message" class="form-control" id="contact-message" placeholder="Message"
                                       rows="5" required></textarea>
                         </div>
                         <div class="col-12">
                             <button type="submit" class="btn button-scheme" id="contact-submit">Submit</button>
                             <p class="feedback-error">Oops! Something went wrong. Please try again.</p>
                         </div>
                     </div>
                 </form>
 -->
            </div>
            <div class="col-12 col-lg-5">
                <div class="contact-info">
                    <h4 class="info-title">Contact Info</h4>
                    <p class="info-description">Always available for freelance work if the right project comes along,
                        Feel free to contact me!</p>
                    <ul class="list-unstyled">
                        <li>
                            <div class="media align-items-center">
                                    <span class="info-icon">
                                    <i class="icon ion-md-map"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="info-type">Location</h6>
                                    <span class="info-details"><?= $info['contact_address'] ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media align-items-center">
                                    <span class="info-icon">
                                    <i class="icon ion-md-call"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="info-type">Call Me</h6>
                                    <span class="info-details"><a
                                                href="tel:<?= $info['contact_phone'] ?>"><?= $info['contact_phone'] ?></a></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media align-items-center">
                                    <span class="info-icon">
                                    <i class="icon ion-md-mail-unread"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="info-type">Email Me</h6>
                                    <span class="info-details"><a
                                                href="mailto:<?= $info['contact_email'] ?>"><?= $info['contact_email'] ?></a></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer Area -->
<footer class="footer-area single-section">
    <div class="container">
        <div class="row main-footer">
            <div class="col-12 col-md-8">
                <h5 class="column-title">Navigate</h5>
                <ul class="list-unstyled column-content">
                    <li style="display: inline;"><a data-scroll href="#header-area"> > Home </a></li>
                    <li style="display: inline;"><a data-scroll href="#services-area"> > Our Services </a></li>
                    <li style="display: inline;"><a data-scroll href="#portfolio-area"> > Portfolio </a></li>
                    <li style="display: inline;"><a data-scroll href="/blog"> > My Blog </a></li>
                </ul>
            </div>
            <!--  <div class="col-12 col-md-3">
                  <h5 class="column-title">Information</h5>
                  <ul class="list-unstyled column-content">
                      <li><a href="#0">Terms & Condition</a></li>
                      <li><a href="#0">Privacy Policy</a></li>
                      <li><a href="#0">Jobs</a></li>
                      <li><a href="#0">Partners</a></li>
                  </ul>
              </div>-->
            <!-- <div class="col-12 col-md-3">
                 <h5 class="column-title">Support</h5>
                 <ul class="list-unstyled column-content">
                     <li><a href="#0">Contact Us</a></li>
                     <li><a href="#0">FAQs</a></li>
                     <li><a href="#0">Report an issue</a></li>
                 </ul>
             </div>-->
            <div class="col-12 col-md-4">
                <h2 class="brand-logo"><img src="img/logo-ligth.png"></h2>
                <p class="brand-description"></p>
            </div>
        </div>
        <div class="row mini-footer">
            <div class="col-12">
                <div class="social-medias">
                    <a class="twitter" href="<?=$info['twitter_url']?>">
                        <i class="icon ion-logo-twitter"></i>
                    </a>
                    <a class="instagram" href="<?=$info['instagram_url']?>">
                        <i class="icon ion-logo-instagram"></i>
                    </a>
                    <a class="linkedin" href="<?=$info['linkedin_url']?>">
                        <i class="icon ion-logo-linkedin"></i>
                    </a>


                    <a class="facebook" href="<?=$info['facebook_url']?>">
                        <i class="icon ion-logo-facebook"></i>
                    </a>

                </div>
                <p class="copyright-notice">Copyright © <?= date('Y') ?> Phormart Ventures, all rights reserved.
                    Developed by <a href="https://solveitgh.com" target="_blank">SolveIT Solution</a>.</p>
            </div>
        </div>
    </div>
</footer>
<!--removeIf(delDemoTool)-->
<!-- inject:demoToolHTML:html -->


<!-- endinject -->
<!--endRemoveIf(delDemoTool)-->
<!-- JS Assets -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.nav.min.js"></script>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Set,Array.from,Object.assign,Array.prototype.find,Array.prototype.includes"></script>
<script src="js/shuffle.min.js"></script>
<script src="js/lity.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<!--removeIf(delDemoTool)-->
<!-- inject:demoToolJS:js -->
<script src="https://exill.tn/demo/flexi_html/demo_tool/demo-tool.js"></script>
<!-- endinject -->
<!--endRemoveIf(delDemoTool)-->
</body>


</html>