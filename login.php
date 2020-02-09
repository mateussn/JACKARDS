<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: Login </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) {
                        header("Location: home.php");
                    }
                    else {
                        //Referece do not exist!
                        //A little fix in href: before(href='register.php') 
                        //after(href='register_user.php')
                        echo "<a class='link' href='register_user.php'> Register </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }

                    include("title.php");

                    if (isset($_GET["logged_in"]) == "false") {
                        echo "<div class='message_error' id='header_message'>";
                        echo $_SESSION["login_message"];
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="full_centered">
                <h1>LOGIN</h1><!-- Added sub_title here -->
                <form action="login_action.php" id="formy" method="post">
                    Username: <input name="username" type="text"> <br>
                    Password: <input name="password" type="password"> <br>
                    <br>
                    <input id="submit" type="submit" value="Login">
                </form>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
