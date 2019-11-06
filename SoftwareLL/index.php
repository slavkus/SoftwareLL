<!DOCTYPE html>

<?php

require 'DB/db.php';
require 'DB/session.php';

if (isset($_POST['loginBtn'])) {
    
    $error = "";
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error .= $key . " not inserted. \n";
        }
    }
    var_dump($error);
    if (empty($error)) {

        $mail_to = "bluebloodslaiver1@gmail.com";
        $mail_from = "From: SoftwareLL login";
        $mail_subject = "Date & Time of login: ";
        $mail_body = date("Y-m-d h:i:sa");

        mail($mail_to, $mail_subject, $mail_body, $mail_from);

        echo "Connecting to DB... \n";
        
        $connection = new DB();
        $connection->connectDB();

        //Prijava
        $username = $_POST['usernameLogin'];
        $password = $_POST['passwordLogin'];
        $query = "SELECT * FROM korisnik WHERE "
                . "korisnicko_ime='{$username}' "
                . "AND lozinka='{$password}'";
        $result = $connection->selectDB($query);

        $authenticated = false;
        while ($row = mysqli_fetch_array($result)) {
            if ($row) {
                $authenticated = true;
                $type = $row['id_korisnik'];
            }

            if ($authenticated) {
                echo "Log in successful! \n";
                Session::createUser($username, $type);

                $ispis = Session::getUser();
                echo $ispis;
            } else {
                echo "Log in was unsuccessful! \n";
            }
        }

        $connection->closeDB();
    }
}

if (isset($_POST['registerBtn'])) {
    $error = "";
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error .= $key . " not inserted.";
        }
    }
    if (isset($_POST['nameRegister']) 
            && isset($_POST['surnameRegister']) 
            && isset($_POST['usernameRegister']) 
            && isset($_POST['passwordRegister']) 
            && isset($_POST['emailRegister'])) {
        if (empty($error)) {
            echo "Connecting to DB \n";
            
            $connection = new DB();
            $connection->connectDB();

            $name = $_POST['nameRegister'];
            $surname = $_POST['surnameRegister'];
            $username = $_POST['usernameRegister'];
            $password = $_POST['passwordRegister'];
            $email = $_POST['emailRegister'];
            $query = "INSERT INTO korisnik (uloga_korisnika_id_uloga, ime, prezime, "
                    . "korisnicko_ime, lozinka, email) VALUES ('{3}','{$name}','{$surname}','{$username}','{$password}','{$email}')";
            $result = $connection->selectDB($query);

            $connection->closeDB();
        }
    }
}

?>


<html>
    <head>
        <title>SoftwareLL</title>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">

        <meta name="title" content="SoftwareLL">
        <meta name="author" content="Ivan Slavko Matić">
        <meta name="keywords" 
              content="license, price, 
              company">

        <link href="css/main.css" 
              rel="stylesheet" type="text/css">

        <script type="text/javascript" src="javascript/main_jscript.js">
        </script>

    </head>
    <body>
        <header style="font-weight:bold">
            <h1 id="headerID">SoftwareLL</h1>
        </header>
        <nav>
            <ul>
                <li style="background-color: #007AA4;"><a href="ostalo/multimedija.html">Home</a></li>
                <li><a href="ostalo/multimedija.html">Gallery</a></li>
                <li><a href="ostalo/popis.html">Tables</a></li>   
                <li><a href="navigacijski.html">Documentation</a></li> 
                <li style="cursor: pointer" onclick="document.getElementById('modalLoginButton').style.display = 'block'" style="width:auto;"><a>Log in</a></li> 
                <li style="cursor: pointer" onclick="document.getElementById('modalRegisterButton').style.display = 'block'" style="width:auto;"><a>Registration</a></li> 
            </ul>
            <hr>
        </nav>

        <!-- Login form -->

        <!-- The Modal -->
        <div id="modalLoginButton" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="login" action="">

                <div class="container">
                    <h2 style="color: gray">Login</h2>
                    <label for="usernameLogin" style="color: gray;"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="usernameLogin" required>

                    <label for="passwordLogin" style="color: gray;"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="passwordLogin" required>
                    <br>
                    <label style="color: gray"> Remember me</label>
                    <input type="checkbox" checked="checked" name="rememberMeCheckbox">
                    <br><br>
                    <input name="loginBtn" type="submit" value="Log in" class="inputLoginButton">&nbsp
                    <button type="button" onclick="document.getElementById('modalLoginButton').style.display = 'none'" class="cancelBtn">Cancel</button>

                </div>
            </form>
        </div>
        
        <!-- Registration form -->
        
        <!-- Modal -->
        <div id="modalRegistrationButton" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="register" action="">

                <div class="container">
                    <h2 style="color: gray">Registration</h2>
                    <label for="nameRegister" style="color: gray;"><b>Name</b></label>
                    <input type="text" placeholder="Name" name="nameRegister" required>
                    
                    <label for="surnameRegister" style="color: gray;"><b>Surname</b></label>
                    <input type="text" placeholder="Surname" name="surenameRegister" required>
                    
                    <label for="emailRegister" style="color: gray;"><b>Email</b></label>
                    <input type="text" placeholder="Email" name="emailRegister" required>
                    
                    <label for="usernameRegister" style="color: gray;"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="usernameLogin" required>

                    <label for="passwordRegister" style="color: gray;"><b>Password</b></label>
                    <input type="password" maxlength="15" placeholder="Password" name="passwordRegister" required>
                    
                    <label for="repeatPassword" style="color: gray;"><b>Repeat password</b></label>
                    <input type="password" maxlength="15" placeholder="Repeat password" name="repeatPassword" required>
                    <br>
                    <input name="registerBtn" type="submit" value="Register" class="inputRegisterButton">&nbsp
                    <button type="button" onclick="document.getElementById('modalRegisterButton').style.display = 'none'" class="cancelBtn">Cancel</button>

                </div>
            </form>
        </div>

        <footer class="footer">
            <p><strong>Name & Surname: </strong>Ivan Slavko Matić</p>
            <p><strong>Last updated: </strong>Listopad, 2019. </p>
            <address><strong>Email: </strong><a href="mailto:bluebloodslaiver1@gmail.com">bluebloodslaiver1@gmail.com</a></address>
            <figure id="footer">
                <a href="http://validator.w3.org/#validate_by_uri+with_options">
                    <img src="multimedia/HTML5.png" 
                         alt="HTML5 validator" width="50" height="50"></a>
                <a href="http://jigsaw.w3.org/css-validator/">
                    <img src="multimedia/CSS3.png" 
                         alt="CSS validator" width="50" height="50"></a>
            </figure>
        </footer>
    </body>
</html>