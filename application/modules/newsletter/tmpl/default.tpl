<div class="newslettermod">
	<div id="wrapper">
		<div class="col-sm-8 pull-left">
			<h3>Newsletter</h3>
			<div class="bottom_border"></div>
			<form class="newsletterform" id="newletterform" action="{$url}" method="post">
			<div class="form-group">
		
			<div class="col-xs-10">
						<input class="newsbox" type="text" name="email" placeholder="Email Address" />
							<input class="submit" type="submit" name="Sign Up" value="Sign Up" />
			</div>
			</div>
	
			
			</form>
		</div>
		<div class="col-sm-4 pull-right getintouch">
		<h3>Get in touch</h3>
			<div class="bottom_border"></div>
			<div class="gettouch_ico">
				<ul class="touch_ico">
					<li class="first"><a href="#"><div class="social_links facebook_link_image"></div></a></li>
					<li><a href="#"><div class="social_links pintrest_link_image"></div></a></li>
					<li><a href="#"><div class="social_links twitter_link_image"></div></a></li>
					<li class="gplus"><a href="#"><div class="social_links google_plus_link_image"></div></a></li>
				</ul>
			</div>
		</div>
		
	</div>
</div>

<script>
$(document).ready(function() {
    $('#newletterform').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            newsletter: {
                validators: {
                    emailAddress: {
                        message: ' '
                    }
                }
            }
        }
    });
});
</script>