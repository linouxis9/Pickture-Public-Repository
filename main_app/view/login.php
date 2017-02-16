<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Log-in</title>



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/picktures/refactor/css/panel.css">
<style>body { color: black; }</style>


  </head>

  <body>

<?php if ($_SESSION['stat'] == 1) { echo '<div class="alert alert-success" role="alert">You are registered ! Please Log In</div>'; } ?>
<div class="center">
    <div class="inner">
<?php if (isset($_SESSION['msg'])) { echo '<div class="alert alert-success" role="alert">'.$_SESSION['msg'].'</div>'; } ?>
  <form class="col-lg-12" method="POST" action="panel.php" enctype="multipart/form-data">
    <input type="text" name="login" placeholder="Login">
    <input type="password" name="key" placeholder="Password" value="">
    <input type="submit" name="submit" class="login login-submit" value="login">
  </form>

  <div class="login-help">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Register
</button> • <a href="#">Forgot Password</a>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Register Form</h4>
      </div>
      <div class="modal-body">
  <form class="login-card" method="POST" action="register.php" enctype="multipart/form-data">
    <input type="text" name="login" placeholder="Login">
    <input type="password" name="key" placeholder="Password" value="<?php echo $_GET['key']; ?>">
            <input type="submit" name="logind" class="login login-submit" value="Register">

</form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


</div>



  </body>
</html>
