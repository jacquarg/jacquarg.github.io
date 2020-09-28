<?php
    $token = "AAAAAAAAAAAAAAAAAAAAAMu3HAEAAAAAkZ6m%2BmuccXSqyjDWOjLHpYdXCJA%3D5HPJ3XHGVwltP2LA1DLkW2LH9PS2V90nxkHzpU8Mb4ijNnJ8tx";

    $options = array('http' => array(
        'method'  => 'GET',
        'header' => 'Authorization: Bearer '.$token
    ));
    $context  = stream_context_create($options);


    $words = ["je", "t'ai", "donne", "de", "moi", "tu", "as", "aussi", "pris", "beaucoup", "ca", 
    //"tu", 
        "pourras", "le", "garder"];
    $res = array();
    foreach($words as $word) {
        $url = 'https://api.twitter.com/2/tweets/search/recent?query="'.$word.'"';
    
        $response = file_get_contents($url, false, $context);
        switch($word) {
            case "t'ai": $regex = 't[\'’]ai' ; break;
            case "donne": $regex = 'donn[eé]' ; break;
            case "ca": $regex = '[cç]a' ; break;
            default: $regex = $word; break;
        }

        $regex = '/\b'.$regex.'\b/';
        $tweet = "";
        foreach(json_decode($response)->data as $tweet) {
            $match = preg_match($regex, strtolower($tweet->text));
            if ($match != 0) {
                break;
            }
        }

        $res[$word] = $tweet->text;
    }
    
    $json = json_encode($res);
    $path = "../data/".date('Y\/m\/d\.\t\x\t');
    mkdir(dirname($path), 0755, true);
    file_put_contents($path, $json.PHP_EOL , FILE_APPEND | LOCK_EX);


    header("Content-Type: application/json; charset=UTF-8");
    http_response_code(200);
    echo $json
?>
