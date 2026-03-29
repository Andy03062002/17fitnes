<?php
namespace App\Services;


class AnthropicAPIClient
{

    private $url;
    private $apiKey;
    private $anthropicVersion;
    private $lastResponse = null;
    private $lastStatusCode = null;

    public function __construct($url, $apiKey, $anthropicVersion = '2023-06-01')
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
        $this->anthropicVersion = $anthropicVersion;
    }

    /**
     * Enviar mensaje a la API
     */
    public function sendMessage($userMessage, $model = 'claude-haiku-4-5', $maxTokens = 1000, $temperature = 0.7)
    { $payload = [
         'max_tokens' => $maxTokens, 
         'temperature' => $temperature, 
         'system' => "eres un entrenador personal de gimnasio que crea rutinas...", 
         'messages' => [
             [ 'role' => 'user', 
             'content' => $userMessage 
             ] 
            ], 
            'model' => $model 
        ]; 
        
        return $this->makeRequest($payload); }

    /**
     * Realizar la petición HTTP
     */
    private function makeRequest($payload)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_SSL_VERIFYPEER => false,   // <-- desactiva SSL
            CURLOPT_SSL_VERIFYHOST => false,   // <-- desactiva SSL
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'x-api-key: ' . $this->apiKey,
                'anthropic-version: ' . $this->anthropicVersion
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);

        curl_close($curl);

        $this->lastResponse = $response;
        $this->lastStatusCode = $httpCode;

        if ($err) {
            return [
                'success' => false,
                'error' => 'Error en cURL: ' . $err
            ];
        }

        $result = json_decode($response, true);

        if ($httpCode === 200) {
            return [
                'success' => true,
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'error' => $result['error']['message'] ?? 'Error desconocido',
                'status_code' => $httpCode
            ];
        }
    }

    /**
     * Obtener la última respuesta completa
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Obtener el último código de estado HTTP
     */
    public function getLastStatusCode()
    {
        return $this->lastStatusCode;
    }
}

/* Ejemplo de uso

$resultado = $client->sendMessage(
    'quiero recomendaciones, soy mujer di a luz hace 8 meses, cual es la rutina que debo seguir en el gimnasio',
    'eres un asistente de gimnasio.'
); 

if ($resultado['success']) {
    echo "✓ Respuesta exitosa:\n";
    echo json_encode($resultado['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    echo "✗ Error:\n";
    echo $resultado['error'] . "\n";
    echo "Status Code: " . ($resultado['status_code'] ?? 'N/A') . "\n";
}
*/
?>