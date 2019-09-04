(function($) {
	"use strict";
	$(".search_pagination ul li").on('click',function(){
		$(".search_pagination ul li").removeClass("active");
		$(this).addClass("active");
	});
	//custom close login modal on click
	$(".sign_up_btn").on('click',function(){
		$('#login_popup').modal('hide');
	});
  	$(".login_show_btn").on('click',function(){
    	$('#signup_popup').modal('hide');
	});
	//append dymanic field on click in input
	 var j = 1;
    $('.add_field').on('click', function(){
  		j++;
  		var append_data = ('<div class="new_row" id="trow'+j+'"><input type="text" name="addtional_b[]" placeholder="Add Business location"><span class="field_btn remove_field" id="'+j+'"><i class="fa fa-times"></i></span></div>');
  		$('.addition_business').append(append_data);
    });
	//remove field
	$(document).on('click', '.remove_field', function(){
		var button_id = $(this).attr("id");
		$('#trow'+button_id+'').remove();
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
        dateFormat: "dd-MM-yy",
        changeYear: true,
        changeMonth: true,
      });
   }
    //datepicker range function
   $(function() {
    var dateFormat = "dd-MM-yy",
      from = $(".from_date")
        .datepicker({
		 dateFormat: "dd-MM-yy",
      	 changeMonth: true,
      	 changeYear: true,
        })
        .on("change", function() {
          to.datepicker( "option", "minDate", getDate(this) );
        }),
      to = $(".to_date").datepicker({
 	 	dateFormat: "dd-MM-yy",
        changeMonth: true,
        changeYear: true,
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate(this) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  });
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
    //bootsrape selectpicker
    if ($(".selectpicker").length > 0) {
      $('.selectpicker').selectpicker();
    }
    //accordion css start
    $(".panel_content.active_content").show();
    $('.panel_heading').click(function (e){
      $(".panel_heading").removeClass("active");
      if($(this).next('.panel_content').css('display') != 'block'){
        $('.active_content').removeClass('active_content').slideUp(500);
        $(this).next('.panel_content').addClass('active_content').slideDown(500);
        $(this).addClass("active");
      } else {
        $('.active_content').removeClass('active_content').slideUp(500);
      }
    });
    //append data in skills section
    var k = 0;
    var k2 = 0;
    $('.add_skill_btn').on('click', function(){
      k++;
      if (k2 < 5) {
        k2++;
        var append_data = ('<div class="group_wrapper n_group_wrapper " id="grp_row'+k+'">'+
		'<div class="group_wrapper">'+
		  '<div class="form_group">'+
		   '<div class="row">'+
			'<div class="col-md-6 label_wrap">'+
			  '<div class="form_label">sklills and attributes</div>'+
			'</div>'+
		 '<div class="col-md-6">'+
		'<div class="form_input">'+
		'<div class="form_input">'+
		'<textarea name="sklills-description[]" id="sklills-description" placeholder="Ex - Computer skills, Packhouse work"></textarea>'+
		'<span class="input_text_msg">(You can write maximum of 35 characters)</span>'+
        '</div></div></div></div></div>'+
		
		'<div class="form_group">'+
		  '<div class="row">'+
			 '<div class="col-md-6 label_wrap">'+
			  '<div class="form_label">Description</div>'+
			 '</div>'+
	     '<div class="col-md-6">'+
		  '<div class="form_input">'+
		  '<textarea id="description" name="description[]" placeholder="Description"></textarea>'+
		  '<span class="input_text_msg">(You can write maximum of 50 characters)</span>'+
		'</div></div></div></div>'+		
		
		'<div class="form_group">'+
		'<div class="row">'+
	    '<div class="col-md-6 label_wrap">'+
        '<div class="form_label">licence and endorsement</div>'+
	    '</div><div class="col-md-6">'+			                              			
		'<div class="form_input">'+
        '<div class="check_box">'+
       '<label>'+
        '<input type="checkbox" name="licence[]" id="licence" value="fullnz">'+
        '<span class="checked_box"></span>'+
        '<span class="check_text">Full NZ Drivers licence</span>'+
        '</label>'+
		'<label>'+
        '<input type="checkbox" name="licence[]" id="licence" value="restrictednz">'+
        '<span class="checked_box"></span>'+
        '<span class="check_text">Restricted NZ Drivers licence</span>'+
        '</label>'+												
        '<label>'+
        '<input type="checkbox" name="licence[]" id="licence" value="nodrivers">'+
        '<span class="checked_box"></span>'+
        '<span class="check_text">No Drivers licence</span>'+
        '</label><label>'+			
        '<input type="checkbox" name="licence[]" id="licence" value="internationaldrivers">'+
        '<span class="checked_box"></span>'+
        '<span class="check_text">International Drivers licence</span>'+
        '</label><label>'+
        '<input type="checkbox" name="licence[]" id="licence" value="barmanager">'+
        '<span class="checked_box"></span>'+
        '<span class="check_text">Bar Manager licence</span>'+
        '</label><label>'+												
        '<input type="checkbox" name="licence[]" id="licence" value="lcq">'+
          '<span class="checked_box"></span>'+
          '<span class="check_text">LCQ</span>'+
          '</label><label>'+									
												
        '<input type="checkbox" name="licence[]" id="licence" value="forklift">'+
        '<span class="checked_box"></span>'+
        '<span class="check_text">Forklift endorsement</span>'+
        '</label></div></div></div></div></div>'+		                              
		'<span class="remove_field skill_remove" id="'+k+'"><i class="fa fa-times"></i></span></div>');
        $('.append_skill_data').append(append_data);
        //selectpicker
        if ($(".selectpicker").length > 0) {
          $('.selectpicker').selectpicker();
        }
      }
      else{
        alert("You can add Courses only Five times");
      }
    }); 
    //remove data in work profile
    $(document).on('click', '.skill_remove', function(){
      var button_id = $(this).attr("id");
      k2--;
      $('#grp_row'+button_id+'').remove();
    });
    //append data in Employe history section
    var l = 1;
    $('.add_employ_btn123').on('click', function(){
      l++;
      var append_data = ('<div class="group_wrapper n_group_wrapper " id="egrp_row'+l+'"><div class="form_group"><div class="row"><div class="col-md-6 label_wrap"><div class="form_label">Job title</div></div><div class="col-md-6"><div class="form_input select_box"><input type="text" name="jobtitle[]" id="jobtitle"></div></div></div></div><div class="form_group"><div class="row"><div class="col-md-6 label_wrap"><div class="form_label">Select Date</div></div><div class="col-md-6 date_inputs"><div class="form_input"><div class="form_label">From Date</div><input type="text" class="datepicker" name="fromdate[]" ></div><div class="form_input"><div class="form_label">To Date</div><input type="text" class="datepicker" name="todate[]"></div></div></div></div><div class="form_group"><div class="row"><div class="col-md-6 label_wrap"><div class="form_label">Description</div></div><div class="col-md-6"><div class="form_input"><textarea name="employment-description[]" id="employment-description"></textarea><span class="input_text_msg">(You can write maximum of 50 characters)</span></div></div></div></div><span class="remove_field emp_remove" id="'+l+'"><i class="fa fa-times"></i></span></div>');
      $('.append_employ_data').append(append_data);
    //Selectpicker
      if ($(".selectpicker").length > 0) {
        $('.selectpicker').selectpicker();
      }
    //Datepicker
    if ($(".datepicker").length > 0) {
     $(".datepicker").datepicker({
      dateFormat: "dd-MM-yy",
      changeYear: true,
      changeMonth: true,
      });
    }
      });
    //remove data in work profile
    $(document).on('click', '.emp_remove', function(){
      var button_id = $(this).attr("id");
      $('#egrp_row'+button_id+'').remove();
    });
    //show password on button click
    $('.show_pass').click(function(){
      if ($(this).is(':checked')) {
        $(this).parents(".show_pass_label").prev(".pass_input").attr('type','text');
        $(this).next("span").html('<i class="fa fa-eye"></i>');
      }
      else{
        $(this).parents(".show_pass_label").prev(".pass_input").attr('type','password');
        $(this).next("span").html('<i class="fa fa-eye-slash"></i>');
      }
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
     //add class in notification div
     $(".noti_count i").parents(".noti_count").addClass("noti_count_active");
     //add parent class in table
     $(".term_condition_txts table").wrap("<div class='table-responsive terms_table'></div>");

     // hide error on change input and selectbox
     $(".bootstrap-select > select").on("change", function(){
       var this_val =  $(this).val();
       if (this_val !== '') {
        $(this).next("label.error").remove();
       }
       else {
       }
     });
     $(".datepicker").on("change", function(){
       var this_val =  $(this).val();
       if (this_val !== '') {
        $(this).next("label.error").remove();
       }
       else{
        
       }
     });
     //deal sidebar js
     $( ".deal_filter_btn" ).on('click', function(){
       $(".deal_sidebar").slideToggle(300);
     });
     
})(jQuery);