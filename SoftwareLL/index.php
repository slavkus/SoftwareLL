<!DOCTYPE html>

<?php

require '../forms/login.php';
require '../forms/registration.php';



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
                <li><a href="obrasci/registracija.html">Registration</a></li> 
            </ul>
            <hr>
        </nav>

        <!-- Login form -->

        <!-- The Modal -->
        <div id="modalLoginButton" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="login" action="">

                <div class="container">
                    <label for="usernameLogin" style="color: whitesmoke;"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="usernameLogin" required>

                    <label for="passwordLogin" style="color: whitesmoke;"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="passwordLogin" required>
                    <br>
                    <label style="color: whitesmoke"><input type="checkbox" checked="checked" name="rememberMeCheckbox"> Remember me</label>
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
                    <label for="nameRegister" style="color: whitesmoke;"><b>Name</b></label>
                    <input type="text" placeholder="Name" name="nameRegister" required>
                    
                    <label for="surnameRegister" style="color: whitesmoke;"><b>Surname</b></label>
                    <input type="text" placeholder="Surname" name="surenameRegister" required>
                    
                    <label for="emailRegister" style="color: whitesmoke;"><b>Email</b></label>
                    <input type="text" placeholder="Email" name="emailRegister" required>
                    
                    <label for="usernameRegister" style="color: whitesmoke;"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="usernameLogin" required>

                    <label for="passwordRegister" style="color: whitesmoke;"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="passwordRegister" required>
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