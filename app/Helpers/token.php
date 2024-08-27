<?
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generate_fcm_jwt($serviceAccountPath) {
    $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);
    $now_seconds = time();
    $payload = array(
        "iss" => $serviceAccount['client_email'],
        "sub" => $serviceAccount['client_email'],
        "aud" => "https://oauth2.googleapis.com/token",
        "iat" => $now_seconds,
        "exp" => $now_seconds + 3600,
        "scope" => "https://www.googleapis.com/auth/firebase.messaging"
    );

    $jwt = JWT::encode($payload, $serviceAccount['private_key'], 'RS256');
    return $jwt;
}
?>