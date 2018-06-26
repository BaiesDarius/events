<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $iduser = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Introduceti un nume de utilizator.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Introduceti o parola.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT name_user, password_user FROM users WHERE name_user = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'Parola introdusa nu este buna.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'Nu exista un cont cu acest nume de utilizator.';
                }
            } else{
                echo "S-a produs o eroare. Te rugam sa incerci mai tarziu.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
    </style>
    <style type="text/css">
        #content {
            width:250px;
            height:150px;
    }
    </style>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="w3-top">
        <div class="w3-bar w3-black w3-card w3-left-align w3-medium">
            <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue">Acasa</a>
            <a href="categories.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue">Categorii</a>
            <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-blue w3-right">Autentificare</a>
            <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-blue w3-right">Inregistrare</a>
        </div>
    </div><br><br>
    <center>
        <div class="wrapper">
            <h2>Login</h2>
            <p>Introduceti informatiile de autentificare.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Numele utilizatorului</label>
                    <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Parola</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Nu aveti un cont? <a href="register.php">Creeaza cont.</a>.</p>
            </form>
        </div>    
    </center>
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
        <p>Created by Baies Darius-Florin</p>
    </footer>
</body>
</html>