/**
 * Return to Top Arrow
 */
(function($) {
    $(document).ready(function() {

      /* Fade arrow in and out as user scrolls up and down page */
      $(window).scroll(function() {
        if ($(this).scrollTop() >= 500) {
          $('#return-to-top').css('opacity', '1');
        } else {
          $('#return-to-top').css('opacity', '0');
        }
      });

      /* Scroll to top on arrow click */
      $('#return-to-top').click(function() {
        $('body,html').animate({
          scrollTop : 0
        }, 500);
      });

    });
})(jQuery);
