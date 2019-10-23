<?php ?>

<!DOCTYPE html>

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
                <li><a href="obrasci/obrazac.html">Form</a></li> 
                <li><a href="obrasci/prijava.html">Login</a></li> 
                <li><a href="obrasci/registracija.html">Registration</a></li> 
                <li><a href="navigacijski.html">Navigational diagram</a></li> 
                <li><a href="era.html">ERA model</a></li> 
            </ul>
            <hr>
        </nav>
        
        <!-- Login form -->

        <!-- The Modal -->
        <div id="prijavaBtn" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="prijava" action="">

                <div class="container">
                    <label for="korimePrijava" style="color: black;"><b>Korisničko ime</b></label>
                    <input type="text" placeholder="Korisničko ime" name="korimePrijava" required>

                    <label for="lozinkaPrijava" style="color: black;"><b>Lozinka</b></label>
                    <input type="password" placeholder="Lozinka" name="lozinkaPrijava" required>
                    <br>
                    <label style="color: black"><input type="checkbox" checked="checked" name="zapamtimeCheckbox"> Zapamti me</label>
                    <br><br>
                    <input name="prijavaBtn" type="submit" value="Prijava" class="inputPrijavaButton">&nbsp
                    <button type="button" onclick="document.getElementById('prijavaBtn').style.display = 'none'" class="cancelbtn">Odustani</button>

                </div>

            </form>
        </div>

        <footer class="footer">
            <p><strong>Name & Surname: </strong>Ivan Slavko Matić</p>
            <p><strong>Last updated: </strong>Listopad, 2019. </p>
            <address><strong>Email: </strong><a href="mailto:bluebloodslaiver1@gmail.com">imatic@foi.hr</a></address>
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