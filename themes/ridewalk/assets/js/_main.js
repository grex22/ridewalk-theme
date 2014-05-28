/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      if($.cookie('is_reversed') === 'true'){
        $('.main-content').addClass('reversed');
        $('#reverser').addClass('reversed');
      }
      // JavaScript to be fired on all pages
      $("#reverser").click(function(e){
        e.preventDefault();
        $(".main-content").toggleClass('reversed');
        $(this).toggleClass('reversed');
        if($(this).hasClass('reversed')){
          $.cookie('is_reversed','true',{expires: 7, path:'/'});
        }else{
          $.cookie('is_reversed','false',{expires: 7, path:'/'});
        }
      });
    }
  },
  maps: {
    init: function() {

      var historicalOverlay;

      function initialize() {

        var warsaw = new google.maps.LatLng(41.253306, -85.852012);
        var imageBounds = new google.maps.LatLngBounds(
        
            new google.maps.LatLng(41.133239, -86.049766),
            new google.maps.LatLng(41.386021, -85.652791));

        var mapOptions = {
          zoom: 13,
          center: warsaw
        };
        
        $('#map-canvas').css('height',700);

        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        historicalOverlay = new google.maps.GroundOverlay(
            'http://ripfishstage.com/ridewalk/wp-content/uploads/2014/05/county.gif',
            imageBounds);
        historicalOverlay.setMap(map);
      }

      google.maps.event.addDomListener(window, 'load', initialize);

    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
      $('.hero_images').cycle({
        pager       : '.hero_pager',
        slideResize : false,
        fx          : 'scrollLeft',
        speed       : 500,
        timeout     : 6000
      });
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
