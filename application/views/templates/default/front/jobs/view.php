<?php $inc = 0; $user = getUser(); ?>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<div class="wrapper hidden-print">
    <div id="messagestatus"></div>
	<div id="wrapper" class="row">
		<div class="col-md-12 job_detail_list_container">
		<div class="col-md-9 job_detail_list">
			<div class="jobdetail-container clearfix">
				<div class="jobdetail-title col-md-12">
					<?php echo $job['title']; ?>
				</div>
				<div class="jobdetail-misc col-md-12">
					<div class="jobdetail-misc1 col-md-6">
						<div class="jb_id col-md-12"><div class="col-md-3"><?php echo 'Job id'; ?></div><div class="col-md-9"><?php echo $job['id']; ?></div></div>
						<div class="jb_location col-md-12"><div class="col-md-3"><?php echo 'Location'; ?></div><div class="col-md-9"><?php echo $job['location']; ?></div></div>
						<div class="jb_cat col-md-12"><div class="col-md-3"><?php echo 'Category'; ?></div><div class="col-md-9"><a href="<?php echo site_url('jobs/lists?category='.$job['category_id']); ?>"><?php echo $job['titlecategory']; ?></a></div></div>
						<div class="jb_sal col-md-12"><div class="col-md-3"><?php echo 'Salary'; ?></div><div class="col-md-9"><?php echo"Min ".$job['min_salary']." - "."Max ".$job['max_salary']; ?></div></div>
					</div>
					<div class="jobdetail-misc2 col-md-6">
						<div class="jb_hits col-md-12"><div class="col-md-5"><?php echo 'Job view'; ?></div><div class="col-md-7"><?php echo $job['hits']; ?></div></div>
						<div class="jb_zip col-md-12"><div class="col-md-5"><?php echo 'Zip code'; ?></div><div class="col-md-7"><?php echo $job['zip_code']; ?></div></div>
						<div class="jb_emp_type col-md-12"><div class="col-md-5"><?php echo 'Employment type'; ?></div><div class="col-md-7"><?php echo $job['titletype']; ?></div></div>
						<div class="jb_min_sal col-md-12"><div class="col-md-5"><?php echo 'Posted'; ?></div><div class="col-md-7"><?php echo $job['min_salary'].$job['max_salary']; ?></div></div>
					</div>
				</div>
				
				<div class="jobdetail-description col-md-12">
					<div class="jobdetail-company-info">
						<div class="description-heading"><?php echo 'Company Info'; ?></div>
						<div class="jb_company_logo"><img src="<?php echo $job['company_logo']; ?>" alt="" /></div>
						<div class="jb_comp_title"><h3><?php echo $job['company']; ?></h3></div>
						<div class="jb_phn col-md-12">
						<div class="col-md-1">
						<b><?php echo 'Phone'; ?> :</b> </div>
						<div class="col-md-11">
						<?php echo $job['workphone']; ?>
						</div>
						
						</div>
						<div class="jb_comp_website col-md-12">
						<div class="col-md-1">
						<b><?php echo 'Website'; ?> :</b>
						</div>
						<div class="col-md-11">
						 <?php echo $job['company_website']; ?>
						</div>
						 </div>
					</div>
					
					
					<div class="jobdetail-job-info col-md-12">
						<div class="description-heading"><?php echo 'Job Description'; ?></div>
						<div class="jb_desc"><?php echo $job['description']; ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 job_act_right">
			<div class="jaction">
				<div class="jobactions">
					<span class="job-action action_btn active"><a onClick="applyjob(<?php echo $job['id']; ?>,<?php echo $user->id; ?>); return false;" href="#"><i class="fa fa-check-square-o"></i>&nbsp;Apply Now</a></span>
					<span class="job-action action_btn"><a onClick="window.print(); return false;" href=""><i class="fa fa-print"></i>&nbsp;Print This Job</a></span>
					<span class="job-action action_btn" ><a data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-map-marker"></i>&nbsp;Map View</a></span>
					
					<?php if($user->id != 0 && $user->group_id == 3){ ?>
					<span class="job-action action_btn" ><a onClick="savejob(<?php echo $job['id']; ?>,<?php echo $user->id; ?>);" href="#"><i class="fa fa-save"></i>&nbsp;Save This Job</a></span>
					<?php } ?>
					
					<span class="job-action action_btn"><a href="http://www.addthis.com/bookmark.php?v=250" class="addthis_button action_btn"><i class="fa fa-share-alt"></i>&nbsp;Share This Job</a></span>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>


<div class="wrapper visible-print-block">
	<div class="row">
		<div class="col-md-12">
			<div class="jobdetail-container clearfix">
				<div class="pull-left">
					<h3>Company profile</h3>
				</div>
				<table class="table table-responsive">
					<tbody>
						<tr class="table-heading">
							<td width="20%"><img alt="<?php echo $job['company']; ?>"
								src="<?php echo $job['company_logo']; ?>"></td>
							<td width="80%">
								<div>
									<span><b>Company:</b></span> <span><?php echo $job['company']; ?></span>
								</div>
								<div>
									<span><b>Website:</b></span> <span><a target="_blank"
										href="<?php echo $job['company_website']; ?>"><?php echo $job['company_website']; ?></a></span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<table class="table table-responsive job-detail-table">
					<tbody>
						<tr class="table-heading">
							<td colspan="2"><b>Job Detail</b></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Title:</b></td>
							<td width="80%"><?php echo $job['title']; $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Description:</b></td>
							<td width="80%"><?php echo $job['description']; $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Category:</b></td>
							<td width="80%"><?php echo $job['titlecategory']; $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Type:</b></td>
							<td width="80%"><?php echo $job['titletype']; $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Salary:</b></td>
							<?php $salaryarray = array($job['min_salary'],$job['max_salary']); ?>
							<td width="80%"><?php echo implode(' - ', $salaryarray); $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Featured:</b></td>
							<td width="80%"><?php echo ($job['featured'])?'Yes':'No'; $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Address:</b></td>
							<td width="80%">
						<?php echo $job['location']; ?>	
                        <?php $inc++; ?>
                      </td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Zip Code:</b></td>
							<td width="80%"><?php echo $job['zip_code']; $inc++; ?></td>
						</tr>
						<tr class="<?php echo ($inc%2==0)?'odd':'even'; ?>">
							<td width="20%"><b>Job Tags:</b></td>
							<td width="80%">
						<?php $tags = array(); ?>
                        <?php foreach ($job['tags'] as $tag){
                            $tags[] = '<a href="'.site_url('jobs/lists/search?tag='.$tag).'">'.$tag.'</a>';
                        } ?>
                        <?php echo implode(',', $tags); $inc++; ?>
                      </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body">
        <div id="mapCanvas" style="height: 500px"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function initialiseMap() {
	var lat = '';
	var lng = '';
	jQuery.ajax({url: "http://maps.googleapis.com/maps/api/geocode/json?address="+<?php echo $job['zip_code']; ?>+"&sensor=true",
		async: false, 
		success: function(result){
			jQuery(result.results).each(function(){
				lat = this.geometry.location.lat;
				lng = this.geometry.location.lng;
			});
		}
	});

  var mapOptions = {
    center: new google.maps.LatLng(lat, lng),
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("mapCanvas"),
    mapOptions);
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(lat, lng)
  });
  marker.setMap(map);
}
$("#myModal").on("shown.bs.modal", function () {
	initialiseMap();
});
</script>
