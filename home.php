<?php
    session_start();
    include_once("connect.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <link href="jackards.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <title> Jackards </title>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <?php
                    if (isset($_SESSION["id"])) { // isset()method is needed 
                        echo "<a class='link' href='logout.php'> Logout </a>";
                        echo "<a class='link' href='profile.php'> Profile";
                        echo "</a>";
                        echo "<a class='link' href='my_cards.php'> My Cards";
                        echo "</a>";
                        echo "<a class='link' href='register_card.php'>";
                        echo "Register Card </a>";
                    }
                    else {
                        echo "<a class='link' href='register_user.php'>";
                        echo "Register </a>";
                        echo "<a class='link' href='login.php'> Login </a>";
                    }

                    include("title.php");
                ?>
                <form id="search_bar">
                    <input name="search" placeholder="Type a card name."
                     type="search">
                    <input type="submit" value="Search">
                </form>

                <?php
                    if (isset($_GET["user_registered"]) == "true") {
                        echo "<div class='message_ok' id='header_message'>";
                        echo $_SESSION["register_user_message"];
                        echo "</div>";
                    }
                    if (isset($_GET["card_registered"]) == "true") {
                        echo "<div class='message_ok' id='header_message'>";
                        echo $_SESSION["register_card_message"];
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="full_centered" id="container">
                <h2>See all the products!!</h2> <!-- Modified Here -->
                <?php
                    $card_statement = $connection->prepare("select * from " .
                                                           "card");
                    $card_statement->execute();
                    $card_result = $card_statement->get_result();
            
                    while ($row = $card_result->fetch_assoc()) {
                        $card_id = $row["id"];
                        $card_name = $row["name"];
                        $card_price = $row["price"];
                        $card_owner = $row["owner"];
            
                        $card_name_statement = $connection->prepare(
                            "select image_path from card_name where id = ?");
                        $card_name_statement->bind_param("s", $card_name);
                        $card_name_statement->execute();
                        $card_name_statement->store_result();
                        $card_name_statement->bind_result($image_path);
                        $card_name_statement->fetch();
                        $card_name_statement->close();
                        $image_path = "res/img/" . $image_path;
            
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
                        echo "src='$image_path'> <br>";
            
                        echo "<label class='card_price'> $ $card_price";
                        echo "</label>";
            
                        echo "<a class='card_owner' ";
                        echo "href='profile.php?id=$card_owner'>";
                        echo "$owner_username </a>";
            
                        echo "</div>";
                    }
            
                    $card_statement->close();
                ?>
            </div>

            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
