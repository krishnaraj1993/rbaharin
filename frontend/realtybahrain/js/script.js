(function($) { 

$('[data-toggle="offcanvas"]').on('click', function () {
    $('.navbar-collapse').toggleClass('show');
    });


/* ================ Revolution Slider. ================ */
  if($('.tp-banner').length > 0){
    $('.tp-banner').show().revolution({
      delay:6000,
          startheight: 550,
          startwidth: 1170,
          hideThumbs: 1000,
          navigationType: 'none',
          touchenabled: 'on',
          onHoverStop: 'on',
          navOffsetHorizontal: 0,
          navOffsetVertical: 0,
          dottedOverlay: 'none',
          fullWidth: 'on'
    });
  }
  if($('.tp-banner-full').length > 0){
    $('.tp-banner-full').show().revolution({
      delay:6000,
          hideThumbs: 1000,
          navigationType: 'none',
          touchenabled: 'on',
          onHoverStop: 'on',
          navOffsetHorizontal: 0,
          navOffsetVertical: 0,
          dottedOverlay: 'none',
          fullScreen: 'on'
    });
  } 
  


    /*==== Nav ====*/
    $('.navbar-collapse a').on('click',function(){
        $(".navbar-collapse").collapse('hide');
    });

/* ================ Nav ================ */
    $('.fa-caret-down').on("click", function(e) {
        e.preventDefault();
        $(this).next().slideToggle('');
    });
    

/* ================ Nice Select ================ */
    $(document).ready(function() {
  $('select').niceSelect();
});



  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 5,
    asNavFor: '#slider'
  });
 
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });

   // Slick Sliders
   $('.slick-carousel').each(function () {
    var slider = $(this);
    $(this).slick({
        infinite: true,
        dots: false,
        arrows: false,
        centerMode: true,
        centerPadding: '0'
    });

    $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function () {
        slider.slick('slickPrev');
    });
    $(this).closest('.slick-slider-area').find('.slick-next').on("click", function () {
        slider.slick('slickNext');
    });
});

})(jQuery);