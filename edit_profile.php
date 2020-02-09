<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: Edit Profile </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) {
                        echo "<a class='link' href='logout.php'> Logout </a>";
                        echo "<a class='link' href='profile.php'> Profile </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }
                    else {
                        header("Location: home.php");
                    }

                    include("title.php");
                ?>
            </div>

            <div class="full_centered" id="profile">
                <h1>Edit Profile</h1><!-- Added sub_title here -->
                <form action="edit_profile_action.php" id="formy" method="post">
                    Name: <input name="name" type="text"> <br>
                    Username: <input name="username" type="text"> <br>
                    E-Mail: <input name="e_mail" type="email"> <br>
                    Phone Number: <input name="phone" type="text"> <br>
                    Password: <input name="password" type="password"> <br>
                    <br>
                    <input id="submit" type="submit" value="Edit">
                </form>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
