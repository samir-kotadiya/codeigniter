<div class="col-xs-12">
   <div class="col-xs-12">
   	<div class="text-center state_title">
   		<h1 class="stats-overview"><span class="stats_title">{$title}</span></h1>
   		{$desc}<br>
   		{$desc2}		
   	</div>
   </div>

<div class="col-xs-12 circle-padding">
	<div id="wrapper">
   		<div class="col-sm-3">
		   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			     <a href="{site_url('jobs/lists')}">
			         <div class="text-center text-style">
			         	<span class="glyphicon glyphicon-bullhorn text-style"><span class="left-spacer">{$totaljobs}</span></span><br>
			         	{$offers}		
			          </div>
			     </a>
			     </div>
		   </div>
    	   </div>
	</div>
   		<div class="col-sm-3">
		   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			     <a href="{site_url('users/resumes')}">
			         <div class="text-center text-style">
			            <span class="glyphicon glyphicon-file text-style"><span class="left-spacer">{$totaljobseekers}</span></span><br>
			            {$resume}		
			          </div>
			     </a>
			     </div>
		   </div>
    	   </div>
    </div>
    <div class="col-sm-3">
	   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			     <a href="{site_url('users/companies')}">
			         <div class="text-center text-style">
			       		 <div class="text-center text-style">
				            <span class="glyphicon glyphicon-briefcase text-style"><span class="left-spacer">{$totalemployes}</span></span><br>
				            {$company}		
				          </div>
			         </div>
			     </a>
			     </div>
		   </div>
	   </div>
    </div>
    	<div class="col-sm-3">
		   	<div class="col-sm-8">
		   	<div class="circle circle-border">
			     <div class="circle-inner">
			         <div class="text-center text-style">
			            <span class="glyphicon glyphicon-user text-style"><span class="left-spacer">{$totalmembers}</span></span><br>
			            {$members}		
			          </div>
			     </div>
		   </div>
    	   </div>
    </div>
	</div>	
</div>
</div>