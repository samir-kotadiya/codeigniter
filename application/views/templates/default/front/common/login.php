<div class="col-xs-12">
</div>
  <div class="wrapper">

  <?php
   $attributes = array("class" => "form-signin");
        echo form_open("common/login/login", $attributes); ?>    
          <?php if(!empty($this->session->flashdata('login_error'))){ ?>
                                    <div class="alert alert-danger">
					<i class="fa fa-exclamation-circle"></i> <?php echo $this->session->flashdata('login_error'); ?><button
						data-dismiss="alert" class="close" type="button">×</button>
				</div>
                                <?php } ?>
      <h2 class="form-signin-heading"><?php echo $lbl_login?></h2>
      <input type="text" class="form-control " name="username" placeholder="Email Address" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
         <div class="checkbox checkbox-warning">
                        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe">
                        <label for="checkbox2">
                         <div class="form_label"><?php echo $lbl_remember?></div>	
                        </label>
                    </div>
     
      <button class="btn btn-lg btn-primary btn-block btn-style" type="submit"><?php echo $lbl_login?></button>   
    </form>
  </div>