<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css" />
    <title>92 Login Page</title>
  </head>

<style>
  .error-message {
    color: red;
    margin-top: 10px;
    text-align: center;
    font-size: 0.9em;
}
</style>
  
  <body>
    <div class="login-form">
      <div class="img1">
        <img
          src="img/Firefly.jpg"
          alt="92 Finacial Solutions"
          width="200px"
          height="200px"
        />
      </div>

      <h2>Login</h2>
      <div class="input">
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input
              class="userbtn"
              type="text"
              id="e_login"
              name="e_login"
              required
            />
            
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input
              class="passbtn"
              type="password"
              id="password"
              name="password"
              required
            />

            <?php
          session_start();
          if (isset($_SESSION['login_error'])) {
              echo '<p class="error-message">' . $_SESSION['login_error'] .'</p>';
              unset($_SESSION['login_error']); // Clear the error message
          }
          ?>
            </div>

        <div>

          <div class="form-group">
            <input type="checkbox" value="lsRememberMe" id="rememberMe" />
            <label for="rememberMe">Remember me</label>
          </div>

          <div class="s-login">
            <div class="login">
              <input type="submit" value="Login" />
            </div>
          </div>
        </form>
      </div>

      <label>Not registered yet?</label>
        <div class="input">
    
                <div class="s-login">
                    
                    <div class="signup">
                        <a href="register.html" target="_blank">Sign-up</a>
                        
                    </div>

                </div>
            </form>
        </div>
    </div>

    </div>

    

    <footer>
      <p>92 Finacial Solutions - Design By Gabriel Da Mota 2023.</p>
    </footer>
  </body>
</html>
