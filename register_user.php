<?php
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: Register User </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) {
                        header("Location: home.php");
                    }
                    else {
                        echo "<a class='link' href='login.php'> Login </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }

                    include("title.php");

                    if (isset($_GET["user_registered"]) == "false") {
                        echo "<div class='message_error' id='header_message'>";
                        echo $_SESSION["register_user_message"];
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="full_centered">
                <h1>REGISTER USER</h1> <!--Added sub_title here -->
                <form action="register_user_action.php" id="formy"
                 method="post">
                    Name: <input name="name" type="text"> <br>
                    Username: <input name="username" type="text"> <br>
                    E-Mail: <input name="e_mail" type="email"> <br>
                    Phone Number: <input name="phone" type="text"> <br>
                    Password: <input name="password" type="password"> <br>
                    <br>
                    <input id="submit" type="submit" value="Register">
                </form>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
