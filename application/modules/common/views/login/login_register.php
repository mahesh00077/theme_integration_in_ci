<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?=base_url();?>"><b>aT</b>oz</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register</p>
    <?php $error = $this->session->flashdata("error");?>
    <?php if ($error) {?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=$error;?>
      </div>
    <?php }?>
    <?php $success = $this->session->flashdata("success");?>
    <?php if ($success) {?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=$success;?>
      </div>
    <?php }?>
    <form action="add-register" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?=form_error('name', "<p class='text-danger'>", "</p>");?>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?php echo set_value('mobile_no'); ?>" placeholder="Mobile">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('mobile_no', "<p class='text-danger'>", "</p>"); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email_id" id="email_id" value="<?php echo set_value('email_id'); ?>" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email_id', "<p class='text-danger'>", "</p>"); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('username', "<p class='text-danger'>", "</p>"); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password', "<p class='text-danger'>", "</p>"); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <?php echo form_error('c_password', "<p class='text-danger'>", "</p>"); ?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!-- <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <!-- <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a> -->
    </div>

    <a href="<?php echo base_url('login'); ?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
