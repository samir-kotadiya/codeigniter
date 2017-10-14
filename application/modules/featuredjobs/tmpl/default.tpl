<div class="row mt col-sm-4 pull-right featured_jobs">
<div class="col-lg-12">
	<h2>{$title}</h2>
	<div class="bottom_border"></div>
</div>
  <div class="col-lg-12">
    <ul class="featuredjobs">
      {$title}
      {foreach from=$featuredjobs item=value}
      <li>
        <div class="joblist"> 
			<div class="col-xs-12 featured_mod_img"> 
			{$value.logo} 
			</div>
			
			<div class="col-xs-12 featured_jobs_status"> 
				<div class="feaured-jobtitle">
				<a href={$value.link}><b>{$value.title}</b></a>
				</div> 
				<div class="feaured-jobcompany">
				{$value.company}
				</div>
			</div>
			<div class="col-xs-12 featured_jobs_loc_container"> 
				<div class="col-xs-4"><span class="glyphicon glyphicon-map-marker"><span class="left-spacer"><span class="default_font">{$value.cityname}</span></span></span> </span></div>
				<div class="col-xs-4 jobtype"><span class="glyphicon glyphicon-time"><span class="left-spacer"><span class="default_font">{$value.jobtype}</span></span></span> </div>
				<div class="col-xs-4 featured_salary"><span class="glyphicon glyphicon-usd"><span class="left-spacer"><span class="default_font">{$value.min_salary}-{$value.max_salary}</span></span></span> </div>
			</div>
	        <div class="col-xs-12 featured_job_desc"> 
          		{$value.description} 
			</div>
		</div>
      </li>
      {/foreach}
    </ul>
  </div>
  <script type="text/javascript">
	$(document).ready(function(){
	  	$('.featuredjobs').bxSlider({
	  		tickerHover:true,
		  	auto: false,
		  	controls:false
		});
	});
	</script>
</div>
