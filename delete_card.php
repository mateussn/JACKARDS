<?php
    session_start();
    include_once("connect.php");

    $statement = $connection->prepare("delete from card where id = ?");
    $statement->bind_param("i", $_POST["delete"]);
    echo $_POST["delete"];

    if ($statement->execute() === TRUE) {
        if ($statement->affected_rows === 0) {
            $_SESSION['delete_card_message'] = "Failed to delete card.";
            header("Location: my_cards.php?card_deleted=false");
        }
    }
    else {
        $_SESSION['delete_card_message'] = "Failed to delete card.";
        header("Location: my_cards.php?card_deleted=false");
    }

    header("Location: my_cards.php");
?>
