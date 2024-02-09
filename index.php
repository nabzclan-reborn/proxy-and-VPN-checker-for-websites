<?php

// Include the proxy checker file
require_once 'proxy-checker.php';

// Check if the user is using a proxy or VPN
$isProxyVPN = isUserUsingProxyVPN();

if ($isProxyVPN === true) {

   echo "You are currently using a proxy or VPN."; // use message

  # header("Location: found.php"); // use page 

} elseif ($isProxyVPN === false) {
    echo "You are not using a proxy or VPN.";
} else {
    echo "Error occurred while checking proxy or VPN status.";
}

?>
