<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<form id="frontForm" method="post" class="myjoblistform">
  <div class="col-md-12 align-right myjoblist_btn_div">
   <div class="back_btn col-sm-12">
          <div class="myprofile">
              <a class="btn" href="<?php echo base_url("users/dashboard/account")?>"><i class="fa fa-backward"></i>&nbsp; back </a>
          </div>
      </div>
    <div class="pull-right">
      <button class="btn "
              onclick="return CIForm.actions('publish');"> Publish </button>
      <button class="btn"
              onclick="CIForm.actions('unpublish');"> Unpublish </button>
      <button class="btn" onclick="return CIForm.actions('delete');"> Delete </button>
    </div>
  </div>
  <div class="col-md-12 joblist_main_container">
    <div id="joblists" class="joblists-container">
      <div class="col-xs-12 job_titlerow">
         <div class="pull-left col-sm-1 jobselectbox">
      <input type="checkbox" id="selectall" onclick="CIForm.checkall(this);" />
       <label for="selectall"></label>
    </div>
        <div class="col-sm-3 job_title1">
          <strong> Title</strong>
        </div>
        <div class="col-sm-2 job_id1">
          <strong>Job ID</strong>
        </div>
        <div class="col-sm-2 post_id1">
            <strong>Posted</strong>
        </div>
        <div class="col-sm-1 active_1">
            <strong>Active</strong>
        </div>
        <div class="col-sm-2 text-center jobview1">
            <strong>No of Views</strong>
        </div>
        <div class="col-sm-1 text-center application">
            <strong>Applications </strong>   
        </div>
      </div>

      <?php foreach ($jobs as $key=>$job) { ?>
       <div class="myjob_list_container">
	   <div class="col-xs-12">
         <div class="pull-left col-sm-1 jobchkcontent">
           <input type="checkbox"  id="cb<?php echo $key+1; ?>" name="cid[]"
                value="<?php echo $job['id']; ?>" />
           <label for="cb<?php echo strtolower($key+1); ?>"></label>
    </div>
        <div class="col-sm-3 job_content_title">
          <a href="<?php echo base_url('jobs/Job/edit/id/'.$job['id'])?>"><?php echo $job['title']?></a>
        </div>
        <div class="col-sm-2 job_content_id">
          #  <?php echo $job['id']?>
        </div>
        <div class="col-sm-2 job_content_date">
            <?php echo $job['created']?>
        </div>
        <div class="col-sm-1 job_content_yesno">
             <?php  if($job['published'] == 1) echo "Yes";else echo "No"; 

            ?>
        </div>
        <div class="col-sm-2 text-center job_content_hits">
             <?php echo $job['hits']?>
        </div>
        <div class="col-sm-1 text-center job_content_app">
           <a href="<?php echo base_url('jobs/ResumeLists/listresume/id/'.$job['id'])?>"><?php echo $job['application']?></a>
        </div>
      </div>
       <div class="col-xs-5 pull-right jobs_action_btn">
           <div class="col-sm-2">
              <a class="btn" href="<?php echo base_url('jobs/Job/edit/id/'.$job['id'])?>"> Edit </a>
           </div>
           <div class="col-sm-4">
               <a class="btn" href="<?php echo base_url('jobs/Mylists/clonejob/cid/'.$job['id'])?>"> Colone Job </a>
           </div>
           <div class="col-sm-4">
               <a class="btn" href="<?php echo base_url('jobs/Mylists/unpublish/cid/'.$job['id'])?>">  Deactive </a>
           </div>
           <div class="col-sm-2">
              <a class="btn" href="<?php echo base_url('jobs/Mylists/delete/cid/'.$job['id'])?>"> Delete </a>
           </div>
       </div>
		</div>
      <?php } ?>
    </div>
  </div>
  <input type="hidden" name="frmaction"
              value="<?php echo site_url('jobs/Mylists/'); ?>" />
</form>
<script>
CIForm = window.CIForm || {};
CIForm.submitform = function() {
  form = document.getElementById("frontForm");
  form.submit();
};
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

</script>
