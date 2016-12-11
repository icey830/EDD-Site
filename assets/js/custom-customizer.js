/**
 * Theme Customizer
 */

(function($){
    $(document).ready(function() {
        $('.eddwp-toggle-description').on('click',function(e){
            e.preventDefault();
            $(this).toggleClass('eddwp-description-opened').parents('.customize-control-title').siblings('.eddwp-control-description').slideToggle();
        });
    });
})(jQuery);