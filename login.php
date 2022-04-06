<?php
require_once('DBSettings.php');
require_once('header.php');
ini_set('display_errors', 1);
if(!func::checkLogin($con)) {
    if (isset($_POST['submit'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = $_POST['username'];
            $pass = sha1($_POST['password']);
            $sql = "select * from `users` where `user_username` = :user and `user_password` = :pass";
            $stmt = $con->prepare($sql);
            $stmt->execute([":user" => $user, ":pass" => $pass]);
            //var_dump($stmt);exit;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($row);$$
                if (is_array($row) > 0) {
                    $renember = 0;
                if (isset($_POST['remember'])) {
                    $renember = 1;
                }
                func::recordSession($con, $row['user_id'], $row['user_username'], $renember);
                header("location: index.php");
                }else {
                    $error = 1;
                    $errormsg = "Usuario o contraseña no validos"; 
                }
        }
    }
        
    } else{
            header("location: index.php");
    }

?>

    <div class="container">
                 <div class="message">
        <?php if (isset($error)) {
            echo "<span class='error" . $error . "'>" . $errormsg . "</span>";
        } ?>  
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                
            <form class="login" action="<?php echo $_SERVER[
                "PHP_SELF"
            ]; ?>" method="post">
              <h2>Login Form</h2>
              <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="username"  name="username" placeholder="Username">
                  <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  <label for="floatingPassword">Password</label>
                </div>
            <div class="form-container">
                  <div class="mb-3 form-check  mt30">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="exampleCheck1" name="remember">Remember Me</label>
                  </div>
                  <div class="">
                      <i class="fa fa-arrow-right"></i><a href="register.php"  class="link-success">Sign Up</a>
                  </div>
              </div>
              <div class="pushright">
                  <input type="submit" name="submit" value="LOG IN" class="btn btn-primary">
              </div>
            </form>
            </div>
             <div class="col-md-4"></div>
        </div>
    </div>
    
    <?php require_once("footer.php");
?>
