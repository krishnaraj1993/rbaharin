<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="css/all.css" rel="stylesheet">
  <!-- Owl Carousel CSS -->
  <link href="css/owl.carousel.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Poppins:100,200,300,400,500,600,700,800,900&amp;display=swap"
    rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link rel="stylesheet" href="css/nice-select.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/slick.css">
  <title>RealHomes Modern &ndash; Page 3 &ndash; Simply an awesome real estate website</title>
</head>

<body>
  <!--Topbar Start-->
  <div>
    <div class="topbar-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-4">
            <ul class="social_media style_none">
              <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-8">
            <div class="top_right">
              <div class="topbar_phone">
                <a href="tel://1-800-555-1234"><i class="fas fa-phone-alt" aria-hidden="true"></i> 1-800-555-1234
                </a></div>
              <div class="topbar_login log">
                <a href="login.html"> Login</a>
              </div>
              <div class="topbar_login">
                <a href="register.html"> Register</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Topbar End-->

    <!--Header Start-->
    <div class="header-wrap wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 navbar navbar-expand-lg navbar-light header_logo">
            <div class="header_logo"><a href="index.html"><img alt="" src="images/logo.png"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                class="navbar-toggler-icon"></span> </button>
          </div>
          <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light"> <a class="navbar-brand" href="#">Navbar</a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="close-toggler" type="button" data-toggle="offcanvas"> <span><i
                      class="fas fa-times-circle" aria-hidden="true"></i></span> </button>
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active"><a class="nav-link" href="index.html"> Home </a> </li>
                  <li class="nav-item"><a class="nav-link" href="#.">Latest listings</a> </li>
                  <li class="nav-item"><a class="nav-link" href="agencies.html">Agencies</a></li>
                  <li class="nav-item"><a class="nav-link" href="#.">Investment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#.">New Developments </a> </li>

                  <li class="nav-item"><a class="nav-link" href="#">Guides<span class="caret"><i
                          class="fas fa-caret-down"></i></span></a> <i class="fas fa-caret-down"></i>
                    <ul class="submenu">
                      <li><a href="agents.html">Building Regulation Guides</a></li>
                      <li><a href="pricing.html">RERA Regulations</a></li>
                      <li><a href="javascript:;">Market Intelligence</a></li>
                      <li><a href="javascript:;">Property Prices</a></li>
                      <li><a href="javascript:;">Trends</a></li>
                    </ul>
                  </li>

                  <li class="nav-item"><a class="nav-link" href="contact.html"> Contact Us</a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!--Header End-->

    <!--slider start-->
    <div class="slider-wrap wow fadeInUp">
      <div class="container">
        <div class="sliderTxt">
          <h1>Find Property Sale or Rent</h1>
          <p>From as low as $10 per day with limited time offer discounts.</p>
            <div id="exTab1" class="container">
              <ul class="nav nav-pills">
                <li> <a href="#rentProperty" class="active" data-toggle="tab">Rent Property</a> </li>
                <li><a href="#saleProperty" data-toggle="tab">Sale Property</a> </li>
              </ul>
              <div class="tab-content clearfix">
                <div class="tab-pane active" id="rentProperty">
                  <div class="form-wrap">
                    <form method="GET" action="searchresult.php">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="input-group origin">
                            <input type="text" name="Origin" placeholder="Enter Property, Location, Landmark ..."
                              class="form-control">
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="input-group">
                            <div class="nice-select form-control wide select_option" data-input="propertyType" tabindex="0"><span
                                class="current">Property Type</span>
                              <ul class="list">
                                <li data-value="Property Type" data-display="Property Type" class="option selected focus"> Property Type</li>
                                <li data-value="Residential" class="option">Residential</li>
                                <li data-value="Commercial" class="option">Commercial</li>
                                <li data-value="Land" class="option">Land</li>
                                <li data-value="Luxury" class="option">Luxury</li>
                              </ul>
                              <input type="hidden" id="propertyType" name="propertyType">
                            </div>
                          </div>
                        </div>


                        <div class="col-lg-3">
                          <div class="input-group">
                            <div class="nice-select form-control wide select_option" tabindex="0" data-input="propertyPrice">
                              <span
                                class="current">Price</span>
                              <ul class="list">
                                <li data-value="Property Value" data-display="Property Value"
                                  class="option selected focus" data-input="propertyPrice">
                                  Property Price</li>
                                  <li data-value="999-1999" class="option">$999 - $1999</li>
                                <li data-value="1999-2999" class="option">$1999 - $2999</li>
                                <li data-value="2999-3999" class="option">$2999 - $3999</li>
                                <li data-value="3999-4999" class="option">$3999 - $4999</li>
                              </ul>
                              <input type="hidden" id="propertyPrice" name="propertyPrice">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="input-btn">
                            <button class="sbutn" type="submit"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="tab-pane" id="saleProperty">
                  <div class="form-wrap">
                    <form action="searchresult.php">
                      <div class="row">
                        <div class="col-lg-5">
                          <div class="input-group origin">
                            <input type="text" name="Origin" placeholder="Enter Property, Location, Landmark ..."
                              class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="input-group destination">
                            <input type="text" name=" Destination" placeholder="Location" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="input-group">
                            <div class="nice-select form-control wide select_option" tabindex="0" data-input="propertyType"><span
                                class="current">Property Type</span>
                              <ul class="list">
                                <li data-value="Property Type" data-display="Property Type" class="option selected focus">Property Type</li>
                                <li data-value="Residential" class="option">Residential</li>
                                <li data-value="Commercial" class="option">Commercial</li>
                                <li data-value="Land" class="option">Land</li>
                                <li data-value="Luxury" class="option">Luxury</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 end_date">
                          <div class="input-group">
                            <div class="nice-select form-control wide select_option" tabindex="0" data-input="Bedrooms"><span
                                class="current">Bedrooms</span>
                              <ul class="list">
                                <li data-value="Bedrooms" data-display="Bedrooms" class="option selected focus">Bedrooms
                                </li>
                                <li data-value="1" class="option">1</li>
                                <li data-value="2" class="option">2</li>
                                <li data-value="3" class="option">3</li>
                                <li data-value="4" class="option">4</li>
                                <li data-value="5" class="option">5</li>
                              </ul>
                              <input type="hidden" id="Bedrooms" name="Bedrooms" value="Bedrooms">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 economy">
                          <div class="input-group">
                            <div class="nice-select form-control wide select_option" tabindex="0" data-input="Bathrooms"><span
                                class="current">Bathrooms</span>
                              <ul class="list">
                                <li data-value="Bathrooms" data-display="Bathrooms" class="option selected">Bathrooms
                                </li>
                                <li data-value="1" class="option">1</li>
                                <li data-value="2" class="option">2</li>
                                <li data-value="3" class="option">3</li>
                                <li data-value="4" class="option">4</li>
                                <li data-value="5" class="option">5</li>
                              </ul>
                              <input type="hidden" name="Bathrooms" id="Bathrooms">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="input-group">
                            <div class="nice-select form-control wide select_option" tabindex="0" data-input="propertyPriceAdvance"><span
                                class="current">Price</span>
                              <ul class="list">
                                <li data-value="Property Type" data-display="Property Type"
                                  class="option selected focus">
                                  Property Price</li>
                                <li data-value="999-1999" class="option">$999 - $1999</li>
                                <li data-value="1999-2999" class="option">$1999 - $2999</li>
                                <li data-value="2999-3999" class="option">$2999 - $3999</li>
                                <li data-value="3999-4999" class="option">$3999 - $4999</li>
                              </ul>
                              <input type="hidden" name="propertyPrice" id="propertyPriceAdvance">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="input-btn">
                            <button class="sbutn"><i class="fa fa-search" aria-hidden="true"></i> Search </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!--slider end-->

    <!--Properties Start-->
    <div class="property-wrap property_rent  wow fadeInUp">
      <div class="container">
        <div class="title">
          <h1>Featured listings <span></span></h1>
        </div>

        <!--Row Start-->
        <ul class="row">
          <?php include 'api/featureProduct.php'?>
        </ul>
        <!--Row End-->

      </div>
    </div>
    <!--Properties End-->

    <!--Buy and Sell Start-->
    <div class="buy-wrap wow fadeInUp">
      <div class="container">
        <div class="title center">
          <h1>How much is your property worth?</h1>
        </div>
        <p>Donec placerat dolor id neque pretium placerat. Donec in facilisis risus. In sollicitudin magna luctus sem
          ultrices convallis. Sed quis ex vel tellus ullamcorper malesuada. Aenean facilisis ex dolor, id vehicula nisl
          consectetur dapibus. Phasellus mollis mauris semper placerat convallis. Morbi varius facilisis dignissim.
          Donec
          eu sollicitudin nunc. Aliquam in nisi id arcu gravida vehicula quis nec sapien. Fusce at dolor ex.</p>
        <div class="start_btn"> <span><a href="#">COMING SOON</a></span> </div>
      </div>
    </div>
    <!--Buy and Sell Start-->

    <!-- popular start -->
    <section class="popular_wrap wow fadeInUp">
      <div class="container">
        <h1>Quick select</h1>

        <div class="row">
          <div class="col-md-8">
            <div class="popular_img position-relative"> <img alt="" src="images/california.jpg">
              <div class="popular_img_text"><a href="#">Apartments</a></div>
            </div>
          </div>
          <div class="col-md-4 mt_md">
            <div class="popular_img position-relative"> <img alt="" src="images/new_york.jpg">
              <div class="popular_img_text"><a href="#">Land</a></div>
            </div>
            <div class="popular_img position-relative mt"> <img alt="" src="images/miami.jpg">
              <div class="popular_img_text"><a href="#">Offices</a></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="popular_img position-relative mt"> <img alt="" src="images/san_francisco.jpg">
              <div class="popular_img_text"><a href="#">Hotels</a></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="popular_img position-relative mt"> <img alt="" src="images/dubai.jpg">
              <div class="popular_img_text"><a href="#">Buildings</a></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="popular_img position-relative mt"> <img alt="" src="images/australia.jpg">
              <div class="popular_img_text"><a href="#">Villas</a></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- popular end -->

    <!--Properties rent Start-->
    <div class="property-wrap property_rent wow fadeInUp">
      <div class="container">
        <div class="title">
          <h1>Recent listing</h1>
        </div>

        <!--Row Start-->
        <ul class="row">
          <!--col-lg-4 Start-->

          <!--col-lg-4 End-->

          <!--col-lg-4 Start-->

          <!--col-lg-4 End-->

          <!--col-lg-4 Start-->
          <li class="col-lg-12">
            <img src="images/demobg.png" width="100%" />
          </li>
          <!--col-lg-4 End-->
        </ul>
        <!--Row End-->

      </div>
    </div>
    <!--Properties End-->





    <!--Properties rent Start-->
    <div class="property-wrap selectbyLocation wow fadeInUp">
      <div class="container">
        <div class="title">
          <h1>Select by location</span></h1>
        </div>

        <div class="row">
          <div class="col-md-3">
            <h3 class="desc_head">Popular Search</h3>
            <ul class="tick">
              <li><a href="javascript:;">Fusce pretium ipsum</a></li>
              <li><a href="javascript:;">Morbi euismod at nisl</a></li>
              <li><a href="javascript:;">Donec at dolor nec enim</a></li>
              <li><a href="javascript:;">Praesent augue ipsum</a></li>
              <li><a href="javascript:;">Suspendisse feugiat metus</a></li>
              <li><a href="javascript:;">Nunc tincidunt faucibus</a></li>
              <li><a href="javascript:;">Nullam molestie tempor</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="desc_head">Popular Search</h3>
            <ul class="tick">
              <li><a href="javascript:;">Fusce pretium ipsum</a></li>
              <li><a href="javascript:;">Morbi euismod at nisl</a></li>
              <li><a href="javascript:;">Donec at dolor nec enim</a></li>
              <li><a href="javascript:;">Praesent augue ipsum</a></li>
              <li><a href="javascript:;">Suspendisse feugiat metus</a></li>
              <li><a href="javascript:;">Nunc tincidunt faucibus</a></li>
              <li><a href="javascript:;">Nullam molestie tempor</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="desc_head">Popular Search</h3>
            <ul class="tick">
              <li><a href="javascript:;">Fusce pretium ipsum</a></li>
              <li><a href="javascript:;">Morbi euismod at nisl</a></li>
              <li><a href="javascript:;">Donec at dolor nec enim</a></li>
              <li><a href="javascript:;">Praesent augue ipsum</a></li>
              <li><a href="javascript:;">Suspendisse feugiat metus</a></li>
              <li><a href="javascript:;">Nunc tincidunt faucibus</a></li>
              <li><a href="javascript:;">Nullam molestie tempor</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="desc_head">Popular Search</h3>
            <ul class="tick">
              <li><a href="javascript:;">Fusce pretium ipsum</a></li>
              <li><a href="javascript:;">Morbi euismod at nisl</a></li>
              <li><a href="javascript:;">Donec at dolor nec enim</a></li>
              <li><a href="javascript:;">Praesent augue ipsum</a></li>
              <li><a href="javascript:;">Suspendisse feugiat metus</a></li>
              <li><a href="javascript:;">Nunc tincidunt faucibus</a></li>
              <li><a href="javascript:;">Nullam molestie tempor</a></li>
            </ul>
          </div>

        </div>


      </div>
    </div>
    <!--Properties End-->







    <!--
