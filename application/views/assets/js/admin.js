var windewSize = $(window).width();
var Script = function() {

	$(function() {
		function responsiveView() {
			var wSize = $(window).width();
			windewSize = wSize;
			if (wSize <= 768) {
				$('#container').addClass('sidebar-close');
				$('#sidebar > ul').hide();
			}

			if (wSize > 768) {
				$('#container').removeClass('sidebar-close');
				$('#sidebar > ul').show();
			}
		}
		$(window).on('load', responsiveView);
		$(window).on('resize', responsiveView);
	});

	if ($(".custom-bar-chart")) {
		$(".bar").each(function() {
			var i = $(this).find(".value").html();
			$(this).find(".value").html("");
			$(this).find(".value").animate({
				height : i
			}, 2000)
		})
	}

}();

$(document).ready(
	function() {
		$(document).bind("ajaxSend", function() {
			/* TODO */
			// Ajax loading start
		}).bind("ajaxComplete", function() {
			/* TODO */
			// Ajax loading stop
		});

		$('#nav-accordion').dcAccordion({
			eventType : 'click',
			autoClose : true,
			saveState : true,
			disableLink : true,
			speed : 'fast',
			showCount : false,
			autoExpand : true,
			// cookie: 'dcjq-accordion-1',
			classExpand : 'dcjq-current-parent'
		});

		jQuery('#sidebar .sub-menu > a').click(function() {
			var o = ($(this).offset());
			diff = 250 - o.top;
		});

		$('.fa-bars').click(function() {
			if ($("#container").hasClass("sidebar-closed") === false) {
				$('#main-content').css({
					'margin-left' : '50px'
				});
				$('#sidebar').css({
					'margin-left' : '-160px'
				});
				if (windewSize <= 768) {
					$('#sidebar > ul').hide();
				}
				$("#container").addClass("sidebar-closed");
			} else {
				$('#main-content').css({
					'margin-left' : '210px'
				});
				$('#sidebar').css({
					'margin-left' : '0'
				});
				if (windewSize <= 768) {
					$('#sidebar > ul').show();
				}
				$("#container").removeClass("sidebar-closed");
			}
		});

		jQuery('.panel .tools .fa-chevron-down').click(
			function() {
				var el = jQuery(this).parents(".panel").children(
						".panel-body");
				if (jQuery(this).hasClass("fa-chevron-down")) {
					jQuery(this).removeClass("fa-chevron-down")
							.addClass("fa-chevron-up");
					el.slideUp(200);
				} else {
					jQuery(this).removeClass("fa-chevron-up").addClass(
							"fa-chevron-down");
					el.slideDown(200);
				}
			}
		);

		jQuery('.panel .tools .fa-times').click(function() {
			jQuery(this).parents(".panel").parent().remove();
		});
		
		
		/*Tools*/
		//Sorting
		jQuery(".tool-column-order").click(function(){
			direction = jQuery(this).attr('data-direction');
			order = jQuery(this).attr('data-order');
			document.getElementsByName('order')[0].value = order;
			document.getElementsByName('direction')[0].value = direction;
			
			form = document.getElementById("adminForm");
			form.submit();
			return false;
		});
		/*countrychange js*/
		$(document).ready(function(){
	$(".countrychange").change(function(){
		var siteurl = $("#siteurl").val();
		var country = $(this).val();
		$.ajax({
			method : "GET",
			url : siteurl+"common/ajax/getstates",
			dataType:'json',
			data : {
				country_id : country
			}
		}).done(function(json) {
			$setdata = '';
			$(".catchstates").empty();
			$(".catchstates").append('<option value="">--Select state--</option>');
			$(json).each(function(index,data){
				$(".catchstates").append('<option value="'+data['id']+'">'+data['name']+'</option>');
			});
		});
	});
	
	$(".statechange").change(function(){
		var siteurl = $("#siteurl").val();
		var state = $(this).val();
		$.ajax({
			method : "GET",
			url : siteurl+"common/ajax/getcities",
			dataType:'json',
			data : {
				state_id : state
			}
		}).done(function(json) {
			$setdata = '';
			$(".catchcities").empty();
			$(".catchcities").append('<option value="">--Select city--</option>');
			$(json).each(function(index,data){
				$(".catchcities").append('<option value="'+data['id']+'">'+data['name']+'</option>');
			});
		});
	});
});

		/*Tools*/

		$('.tooltips').tooltip();

		$('.popovers').popover();
	}

);

CIForm = window.CIForm || {};
CIForm.submitform = function() {
	form = document.getElementById("adminForm");
	form.submit();
};
CIForm.actions = function(action) {
	var form = document.getElementById("adminForm");
	var elements = document.getElementsByName("cid[]");
	var isChecked = false;
	for (i = 0; i < elements.length; i++) {
		if (elements[i].checked) {
			isChecked = true;
		}
	}
	if (isChecked) {
		if (action == 'delete') {
			var actionconfirm = confirm('Are you sure?');
			if (!actionconfirm) {
				return false;
			}
		}
		var frmaction = document.getElementsByName("frmaction");
		if (frmaction.length > 0) {
			var formaction = frmaction[0].value;
			form.action = formaction + '/' + action;
		}
		form.submit();
	} else {
		alert("Please select atleast one item to " + action + "!");
	}
};

CIForm.ajaxaction = function(eid, action) {

		document.getElementById(eid).checked = true;
	CIForm.actions(action);
};

CIForm.checkall = function(source) {
	checkboxes = document.getElementsByName('cid[]');
	for (var i = 0, n = checkboxes.length; i < n; i++) {
		checkboxes[i].checked = source.checked;
	}
};
