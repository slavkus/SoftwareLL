<?php
session_start();
require '../DB/db.php';

//Comment when done with sessions, just check ups
//echo session_id();
//echo "<br>";
//echo session_name();
//echo "<br>";
//echo $_SESSION["user"] . " is now a session user.";
//echo session_status();

if (!empty($_SESSION["user"])) {
    echo "<script src='../javascript/jquery-3.4.1.min.js'></script>"
    . "<script type='text/javascript'>"
    . "$(document).ready(function () {"
    . " showLogout(); });"
    . "</script>";

    if (($_SESSION["type"]) == 4) {
        echo "<script src='../javascript/jquery-3.4.1.min.js'></script>"
        . "<script type='text/javascript'>"
        . "$(document).ready(function () {"
        . " showAdminData(); });"
        . "</script>";

        $connection = new DB();
        $connection->connectDB();

        $query = "SELECT id_korisnik, email, korisnicko_ime FROM korisnik";
        $result = $connection->selectDB($query);

        $data = array();

        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id_korisnik'];
            $email = $row['email'];
            $user = $row['korisnicko_ime'];
            $data[] = array('id' => $id, 'email' => $email, 'username' => $user);
        }

        $fp = fopen('../javascript/users.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    } else {
        echo "<script src='../javascript/jquery-3.4.1.min.js'></script>"
        . "<script type='text/javascript'>"
        . "$(document).ready(function () {"
        . " showAdminBlank(); });"
        . "alert('Content locked. Please log in as administrator.');"
        . "</script>";
    }
} else {
    echo "<script src='../javascript/jquery-3.4.1.min.js'></script>"
    . "<script type='text/javascript'>"
    . "$(document).ready(function () {"
    . " showLoginRegistration();"
    . " showAdminBlank(); });"
    . "</script>";
    $error = "";
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error .= $key . " not inserted. \n";
        }
    }
    //var_dump($error);
    if (empty($error)) {
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
                $type = $row['uloga_korisnika_id_uloga'];
            }

            if ($authenticated) {
                $_SESSION["user"] = $username;
                $_SESSION["type"] = $type;
                $ispis = $_SESSION["user"];
                echo "<script src='../javascript/jquery-3.4.1.min.js'></script>"
                . "<script type='text/javascript'>"
                . "$(document).ready(function () {"
                . " showLogout();"
                . " reload(); });"
                . "</script>";
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

        $queryCheck = "SELECT * FROM korisnik WHERE "
                . "korisnicko_ime='{$username}' "
                . "AND lozinka='{$password}'";
        $result = $connection->selectDB($queryCheck);

        while ($row = mysqli_fetch_array($result)) {
            if ($row) {
                $userAuth = $row['korisnicko_ime'];
                $emailAuth = $row['email'];
                $type = $row['uloga_korisnika_id_uloga'];
            }
        }

        if ($userAuth == $username) {
            echo "<script type='text/javascript'>"
            . "alert('There is already a user registered under that username')"
            . "</script>";
        } else if ($email == $emailAuth) {
            echo "<script type='text/javascript'>"
            . "alert('There is already a user registered under that email')"
            . "</script>";
        } else {
            $query = "INSERT INTO korisnik (ime, prezime, "
                    . "korisnicko_ime, lozinka, email) VALUES ('{$name}','{$surname}','{$username}','{$password}','{$email}')";
            $result = $connection->selectDB($query);

            echo "<script type='text/javascript'>"
            . "alert('Thank you for registering!')"
            . "</script>";
        }
        $connection->closeDB();
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Explorer</title>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">

        <meta name="title" content="Explorer">
        <meta name="author" content="Ivan Slavko Matić">
        <meta name="keywords" 
              content="administrator, user, registered user, moderator, 
              company">
        <script src="../javascript/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script src="../javascript/skyrim_explorer.js"></script>

        <!-- Fancybox -->
        <script src="../fancybox/lib/jquery.mousewheel.pack.js"></script>
        <script src="../fancybox/source/jquery.fancybox.pack.js"></script>
        <script src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
        <script src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>
        <script src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

        <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />

        <link href="../css/skyrim_explorer.css" rel="stylesheet" type="text/css">
        <!-- Datatables include -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js">
        <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/lib/w3-colors-2019.css">

    </head>
    <body>
        <header>
        </header>
        <nav>
            <ul id="menu">
                <li><a href="../index.php">Home</a></li>
                <li>
                    <a>Sign In</a>
                    <ul>
                        <li id="logoutLi"><a href="../DB/logout.php">Logout</a></li>
                        <li id="loginLi" class="loginLic" onclick="document
                                        .getElementById('modalLoginButton').style.display = 'block'" 
                            style="width:auto;"><a>Login</a>
                        </li>
                        <li id="registrationLi" onclick="document
                                        .getElementById('modalRegisterButton')
                                        .style.display = 'block'" style="width:auto;">
                            <a>Registration</a>
                        </li>
                    </ul>
                </li>
                <li><a href="https://github.com/slavkus/SoftwareLL/wiki">Documentation</a></li>

                <li>
                    <a>Webpages</a>
                    <ul>
                        <li><a href="media.php">Media</a></li>
                        <li><a href="">Explorer</a></li>
                        <li id="adminLi"><a href="administration.php">Administration</a></li>
                    </ul>
                </li>
            </ul>
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
                    &nbsp;
                    <button type="button" onclick="document.getElementById('modalLoginButton').style.display = 'none'" class="cancelBtn">Cancel</button>
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

                    <label for="repeatPassRegister" style="color: gray;"><b>Repeat password</b></label>
                    <input type="password" maxlength="15" placeholder="Repeat password" name="repeatPassword" id="repeatPassRegister" required>
                    <br><br>
                    <input name="registerBtn" type="submit" value="Register" class="inputRegisterButton" id="inputRegisterButton">&nbsp;
                    <button type="button" onclick="document.getElementById('modalRegisterButton').style.display = 'none'" class="cancelBtn" id="cancelBtn">Cancel</button>

                </div>
            </form>
        </div>
        <!--
        <div id="iframeLoader">
            <iframe src="http://www.google.co.in" name="targetframe" allowTransparency="true" scrolling="no" frameborder="0" >
            </iframe>
        </div>
        -->
        <div class="container">
            <div class="explorerContent"><img src="../skyrim_source/skypickerAssembly.png" alt="Skyrim Picker"
                                              <!-- usemap="#categorySelector" --></div>

            <!--<map name="categorySelector">
                <area shape="rect" coords="0,0,82,126" href="sun.htm" alt="Sun">
                <area shape="rect" coords="90,58,3" href="mercur.htm" alt="Mercury">
                <area shape="rect" coords="124,58,8" href="venus.htm" alt="Venus">
                <area shape="rect" coords="0,0,82,126" href="sun.htm" alt="Sun">
                <area shape="rect" coords="90,58,3" href="mercur.htm" alt="Mercury">
                <area shape="rect" coords="124,58,8" href="venus.htm" alt="Venus">
            </map>-->
            <div class="explorerInner rotate"><img src="../skyrim_source/esoCircle.png" alt="Skyrim Picker"></div>


            <!-- https://css-tricks.com/the-many-ways-to-link-up-shapes-and-images-with-html-and-css/ -->

            <div class="backgroundButtons">
                <button id="btnChooseBackground">Static Background</button>
                <button id="btnAutoBackground">Auto Background</button>
            </div>
        </div>

    </body>
</html>
