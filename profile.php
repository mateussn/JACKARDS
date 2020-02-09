<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: Profile </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) {
                        echo "<a class='link' href='logout.php'> Logout </a>";
                        echo "<a class='link' href='edit_profile.php'> Edit";
                        echo "</a>";
                        echo "<a class='link' href='my_cards.php'> My Cards";
                        echo "</a>";
                        echo "<a class='link' href='register_card.php'>";
                        echo "Register Card </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }
                    elseif (isset($_GET["id"])) {
                        echo "<a class='link' href='login.php'> Login </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }
                    else {
                        header("Location: home.php");
                    }

                    include("title.php");

                    if (isset($_GET["user_edited"]) == "true") {
                        echo "<div class='message_ok' id='header_message'>";
                        echo $_SESSION["edit_profile_message"];
                        echo "</div>";
                    }
                    elseif (isset($_GET["user_edited"]) == "false") {
                        echo "<div class='message_error' id='header_message'>";
                        echo $_SESSION["edit_profile_message"];
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="full_centered" id="profile">
                <h1>Profile</h1><!-- Added title here -->
                <?php
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                    }
                    else {
                        $id = $_SESSION["id"];
                    }

                    $statement = $connection->prepare(
                        "select name, username, e_mail, phone from `user` " .
                        "where id = ?");
                    $statement->bind_param("i", $id);
                    $statement->execute();
                    $statement->store_result();
                    $statement->bind_result($name, $username, $e_mail, $phone);
                    $statement->fetch();
                    $statement->close();

                    echo "Name: " . $name . "<br>";
                    echo "Username: " . $username . "<br>";
                    echo "E-Mail: " . $e_mail . "<br>";
                    echo "Phone Number: " . $phone . "<br>";
                ?>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
