<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
    $this->load->view("themes/v_title");
    $this->load->view("themes/$THEMES/v_head"); 
    $this->load->view("themes/assets/v_head",$ASSETS);
  ?>
  </head>
  <body>
  {MESSAGE}
  <!-- Page content -->
  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Content area -->
      <h4 class="mb-0" align="center" style="font-weight: bold; font-size: 25px; margin-top: 50px;">{APP_NAME}</h4>
			<div class="content d-flex justify-content-center align-items-center" style="margin-top: -50px;">
        <!-- Login form -->
        <form class="login-form form-horizontal cmxform" method="post" id="commentForm" action="{BASE_URL}pages/login">
          
          <div class="card mb-0">
            <i class="p-4" align="center">
            <img src="{BASE_URL}img/logo.png" class="card-img-top" alt="Image" style="width: 150px;">
            </i>
            <div class="card-body">
              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" name="user" id="user" placeholder="Username" required>
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
              </div>

              <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>

              <?php
              if(in_array('g-recaptcha',$ASSETS)){
              ?>
                <div class="g-recaptcha" data-sitekey="6Lf7WCUTAAAAANJ2ZMQ1Xvum9wXMo_6tGcl_rYej" style="transform: scale(0.9); transform-origin: 0 0;"></div>
              <?php
              }
              ?>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="btnLogin" value="login"> Login <i class="icon-circle-right2 ml-2"></i></button>
                <!-- <a href="{BASE_URL}pages/register" class="btn btn-success btn-block"> Register <i class="icon-circle-right2 ml-2"></i></a> -->
              </div>
            </div>
          </div>
        </form>
        <!-- /login form -->
      </div>
      <!-- /content area -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
  <?php 
    $this->load->view("themes/$THEMES/v_js"); 
    $this->load->view("themes/assets/v_js",$ASSETS);
  ?>
  </body>
</html>