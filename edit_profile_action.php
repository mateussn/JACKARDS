<?php
    session_start();
    include_once("connect.php");

    $name = $_POST["name"];
    $username = $_POST["username"];
    $e_mail = $_POST["e_mail"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $statement = $connection->prepare(
        "update `user` set name = ?, username = ?, e_mail = ?, phone = ?," .
        "`password` = ? where id = ?");
    $statement->bind_param("sssssi", $name, $username, $e_mail, $phone,
                           $password, $_SESSION["id"]);
    $statement->execute();

    if ($statement->affected_rows > 0) {
        $_SESSION["edit_profile_message"] = "Profile successfuly edited.";
        $statement->close();
        header("Location: profile.php?user_edited=true");
    }
    else {
        $_SESSION["edit_profile_message"] = "Could not register.";
        $statement->close();
        header("Location: profile.php?user_edited=false");
    }
?>
