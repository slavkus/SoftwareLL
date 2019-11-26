<!DOCTYPE html>

<?php
require '../DB/db.php';
require '../DB/session.php';
Session::createSession();
$session_user = $_SESSION[Session::USER];

echo $session_user . " Session user.";

if (!empty($session_user)) {
    echo '<script type="text/javascript">$(document).ready(function () { ShowLogout(); });</script>';
} else if (isset($_POST['loginBtn'])) {
    $error = "";
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error .= $key . " not inserted. \n";
        }
    }
    //var_dump($error);
    if (empty($error)) {

        $mail_to = "bluebloodslaiver1@gmail.com";
        $mail_from = "From: SoftwareLL login";
        $mail_subject = "Date & Time of login: ";
        $mail_body = date("Y-m-d h:i:sa");

        mail($mail_to, $mail_subject, $mail_body, $mail_from);

        //echo "Connecting to DB... \n";

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
                echo "Log in was successful! \n";
                Session::createUser($username, $type);
                $ispis = Session::getUser();
                echo '<script type="text/javascript">$(document).ready(function () { ShowLogout(); });</script>';

                echo $ispis . "logged in.";
            } else {
                echo "Login was unsuccessfull";
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
    //var_dump($error);
    if (empty($error)) {

        //echo "Connecting to DB \n";
        $connection = new DB();
        $connection->connectDB();

        $name = $_POST['nameRegister'];
        $surname = $_POST['surnameRegister'];
        $username = $_POST['usernameRegister'];
        $password = $_POST['passwordRegister'];
        $email = $_POST['emailRegister'];
        $query = "INSERT INTO korisnik (ime, prezime, "
                . "korisnicko_ime, lozinka, email) VALUES ('{$name}','{$surname}','{$username}','{$password}','{$email}')";
        $result = $connection->selectDB($query);

        $connection->closeDB();
    }
}
?>


<html>
    <head>
        <title>Administration</title>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">

        <meta name="title" content="Administration">
        <meta name="author" content="Ivan Slavko Matić">
        <meta name="keywords" 
              content="administrator, user, registered user, moderator, 
              company">

        <link href="../css/main.css" 
              rel="stylesheet" type="text/css">

        <!-- Datatables include -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

        <script src="jquery-3.4.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../javascript/main_jscript.js">
        </script>

    </head>
    <body>
        <header style="font-weight:bold">
            <h1 id="headerID">Administration</h1>
        </header>
        <nav>
            <ul>
                <li style="cursor: pointer"><a href="../index.php">Home</a></li>
                <li style="cursor: pointer"><a href="">Gallery</a></li>
                <li style="background-color: #007AA4; cursor: pointer"><a href="">Administration</a></li>   
                <li style="cursor: pointer"><a href="">Documentation</a></li>
                <?php if (!empty(Session::getUser())) {
                    ?>
                    <li style="cursor: pointer" onclick="<?php Session::deleteSession(); ?> reload();" id="logoutLi"><a>Logout</a></li>
                <?php } else { ?>
                    <li style="cursor: pointer" id="loginLi" class="loginLic" onclick="document.getElementById('modalLoginButton').style.display = 'block'" style="width:auto;"><a>Login</a></li> 
                    <li style="cursor: pointer" id="registrationLi" onclick="document.getElementById('modalRegisterButton').style.display = 'block'" style="width:auto;"><a>Registration</a></li>
                <?php } ?>
            </ul>
            <hr>
        </nav>

        <!-- Login form -->

        <!-- The Modal -->
        <div id="modalLoginButton" class="modal">
            <!-- Modal Content -->
            <form id="loginForm" class="modal-content animate" novalidate method="post" name="login" action="">

                <div class="container">
                    <h2 style="color: gray">Login</h2>
                    <label for="usernameLogin" style="color: gray;"><b>Username</b></label>
                    <input id="usernameLogin" type="text" placeholder="Username" name="usernameLogin" required>

                    <label for="passwordLogin" style="color: gray;"><b>Password</b></label>
                    <input id="passwordLogin" type="password" placeholder="Password" name="passwordLogin" required>
                    <br>
                    <label style="color: gray"> Remember me</label>
                    <input type="checkbox" checked="checked" name="rememberMeCheckbox">
                    <br><br>
                    <input name="loginBtn" type="submit" value="Log in" class="inputLoginButton" id="inputLoginButton">
                    &nbsp
                    <button type="button" onclick="document.getElementById('modalLoginButton').style.display = 'none'" class="cancelBtn" id="cancelBtn">Cancel</button>

                </div>
            </form>
        </div>

        <!-- Registration form -->

        <!-- Modal -->
        <div id="modalRegisterButton" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="register" id="modalRegisterForm" action="">

                <div class="container">
                    <h2 style="color: gray">Registration</h2>
                    <label for="nameRegister" style="color: gray;"><b>Name</b></label>
                    <input type="text" placeholder="Name" name="nameRegister" id="nameRegister" required>

                    <label for="surnameRegister" style="color: gray;"><b>Surname</b></label>
                    <input type="text" placeholder="Surname" name="surenameRegister" id="surnameRegister" required>

                    <label for="emailRegister" style="color: gray;"><b>Email</b></label>
                    <input type="email" placeholder="Email" name="emailRegister" id="emailRegister" required>

                    <label for="usernameRegister" style="color: gray;"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="usernameRegister" id="usernameRegister" required>

                    <label for="passwordRegister" style="color: gray;"><b>Password</b></label>
                    <input type="password" maxlength="15" placeholder="Password" name="passwordRegister" id="passwordRegister" required>

                    <label for="repeatPassword" style="color: gray;"><b>Repeat password</b></label>
                    <input type="password" maxlength="15" placeholder="Repeat password" name="repeatPassword" id="repeatPassRegister" required>
                    <br><br>
                    <input name="registerBtn" type="submit" value="Register" class="inputRegisterButton" id="inputRegisterButton">&nbsp
                    <button type="button" onclick="document.getElementById('modalRegisterButton').style.display = 'none'" class="cancelBtn" id="cancelBtn">Cancel</button>

                </div>
            </form>
        </div>

        <div>
            <table id="users_table">
                <thead>
                    <tr>
                        <th>Name & Surname</th>
                        <th>Email<th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>
                    <tr>

                    </tr>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>

        <footer class="footer">
            <p><strong>Name & Surname: </strong>Ivan Slavko Matić</p>
            <p><strong>Last updated: </strong>Listopad, 2019. </p>
            <address><strong>Email: </strong><a href="mailto:bluebloodslaiver1@gmail.com">bluebloodslaiver1@gmail.com</a></address>
            <figure id="footer">
                <a href="http://validator.w3.org/#validate_by_uri+with_options">
                    <img src="../multimedia/HTML5.png" 
                         alt="HTML5 validator" width="50" height="50"></a>
                <a href="http://jigsaw.w3.org/css-validator/">
                    <img src="../multimedia/CSS3.png" 
                         alt="CSS validator" width="50" height="50"></a>
            </figure>
        </footer>
    </body>
</html>