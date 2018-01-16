jQuery(document).ready(function ($) {
	 $(".owl-carousel").each(function(index, el) {
	 if($(this).data('items') !=null){		 
		 var config = $(this).data();
			config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
			config.smartSpeed="300";
			if($(this).hasClass('owl-style2')){
				config.animateOut="fadeOut";
				config.animateIn="fadeIn";    
			}
		$(this).owlCarousel(config);		
	 }
		});
	
	var max_height = 0;
	$(".list-post .content-category").each(function () {
		if ($(this).height() > max_height)
		max_height = $(this).height();
	});       
	$(".list-post .content-category").height(max_height);
	
	
	//menu mobile
    $("#showmenu").click(function (e) {
        e.preventDefault();
        $("#menu").toggleClass("show");
        if ($("#menu").hasClass("show") == true) {
            $('body').prepend('<div class="bg_full"> <a href="#" class="showmenu"> <i class="fa fa-times" aria-hidden="true"></i></a> </div>');
			
			} else {
            $('.bg_full').remove();
		}
	});
    $("body").on('click', '.bg_full', function (e) {
        e.preventDefault();
        $("#menu").toggleClass("show");
        $('.bg_full').remove();
	});
	
    var $bgs = $('.sub-mn-mb');
    $('.item-mb').click(function () {
        var $target = $($(this).data('target')).stop(true).slideToggle();
        $bgs.not($target).filter(':visible').stop(true, true).slideUp();
	})
    //end menu mobile
    $('.icon-search').click(function () {
        $('.search .form-search').slideToggle();
	});
	
	$('.img-item').click(function(){			
		var item_text = $(this).data('item');
		$('.item-text').fadeOut();
		$('.text-'+item_text).fadeIn(1000);	
	});
	$('.btn-search').click(function(){
	$('.btn-search').hide();
		$('.form-search').css("margin-right","0px");
		$('.form-search').slideToggle();	
	});
	
	
	
	var height_text_des = $('.text-description .item-text').height();
	$('.text-description').height(height_text_des);
	
	$('.load-search').click(function(){
		$('.search').slideToggle();
	});
	
	$('.list-pro').click(function(){
		$('.item-product').addClass('col-item');
	});	 
	$('.col-pro').click(function(){
		$('.item-product').removeClass('col-item');
	});		
	
});
jQuery(function ($) {
    var $bgs = $('.menu-toggle');
    $('.menu-item').click(function () {
        var $target = $($(this).data('target')).stop(true).slideToggle();
        $bgs.not($target).filter(':visible').stop(true, true).slideUp();
	})
})