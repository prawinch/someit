$( document ).ready(function() {
    
    // Slimscroll
    $('.slimscroll').slimscroll({
        allowPageScroll: true
    });
    
    // Wow
    new WOW().init();
    
    // Smooth scroll
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);
        var scrollTo = $target.offset().top;

        $('html, body').stop().animate({
            'scrollTop': scrollTop
        }, 0, 'easeInOutExpo');
    });
    
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        
        if (scroll >= 0) {
            $(".navbar").addClass("whiteHeader");
        } 
    });
    
    // Tabs
    [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
        new CBPFWTabs( el );
    });
    
});