<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b>aToz</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
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
    <form action="login" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" name="ume" value="<?php echo set_value('ume'); ?>" class="form-control" placeholder="Username/Mobile/Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?=form_error('ume', "<p class='text-danger'>", "</p>");?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?=form_error('password', "<p class='text-danger'>", "</p>");?>
      </div>
      <div class="row">
        <div class="col-xs-8">
<!--           <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_me" value="1"> Remember Me
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <!-- <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a> -->
    </div>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="<?php echo base_url('register'); ?>" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
