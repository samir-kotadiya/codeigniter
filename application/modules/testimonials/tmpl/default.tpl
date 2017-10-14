<div class="row mt col-xs-12 testimonials_module">
	<div id="wrapper">
		<div class="row mt col-xs-12">
			<center>
				<h2>{$title}</h2>
				<div class="testimonial_msg">{$tagline}</div>
			</center>
		</div>
		<div class="col-xs-12 testimonial_list">
			{foreach from=$testimonials item=value}
				<div class="col-sm-6">
					<div class="col-sm-3"><img src="{$value.logo}"></div>
					<div class="col-sm-9">
						<div class="testimonial_content">{$value.content}</div>
						<div class="testimonial_authore">{$value.firstname}&nbsp;{$value.lastname}</div>
						<div class="testimonial_company">{$value.company}</div>
					</div>
				</div>
			{/foreach}
		</div>
		<div class="col-xs-12">
			<center><a class="btn btn-default" href="{$link}" role="button">{$readall}</a></center>
		</div>
	</div>
</div>
