$(document).ready(function(){
	$("select.countrychange").change(function(){
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
			$("select.catchstates").empty();
			$("select.catchstates").append('<option value="">--Select state--</option>');
			$(json).each(function(index,data){
				$("select.catchstates").append('<option value="'+data['id']+'">'+data['name']+'</option>');
			});
		});
	});
	
	$("select.statechange").change(function(){
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
			$("select.catchcities").empty();
			$("select.catchcities").append('<option value="">--Select city--</option>');
			$(json).each(function(index,data){
				$("select.catchcities").append('<option value="'+data['id']+'">'+data['name']+'</option>');
			});
		});
	});
	
	/*Scroll to top*/
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	if($(this).scrollTop() < offset){
		$back_to_top.removeClass('cd-is-visible cd-fade-out');
	}
	
	
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
	/*Scroll to top*/
	
});

function applyjob(jobid){
	var siteurl = $("#global_site_url").val();
	$.ajax({
		method: "POST",
		dataType:'json',
		url: siteurl+'jobs/job/apply',
		data: { jobid: jobid }
	}).done(function(response) {
		$("#messagestatus").html("");
		if(response.status == 'success'){
			$alertdiv = 'success'; 
		}else{
			$alertdiv = 'danger';
		}
		
		$('html,body').animate({
	        scrollTop: $("#messagestatus").offset().top},
	    'slow');
		$("#messagestatus").append('<div class="alert alert-'+$alertdiv+'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.message+'</div>');
	});
}

function savejob(jobid){
	var siteurl = $("#global_site_url").val();
	$.ajax({
		method: "POST",
		dataType:'json',
		url: siteurl+'jobs/job/savejob',
		data: { jobid: jobid }
	}).done(function(response) {
		$("#messagestatus").html("");
		if(response.status == 'success'){
			$alertdiv = 'success'; 
		}else{
			$alertdiv = 'danger';
		}
		
		$('html,body').animate({
	        scrollTop: $("#messagestatus").offset().top},
	    'slow');
		$("#messagestatus").append('<div class="alert alert-'+$alertdiv+'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.message+'</div>');
	});
}

function saveresume(resumeid){
	var siteurl = $("#global_site_url").val();
	$.ajax({
		method: "POST",
		dataType:'json',
		url: siteurl+'jobs/resume/saveresume',
		data: { resumeid: resumeid }
	}).done(function(response) {
		$("#messagestatus").html("");
		if(response.status == 'success'){
			$alertdiv = 'success'; 
		}else{
			$alertdiv = 'danger';
		}
		
		$('html,body').animate({
	        scrollTop: $("#messagestatus").offset().top},
	    'slow');
		$("#messagestatus").append('<div class="alert alert-'+$alertdiv+'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.message+'</div>');
	});
}

function savesearch() {
	var siteurl = $("#global_site_url").val();
	$.ajax({
		method: "POST",
		dataType:'json',
		data: $("#frontForm").serialize(),
		url: siteurl+'jobs/lists/savesearch'
	}).done(function(response) {
		$(".flashcontainer").html("");
		if(response.status == 'success'){
			$alertdiv = 'success'; 
		}else{
			$alertdiv = 'danger';
		}
		
		$('html,body').animate({
	        scrollTop: $(".flashcontainer").offset().top},
	    'slow');
		$(".flashcontainer").append('<div class="alert alert-'+$alertdiv+'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.message+'</div>');
	});
	return false;
}

function deletesavedsearch(searchid,that){
	var siteurl = $("#global_site_url").val();
	$.ajax({
		method: "POST",
		dataType:'json',
		data: {searchid:searchid},
		url: siteurl+'jobs/lists/deletesavesearch'
	}).done(function(response) {
		$(".flashcontainer").html("");
		if(response.status == 'success'){
			$alertdiv = 'success'; 
			jQuery(that).parent().parent().remove();
		}else{
			$alertdiv = 'danger';
		}
		
		$('html,body').animate({
	        scrollTop: $(".flashcontainer").offset().top},
	    'slow');
		$(".flashcontainer").append('<div class="alert alert-'+$alertdiv+'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+response.message+'</div>');
	});
	return false;
}

CIForm = window.CIForm || {};
CIForm.checkall = function(source) {
  checkboxes = document.getElementsByName('cid[]');
  for (var i = 0, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = source.checked;
  }
};
CIForm.actions = function(action) {
  var form = document.getElementById("frontForm");
  var elements = document.getElementsByName("cid[]");
  var isChecked = false;
  for (var i = 0; i < elements.length; i++) {
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
    return false;
  }
};