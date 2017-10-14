<div class="recentjobscontainer row mt col-sm-8">
	<h2>{$title}</h2>
	<div class="bottom_border"></div>
	<div class="recentjobs col-xs-12">
	{foreach from=$recentjobs item=value}
		   <div class="jobrow col-xs-12">
		   	 	<div class="col-sm-2">
					 {$value.logo}		 
			    </div>
				
			    <div class="col-sm-3 rec_job_val_title rec_job_align_single">
			    	<b><a class="job_title" href={$value.link}>{$value.title}	</a></b> <br/>
					{$value.company}
			    </div>
		         
			     <div class="col-sm-2 rec_job_city rec_job_align_single">
			     	<span class="glyphicon glyphicon-map-marker">
				 		<span class="default_font">{$value.name}</span>
				 	</span>
			     </div>
				 
			      <div class="col-sm-2 rec_job_align_single">
				 	<span class="glyphicon glyphicon-time">
				 		<span class="default_font">{$value.jobtype}</span>
					</span>
			     </div>
				 
			      <div class="col-sm-3 rec_job_align_single">
				  	<span class="glyphicon glyphicon-usd">
				  		<span class="default_font">{$value.min_salary}-{$value.max_salary}</span>
				  	 </span>
			     </div>
			   </div>
		   {/foreach}
	</div>
</div>
