<?php
  include("./config.php");
  if(isset($_SESSION['id'])){ //onLoad Page Data
    $userid=$_SESSION['id'];
    $sql="SELECT user_id,username FROM user_master WHERE user_id=$userid";
    $result=$conn->query($sql);
    $data=mysqli_fetch_array($result);  
  }
  else{
    echo "<script>alert('Alert! Please select user.');</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | Change Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="hold-transition register-page">
<!--main containt-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./user_profile.php">Profile</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User <b><?php echo $data['username'];?></b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="./phpsrc/change_user_profile_password_db.php" name="change_password" id="change_password" method="post" enctype='multipart/form-data'>
                <div class="card-body">
                    <div class="row">    
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="repassword">Currunt Password <span class="required">*</span></label>
                            <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Currunt password">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="Password">New Password <span class="required">*</span></label>
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder=" New Password">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="repassword">Confirm Password <span class="required">*</span></label>
                            <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Retype New password">
                          </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnchange" class="btn btn-primary">Change</button>
                  <a href=./user_profile.php><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!--main containt-->
<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- jquery-validation -->
<script src="./plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>
<script>
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      var data=$('#change_password').serialize();

      $.ajax({
        url:form.attr('action'),
        method:"post",
        data:data,
      });
    }
  });
  $('#change_password').validate({
    rules: {
      oldpassword: {
        required: true,
        remote:{
          url:"./phpsrc/check_user_profile_password_db.php",
          method:"post",
          data:{
            uname:function(){
              return $("#oldpassword").val();
            }
          }
        },
      },
      newpassword: {
        required: true,
        minlength:5
      },
      repassword: {
        required: true,
        minlength:5,
        equalTo:"#newpassword"
      },
      
    },
    messages: {
      oldpassword: {
        required: "Please enter currunt password",
        remote:"password is not match",
      },
      newpassword: {
        required: "Please provide a password",
      },
      repassword: {
        required: "Please provide a password",
      },
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>