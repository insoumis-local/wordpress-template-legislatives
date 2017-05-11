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
 * ======================================================================== */

(function($) {
  // Helper that calculates text width properly.
  function getWidthOfText($element) {
    // Create a dummy canvas (render invisible with css)
    var c = document.createElement('canvas');
    // Get the context of the dummy canvas
    var ctx = c.getContext('2d');
    var txt = $element.text();
    if ($element.css('text-transform') === 'uppercase') {
      txt = txt.toUpperCase();
    }
    else if ($element.css('text-transform') === 'lowercase') {
      txt = txt.toLowerCase();
    }
    else if ($element.css('text-transform') === 'capitalize') {
      txt = txt.replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
        return $1.toUpperCase();
      });
    }
    // Set the context.font to the font that you are using
    var font = $element.css('font-style');
    font += ' ' + $element.css('font-variant');
    font += ' ' + $element.css('font-weight');
    font += ' ' + $element.css('font-size');
    font += ' ' + $element.css('font-family').substr(0, $element.css('font-family').indexOf(','));
    ctx.font = font;
    // Measure the string
    return ctx.measureText(txt).width;
  }

  var initFitText = function() {
    var myFont = new FontFace('Montserrat', 'url(/wp-content/themes/fi-legislatives/dist/fonts/montserrat-v6-latin-700.woff2)');
    var toFit = [
      {
        selector: '.fi-cover .candidates > strong',
        startSize: 50
      },
      {
        selector: '.fi-cover .candidates > span',
        startSize: 'previous'
      },
      {
        selector: '.fi-cover .logo .title',
        startSize: 30
      },
      {
        selector: '.fi-cover .logo .subtitle',
        startSize: 25
      }
    ];

    myFont.load().then(function(font){
      // Needed so canvas can use it to calculate text width.
      document.fonts.add(font);

      var $element, maxWidth, fontSize = 50;
      toFit.forEach(function (item) {
        $element = $(item.selector);
        maxWidth = $element.parent().width();
        if (item.startSize !== 'previous') {
          fontSize = item.startSize;
        }

        $element.css('font-size', fontSize + 'px');
        while (Math.max($element[0].scrollWidth, getWidthOfText($element)) > maxWidth) {
          $element.css('font-size', fontSize-- + 'px');
        }
      });
    });
  };
  var resizeTimeout;
  $(window).resize(function() {
    if (resizeTimeout) {
      clearTimeout(resizeTimeout);
    }
    resizeTimeout = setTimeout(initFitText, 50);
  });

  var initScrollDown = function() {
    $('.fi-cover .scrolldown').bind('click', function() {
      $('html, body').animate({
        scrollTop: $(this).parents('.fi-cover').height()
      }, 500);
      $(this).blur();
    });
  };

  var initMasonry = function() {
    $elem = $('.blog, .archive, .category, .search')
      .find('.page-content')
      .add('.widget_siteorigin-panels-postloop');
    $elem.each(function(index, elem) {
      var $grid = new Masonry(elem, {
        itemSelector: 'article',
        percentPosition: true
      });
      $elem.imagesLoaded().progress(function() {
        $grid.layout();
      });
    });
  };

  // from https://css-tricks.com/NetMag/FluidWidthVideo/Article-FluidWidthVideo.php
  var responsiveVideo = function() {
    // Find all YouTube videos
    var $allVideos = $("iframe[src*='//www.youtube.com'], " +
      "iframe[src*='//www.facebook.com'], " +
      "iframe[src*='//www.dailymotion.com']");
    // Figure out and save aspect ratio for each video
    $allVideos.each(function() {
      $(this)
        .data('aspectRatio', this.height / this.width)
        // and remove the hard coded width/height
        .removeAttr('height')
        .removeAttr('width');
    });
    // When the window is resized
    $(window).resize(function() {
      // Resize all videos according to their own aspect ratio
      $allVideos.each(function() {
        var $el = $(this);
        var newWidth = $el.parent().width();

        $el
          .width(newWidth)
          .height(newWidth * $el.data('aspectRatio'));
      });
    // Kick off one resize to fix all videos on page load
    }).resize();
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        initMasonry();
        initFitText();
        initScrollDown();
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        responsiveVideo();
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    },
    'blog': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  Sage.archive = Sage.blog;
  Sage.category = Sage.blog;
  Sage.search = Sage.blog;

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
