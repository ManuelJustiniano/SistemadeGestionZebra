<?php
namespace app\components;
use Yii;

class LibService implements InterfaceLib
{






    public function obtenerPaises()
    {
        // URL de la API de CountriesNow
        $url = 'https://countriesnow.space/api/v0.1/countries';

        // Realizar la solicitud desde el servidor
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Evitar problemas con SSL

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => 'No se pudo obtener la lista de países. Error: ' . $error];
        }
        curl_close($ch);

        // Verificar si la respuesta es válida
        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Error al decodificar JSON: ' . json_last_error_msg()];
        }

        return $data['data'];
    }
}