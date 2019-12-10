<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create New Project
        <!-- <small>Preview</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">create new project</a></li>
        <!-- <li class="active">Advanced Elements</li> -->
      </ol>
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
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!--  -->
      <!-- /.box -->
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Project</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo base_url('import-zip'); ?>" method="post" autocomplete="off" enctype='multipart/form-data'>
              <div class="box-body">
                <div class="row">
                   <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Project Name</label>
                  <input type="text" class="form-control" id="prj_name"  name="prj_name" placeholder="Enter Project Name">
                  <?php echo form_error('prj_name', "<p class='text-danger'>", "</p>"); ?>
                </div>
              </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputFile">Upload Zip file</label>
                  <input type="file" name='file'>

                  <?php echo form_error('file', "<p class='text-danger'>", "</p>"); ?>

                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                   <label for="exampleInputFile">Zip structure &nbsp;<i class="fa fa-hand-o-right"></i><p class="help-block text-red"> (need index.html file)</p></label>
                  <img src="<?base_url();?>assets/ss.png">

                </div>
              </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputFile">find and add siderbar start & end string(And add also comment u see in img )</label>
                  <input type="text" name='sidebar_start' value="<?php echo set_value('sidebar_start') ?>" placeholder="Enter ur siderbar start string">

                  <?php echo form_error('sidebar_start', "<p class='text-danger'>", "</p>"); ?><br>
                  <input type="text" name='sidebar_end' value="<?php echo set_value('sidebar_end') ?>" placeholder="Enter ur siderbar end string">

                  <?php echo form_error('sidebar_end', "<p class='text-danger'>", "</p>"); ?>

                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                   <label for="exampleInputFile">Check before submit &nbsp;<i class="fa fa-hand-o-down"></i><p class="help-block text-red"> (need in index.html add comments for start & end of sidebar)</p></label>
                  <img src="<?base_url();?>assets/ss1.jpg" width="90" height="80">
                  <p class="help-block text-red"> (right click and view image u understood)</p>
                </div>
              </div>
            </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


        </div>
    </section>
    <!-- /.content -->
    </div>