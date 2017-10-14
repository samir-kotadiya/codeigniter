<div class="col-md-12 main_testi_container">
  <div id="joblists" class="testimonials_lists_container">
    <?php foreach ($testimonials as $testimonial) { ?>
    <div class="testi_lists col-md-12">
      <div class="listing-title clearfix">
        <div class="col-md-12">
          <div class="col-md-3 testi_detail_image"> <img width="180" src="<?php echo $testimonial['logo']; ?>" /> </div>
          <div class="col-md-9">
            <div><?php echo $testimonial['content']; ?></div>
            <div class="text-warning"><?php echo $testimonial['firstname'].' '.$testimonial['lastname']; ?></div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="col-md-12 testi_add">
  <h2>Add New</h2>
</div>
<div class="col-md-12">
  <?php $this->load->view('templates/default/front/common/form'); ?>
</div>
