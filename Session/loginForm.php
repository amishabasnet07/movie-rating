<?php
include 'Connection.php';
       echo "Welcome to session page". "<br>";
        echo $_SESSION['Username']. "<br>";
        echo "Successfully Login". "<br>";
        echo "<a href = 'logout.php'> logout </a>";
?>