<div class="partners">
  <div class="container">
      <h4>Brands and Partners</h4>
      <div class="slick-slider-area">
          <div class="row slick-carousel" data-slick='{"slidesToShow": 5, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}}, {"breakpoint": 768,"settings":{"slidesToShow": 2}}]}'>
              <div class="slick-slide-item"><img src="images/propertyImg01.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg02.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg03.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg01.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg02.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg03.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg01.jpg" alt="brand" class="img-fluid"></div>
              <div class="slick-slide-item"><img src="images/propertyImg02.jpg" alt="brand" class="img-fluid"></div>
          </div>
          <div class="slick-prev slick-arrow-buton">
              <i class="fa fa-angle-left"></i>
          </div>
          <div class="slick-next slick-arrow-buton">
              <i class="fa fa-angle-right"></i>
          </div>
      </div>
  </div>
</div> -->





    </section>


    <!-- perfect home start -->
    <section class="perfect_home_wrap wow fadeInUp">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8">
            <div class="perfect_text">
              <h1>Search properties for sale and to rent</h1>
              <span>Find all kind of properties in one place</span>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="readmore"><a href="#">Send enquiry</a></div>
          </div>
        </div>
      </div>
    </section>
    <!-- perfect home end -->


    <!--Footer Start-->
    <footer class="footer bg-style wow fadeInUp">
      <div class="container">
        <div class="footer-upper">
          <div class="row footerSocialIcon">
            <div class="col-md-6">
              <a href="index.html"> <img alt="" src="images/logo.png"> </a>
            </div>

            <div class="col-md-6">
              <div class="social-icons footer_icon">
                <ul>
                  <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-lg-3 col-md-3">

              <div class="footer-widget quick-links">
                <h3 class="title">Quick links</h3>
                <ul>
                  <li><a href="#.">Capital Governorate (5)</a> </li>
                  <li><a href="#.">Central Governorate (3)</a> </li>
                  <li><a href="#.">Muharraq Governorate (1)</a> </li>
                  <li><a href="#.">Northern Governorate (2)</a> </li>
                  <li><a href="#.">Southern Governorate (2)</a> </li>
                </ul>
              </div>
            </div>

            <div class="col-lg-5 col-md-4">
              <div class="footer-widget contact">
                <h3 class="title">Contact Info</h3>
                <ul class="footer-adress">
                  <li class="footer_address"> <i class="fas fa-map-signs"></i> <span>Plat Ni and Address of realty
                      bahrain
                      here</span> </li>
                  <li class="footer_email"> <i class="fas fa-envelope" aria-hidden="true"></i> <span><a
                        href="mailto:info@realestate.com"> info@realestate.com </a></span> </li>
                  <li class="footer_phone"> <i class="fas fa-phone-alt"></i> <span><a href="tel:1-800-555-1234 ">
                        1-800-555-1234 </a></span> </li>
                </ul>

              </div>
            </div>

            <div class="col-lg-4 col-md-4">
              <div class="footer-widget contact">
                <h3 class="title">Remain Updated</h3>
                <form action="#">

                  <div class="form-group">
                    <input class="form-control" placeholder="Your email address" type="email">
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn login_btn ">Sign up </button>
                  </div>
                  <!-- form-group// -->
                </form>

              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="foocopyRights">© 2020. Realty Bahrain All rights reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--Footer End-->
    <script>
      /*var app = angular.module('realtybahrainApp', []);
      app.controller('realtybahrainCtrl', function ($scope, $http) {
        $http.get("http://localhost:8000/api/properties")
          .then(function (response) {
            console.log(response.data.data);
            $scope.properties = response.data.data;
          });
      });*/
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Owl Carousel -->
    <script src="js/owl.carousel.js"></script>
    <!-- wow js -->
    <script src="js/animate.js"></script>
    <script src="js/jquery.nice-select.js"></script>
    <script>
      new WOW().init();
    </script>
    <!-- general script file -->
    <script src="js/wow.js"></script>


    <script src="js/script.js"></script>
    <script src="js/slick.min.js"></script>
  </div>
</body>

</html>