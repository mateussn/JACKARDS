<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards: Cards </title>
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
                        echo "<a class='link' href='register_card.php'>";
                        echo "Register Card </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }
                    else {
                        echo "<a class='link' href='login.php'> Login </a>";
                        echo "<a class='link' href='home.php'> Home </a>";
                    }

                    include("title.php");
                ?>
            </div>

            <div class="full_centered" id="container">
                <?php
                    $search = $_POST['search'];
                    $search_query = $connection->prepare(
                        "select name, price, owner from card where " .
                        "match(name) against(?)");
                    $search_query->bind_param('s', $search);
                    $search_query->execute();
                    $search_query->store_result();
                    $search_query->bind_result($card_name, $card_price,
                                               $card_owner);

                    if ($search_query->num_rows > 0) {
                        echo "<h1> Results for \"$search\". </h1>";

                        while ($search_query->fetch()) {
                            $card_name_statement = $connection->prepare(
                                "select image_path from card_name where id = ?");
                            $card_name_statement->bind_param("s", $card_name);
                            $card_name_statement->execute();
                            $card_name_statement->store_result();
                            $card_name_statement->bind_result($image_path);
                            $card_name_statement->fetch();
                            $card_name_statement->close();
                            $image_path = "res/img/card/" . $image_path;

                            $owner_statement = $connection->prepare(
                                "select username from `user` where id = ?");
                            $owner_statement->bind_param("i", $card_owner);
                            $owner_statement->execute();
                            $owner_statement->store_result();
                            $owner_statement->bind_result($owner_username);
                            $owner_statement->fetch();
                            $owner_statement->close();

                            echo "<div class='card_box'>";

                            echo "<label class='card_name'> $card_name </label>";

                            echo "<img alt='$card_name' class='card'";
                            echo "src='$image_path'>";

                            echo "<label class='card_price'> $ $card_price";
                            echo "</label>";

                            echo "<a class='card_owner' ";
                            echo "href='profile.php?id=$card_owner'>";
                            echo "$owner_username </a>";

                            echo "</div>";
                        }
                    }
                    else {
                        echo "<h1> There is no result matching. </h1>";
                    }

                    $search_query->close();
                ?>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
