<?php
include 'database_access.php';

// clean input
$link = open();

// if e-mail does not exist, do nothing 
$query = sprintf("SELECT user_salt FROM user WHERE user_email='%s'",
	mysqli_real_escape_string($link, $_POST["email"])); 
$result = mysqli_query($link, $query);

// if e-mail exists:
if($result) {

    // make random password
    $len_pwd = 8; //length of password
    $pwd = random_pwd($len_pwd);

    // salt and store password in database
    $row = $result->fetch_assoc();
    $password = md5($pwd.$row["user_salt"]);
    $query = sprintf("UPDATE user SET user_hashedpwd='".$password."' WHERE user_email='%s'",
		mysqli_real_escape_string($link, $_POST["email"])); 
    $result = mysqli_query($link, $query); 
	 
    // email password
    if ($result) {
        $content = "Your Cloudbase password has been reset to " . $pwd . ".";
        $header = "From: admin@blackstonesystems.net/Cloudbase";
        $subject = "Cloudbase Email Reset";

        mail($_POST["email"], $subject, $content, $header);
    }
}
close($link);

header( 'Location: ../index.html' ); 	
// returns a random password string of the input length
function random_pwd($length) {
    $pass = "";
    for($i=0; $i<$length; $i++) {
        $pass .= random_symbol();
    }
    return $pass;
}

// returns a random symbol from those defined in $chars
function random_symbol() {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $symbol = substr( str_shuffle( $chars ), 0, 1 );
    return $symbol;
}

?>
