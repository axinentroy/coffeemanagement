$(document).ready(function(){
    $('.login').click(function(){
        $('.form-login').removeClass('xora');
    });
	$('.close-dn').click(function(){
		$('.form-login').toggleClass('xora');
	});
	$('.register').click(function(){
		$('.form-register').css("display","block");
	});
	
});
$(document).ready(function(){
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('.stickyheader').offset().top;
 
        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('.stickyheader').css({position: 'fixed', top: '0px', opacity: '0.5', background:'black' });
                        $('.stickyalias').css('display', 'block');
						$('.stickyheader ul li a').css({opacity: '1'});
                } else {
                        $('.stickyheader').css({position: 'static', top: '0px',opacity: '1' ,background: '#ab5c27'});
                        $('.stickyalias').css('display', 'none');
                }
        });
  });