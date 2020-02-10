<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: My Cards </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) {
                        echo "<a class='link' href='logout.php'> Logout </a>";
                        echo "<a class='link' href='edit_profile.php'> Edit";
                        echo "</a>";
                        echo "<a class='link' href='profile.php'> Profile";
                        echo "</a>";
                        echo "<a class='link' href='register_card.php'>";
                        echo "Register Card </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }
                    else {
                        header("Location: home.php");
                    }

                    include("title.php");

                    if (isset($_GET['card_deleted']) == "false") {
                        echo "<div class='message_error' id='header_message'>";
                        echo $_SESSION["delete_card_message"];
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="full_centered" id="container">
                <h1>My Cards:</h1>

                <?php
                    $card_statement = $connection->prepare(
                        "select id, name, price from card where owner = ?");
                    $card_statement->bind_param("i", $_SESSION["id"]);
                    $card_statement->execute();
                    $card_result = $card_statement->get_result();

                    echo "<form action='delete_card.php' method='post'>";

                    while ($row = $card_result->fetch_assoc()) {
                        $card_id = $row["id"];
                        $card_name = $row["name"];
                        $card_price = $row["price"];

                        $card_name_statement = $connection->prepare(
                            "select image_path from card_name where id = ?");
                        $card_name_statement->bind_param("s", $card_name);
                        $card_name_statement->execute();
                        $card_name_statement->store_result();
                        $card_name_statement->bind_result($image_path);
                        $card_name_statement->fetch();
                        $card_name_statement->close();
                        $image_path = "res/img/" . $image_path;

                        echo "<div class='card_box'>";

                        echo "<label class='card_name'> $card_name </label>";

                        echo "<img alt='$card_name' class='card'";
                        echo "src='$image_path'>";

                        echo "<label class='card_price'> $ $card_price";
                        echo "</label>";

                        echo "<button name='delete' type='submit'";
                        echo "value='$card_id'> Delete </button>";

                        echo "</div>";
                    }

                    echo "</form>";

                    $card_statement->close();
                ?>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
