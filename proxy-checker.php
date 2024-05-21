<?php
#V1.0   

# code by the nabzclan Team 

# api by the API Aries Team 

// Function to check if an IP is using a proxy or VPN
function checkProxyVPN($ip) {
    // API endpoint
    $apiUrl = "https://api.api-aries.online/v1/checkers/proxy/ip/?ip=";
    
    // Set headers for authentication
    $headers = array(
        'APITOKEN: API KEY' // DOCS: https://support.api-aries.online/hc/articles/1/3/2/ip-proxy-checker
    );
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl . urlencode($ip) . "&format2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    $response = trim($response);
    
    if ($response === 'Y') {
        return true; // Proxy or VPN detected
    } elseif ($response === 'N') {
        return false; // No proxy or VPN detected
    } else {
        // If response is neither 'Y' nor 'N', consider it as an error
        return null;
    }
}

function getUserIP() {
   
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    
    
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    
   
    if (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }
    
    return '';
}

// Function to check if the user is using a proxy or VPN
function isUserUsingProxyVPN() {
    // Get the user's IP address
    $userIP = getUserIP();
    
    // Check if the user is using a proxy or VPN
    $isProxyVPN = checkProxyVPN($userIP);
    
    return $isProxyVPN;
}


header('Access-Control-Allow-Origin: *'); // allow to work everywhere
header('Cache-Control: no-cache'); // Prevent caching
?>
