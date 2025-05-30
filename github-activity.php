<?php

function dd($debug) {
    echo "<pre>";
    var_dump($debug);
    echo "</pre>";
}

// $userName = $argv[1];

// $url = "https://api.github.com/users/{$userName}/events";
$url = "https://api.github.com/users/DavidSilveraGabriel/events";


$ch = curl_init($url);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: GitHubActivity'
]);

$response = curl_exec($ch);
// Manejo de errores
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    $data = json_decode($response, true);
    
    if(isset($data["status"]) && $data["status"] === "404") {
        echo "\033[31m❌ Error\033[0m: El usuario \"\033[36m{$userName}\033[0m\" no ha sido encontrado";
        return;
    }
    showData($data);
    // dd($data);
}

function showData($data) {
    $userName = $data[0]["actor"]["login"];
    echo "User Name: \"\033[36m{$userName}\033[0m\" \n\n";
    $array = [];
    foreach ($data as $activity) {
        if($activity["type"] === "PushEvent") {
            $array[] = $activity["repo"]["name"];
            // dd($activity["repo"]["id"]);
            // dd(count($activity["payload"]["commits"]));
            // foreach ($activity["payload"]["commits"] as $key => $value) {
            //     # code...
            // }
        }
    }
    //Cuenta valores de un array
    $resultado = array_count_values($array);

    foreach ($resultado as $repo => $cantidad) {
        echo "$repo: Se han realizado \033[32m$cantidad commits\033[0m \n";
    }

}

curl_close($ch);
