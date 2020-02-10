<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: Register Card </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) {
                        echo "<a class='link' href='logout.php'> Logout </a>";
                        echo "<a class='link' href='profile.php'> Profile";
                        echo "</a>";
                        echo "<a class='link' href='my_cards.php'> My Cards";
                        echo "</a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }
                    else {
                        header("Location: home.php");
                    }

                    include("title.php");

                    if (isset($_GET["card_registered"]) == "false") {
                        echo "<div class='message_error' id='header_message'>";
                        echo $_SESSION["register_card_message"];
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="full_centered">
                <h1>Register Card</h1><!-- Added sub_title title -->
                <form action="register_card_action.php" id="formy"
                 method="post">
                    Select a Card:

                    <select name="card">
                        <?php
                            $statement = $connection->prepare(
                                "select id from card_name");
                            $statement->execute();
                            $result = $statement->get_result();


                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_row()) {
                                    echo '<option value="' . $row[0] . '">';
                                    echo $row[0] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <br>

                    Card Price: <input name="price" type="text">
                    <input id="submit" type="submit" value="Choose">
                </form>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
