<div id="login">
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
          <form id="login-form" class="form" method="post">
            <h3 class="text-center text-info">Login</h3>
            <div class="form-group">
              <label for="username" class="text-info">Username:</label><br>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="text-info">Password:</label><br>
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
              <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
              <p class="error-message"><?= isset($errors[0]) ? $errors[0] : null; ?></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php //debug($errors); ?>