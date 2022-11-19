<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM users";
$result = $conn->query($sql);
   

$login_success = false;
$full_name = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row["username"] == $_POST["username"] &&
                    $row["password"] == $_POST["password"]) {
            $login_success = true;
            }
    }
} else {
    echo "0 results";
}
if($login_success) {

    session_start();
    $_SESSION["username"] = $_POST["username"];

    echo "Login Success!! Welcome   " . $_SESSION["username"] . "!";
    
    echo '    <form method="post">
            <input type="submit" name="logoutButton"
            class="button" value="Button1" />
            </form>
      ';

} else {
    echo "Login Failed";
}

if(array_key_exists('logoutButton', $_POST)) {
    logout();
};

function logout() {
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;
};

$conn->close();

?>