<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="savedsearch-container col-sm-12 saved_search">
	 <div class="back_btn col-sm-12">
          <div class="myprofile">
         <a class="btn" href="<?php echo base_url("users/dashboard/account")?>"><i class="fa fa-backward"></i>&nbsp; back </a>
          </div>
      </div>
	<?php foreach($searches as $search){ ?>
	<div class="col-sm-12 search-lists">
		<div class="title col-sm-2">
			<a class="btn" href="<?php echo site_url('jobs/lists?searchid='.$search['id']); ?>"><?php echo $search['title']; ?></a>
		</div>
		<div class="actions col-sm-2">
			<a class="btn" onclick="return deletesavedsearch(<?php echo $search['id']; ?>,this);" href="#">Delete</a>
		</div>
	</div>
	<?php } ?>
</div>