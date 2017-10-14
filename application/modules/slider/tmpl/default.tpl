{assign var="randomno" value={500|rand:1000}} 
<ul class="bxslider{$randomno}">
	{foreach from=$slides item=slide}
		<li><img src="{base_url()}{$slide}" alt="" /></li>	
	{/foreach}
</ul>

<script>
$(document).ready(function(){
	$('.bxslider{$randomno}').bxSlider({
	  captions: false,
	  responsive:true,
	  pager:false,
	  controls:false,
	  speed:800,
	  auto:true
	});
});
</script>