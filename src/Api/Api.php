<?php

namespace UnionBank\Api;

abstract class Api {
    protected $host = 'https://api-uat.unionbankph.com';
    protected $script = '/uhac/sandbox';
    protected $client_id;
    protected $client_secret;

    public function __construct() 
    {
    }

    public function request($path, array $query = null, $method = 'GET', $json_payload = false)
    {
        $curl           = curl_init();
        $curl_uri       = $this->host . $this->script . $path;
        $uri_info       = parse_url($curl_uri);
        $client_id      = $this->client_id;
        $client_secret  = $this->client_secret;

        $curl_uri = $uri_info['scheme'] . '://' . $uri_info['host'];
        $curl_uri .= $this->script . $path;

        $curl_opts = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        $curl_opts_header = [
            "accept: application/json",    
            "x-ibm-client-id: {$client_id}",
            "x-ibm-client-secret: {$client_secret}"
        ];

        switch ($method) {
            case 'PUT':
            case 'POST':
                if (! empty($query) && is_array($query)) {
                    ksort($query);

                    if ($json_payload) {
                        $curl_opts_header[] = "content-type: application/json"; 
                        $curl_opts[CURLOPT_POSTFIELDS] = json_encode($query);
                    }
                    else {
                    }
                }
                break;
            case 'GET':
            default: 
                if (! empty($query) && is_array($query)) {
                    ksort($query);
                    $curl_uri .= "?" . http_build_query($query);
                }
        }

        $curl_opts[CURLOPT_URL] = $curl_uri;
        $curl_opts[CURLOPT_HTTPHEADER] = $curl_opts_header;

        curl_setopt_array($curl, $curl_opts);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            var_dump([$curl_opts, json_decode($response)]);
            return json_decode($response);
        }
    }
}
