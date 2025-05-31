<?php

function dd($debug) {
    echo "<pre>";
    var_dump($debug);
    echo "</pre>";
}

$userName = $argv[1];
$url = "https://api.github.com/users/{$userName}/events";

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
}

function showData($data) {
    $userName = $data[0]["actor"]["login"];
    echo "User Name: \"\033[36m{$userName}\033[0m\" \n\n";
    $repoName = [];
    
    foreach ($data as $activity) {
        if($activity["type"] === "PushEvent") {
            $repoName[] = $activity["repo"]["name"];
        }
    }
    
    //Cuenta cuantos commits ha hecho el usuario a que repositorio
    $result = array_count_values($repoName);
    echo "Commits:\n";

    foreach ($result as $repo => $value) {
        
        $infoRepo = getInfoRepo($repo);

        echo "\033[35m{$repo}\033[0m: \033[36m{$infoRepo['html_url']}\033[0m \n";
        echo "\033[35mCommits\033[0m: Se han realizado \033[32m$value commits\033[0m\n";
        echo "\033[35mDescription\033[0m: {$infoRepo['description']}\n";
        echo "\033[35mIssues Abiertas\033[0m: {$infoRepo['open_issues']}\n";
        echo "\033[35mCreado el dia\033[0m: {$infoRepo['created_at']}\n";
        echo "\033[35mActualizado el dia\033[0m: {$infoRepo['updated_at']}\n\n";
    }
}

function getInfoRepo($repo) {
    $url = "https://api.github.com/repos/{$repo}";

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
            echo "\033[31m❌ Error\033[0m: El repositorio del usuario no ha sido encontrado";
            return;
        }
        $array = [
            "html_url" => $data["html_url"],
            "description" => $data["description"],
            "open_issues" => $data["open_issues"],
            "created_at" => $data["created_at"],
            "updated_at" => $data["updated_at"]
        ];

        return $array;
    }
}

curl_close($ch);