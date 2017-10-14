<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12 dashboard">
  <?php 
foreach ($links as $link)
{
	?>
  <div class="col-md-3">
    <div class="img_name_container"> <a href="<?php echo $link['link']; ?>"> <img src="<?php echo $link['image']; ?>" alt=""> <br>
      <span><?php echo $link['title']; ?></span> </a> </div>
  </div>
  <?php 
}
?>
</div>
