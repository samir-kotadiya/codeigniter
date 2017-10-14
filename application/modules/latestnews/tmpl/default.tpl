<div class="row mt col-xs-12 latestnewsmodule">
	<div class="row mt col-xs-12">
		<center>
			<h2>{$title}</h2>
			<div class="latestnews_msg">{$message}</div>
		</center>
	</div>
<div class="col-xs-12">

	{foreach from=$latestnews item=value}
		<div class="col-sm-4">
		<div class="col-xs-12">{$value.images}</div>
		<div class="col-xs-12 news_title"><h2><a href={$value.link}>{$value.name}</a></h2></div>
		<div class="col-xs-12 newsdate"><h5><span class="glyphicon glyphicon-calendar"><span class="default_font"> {$value.created_date} </span></span></h5></div>
		<div class="col-xs-12 news_desc">{$value.description}</div>
		<div class="col-xs-12 newsreadmore"><a href={$value.link}><div class="btn btn-sm btn-warning readmore" type="submit">Read More</div></a></div>
		</div>
	{/foreach}

</div>
</div>
