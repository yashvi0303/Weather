<?php
if (isset($_GET['city'])) {
    $city = htmlspecialchars($_GET['city']);
    $apiKey = '7be7e92f1765a2ed84b39044b4d49e40'; // Replace with your actual API key
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
    }

    curl_close($ch);

    if ($response) {
        $decodedResponse = json_decode($response, true);
        if (isset($decodedResponse['name']) && isset($decodedResponse['sys']['country']) && isset($decodedResponse['main']['temp']) && isset($decodedResponse['weather'][0]['description']) && isset($decodedResponse['main']['humidity'])) {
            echo $response;
        } else {
            echo json_encode(['error' => 'Invalid data received from the API.']);
        }
    } else {
        echo json_encode(['error' => 'Unable to fetch weather data.']);
    }
} else {
    echo json_encode(['error' => 'City not specified.']);
}
?>

