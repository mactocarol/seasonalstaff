(function($) {
	"use strict";
	$(".search_pagination ul li").on('click',function(){
		$(".search_pagination ul li").removeClass("active");
		$(this).addClass("active");
	});
	//custom close login modal on click
	$(".forget_pass .sign_up_btn").on('click',function(){
		$('#login_popup').modal('hide');
	});
	//append dymanic field on click in input
	var j = 1;
    $('.add_field').on('click', function(){
		j++;
		var append_data = ('<div class="new_row" id="trow'+j+'"><input type="text" name="addtional_b[]" placeholder="Add Business location"><span class="field_btn remove_field" id="'+j+'"><i class="fa fa-times"></i></span></div>');
		$('.addition_business').append(append_data);
    });

    //Sidebar menu responsive
    $(".dashboard_nav > ul > li > ul").parents("li").addClass("dropdown_menu");
    $(".dropdown_menu").on('click', function(){
		$(this).children("ul").slideToggle(500);
    });
     $(".dropdown_menu > a ").on('click', function(e){
     	e.preventDefault();
 	});
    $(".dropdown_menu").append("<span class='caret_down'><i class='fa fa-angle-down'></i></span>");
	//remove field
	$(document).on('click', '.remove_field', function(){
		var button_id = $(this).attr("id");
		$('#trow'+button_id+'').remove();
    });
    //message menu dropdown
    $(document).on('click', '.msg_menus_icon', function(){
		$(".msg_dropdown").slideToggle(300);
    });
    //sidebar full height
    var win_h = $(window).outerHeight();
    var win_w = $(window).width();
    if (win_w > 991) {
    	$(".dashboard_sidebar").css({'height':win_h});
    }
    else{

    }
    //Datepicker
    if ($(".datepicker").length > 0) {
     $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true
      });
   }
   //popup open on click js
    $(".popup_btn").on('click', function(e){
      var popup_show = $(this).attr('data-show');
      $(".popup_wrapper").removeClass("popup_active");
      $("#"+popup_show).addClass("popup_active");
      e.preventDefault();
    });
    //popup close js
    $(".p_close_btn").on('click', function(){
      $(this).parents (".popup_wrapper").removeClass("popup_active");
    });
    //autocomplete country on search
     $(function() {
            var availableTutorials  =  [
               "Afghanistan",
               "Albania ",
               "Algeria",
               "Andorra",
               "Angola",
               "Antigua and Barbuda",
               "Argentina",
               "Armenia",
               "Australia",
               "Austria",
               "Azerbaijan",
               "The Bahamas",
               "Bahrain",
               "Bangladesh",
               "Barbados",
               "Belarus",
               "New Zealand",
            ];
            if ($(".country_autocomplete").length > 0) {
                $( ".country_autocomplete" ).autocomplete({
                   source: availableTutorials
                });
            }
         });
})(jQuery);