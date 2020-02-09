<?php
    session_start();
    include_once("connect.php");

    $statement = $connection->prepare(
        "insert into card(name, price, owner) value (?, ?, ?)");
    $statement->bind_param("sdi", $_POST["card"], $_POST["price"],
                           $_SESSION["id"]);
    
    if ($statement->execute() === TRUE) {
        $_SESSION["register_card_message"] = "Card successfuly registered.";
        $statement->close();
        header("Location: home.php?card_registered=true");
    }
    else {
        $_SESSION["register_card_message"] = "Could not register card.";
        $statement->close();
        header("Location: register_card.php?card_registered=false");
    }
?>
