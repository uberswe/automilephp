<?php
/**
 * User: Markus Tenghamn
 * Date: 16/08/16
 * Time: 19:53
 */

namespace Markustenghamn\Automile;

class Automile
{
    private $client_id;
    private $client_secret;
    private $token;
    private $base = "https://api.automile.se";
    private $authurl = "https://api.automile.io/OAuth2/Token/";
    private $lastHeaders;
    private $lastResponseCode;
    private $lastResponse;
    private $lastEndpoint;

    /**
     * @return mixed
     */
    public function getLastEndpoint()
    {
        return $this->lastEndpoint;
    }

    /**
     * @return mixed
     */
    public function getLastHeaders()
    {
        return $this->lastHeaders;
    }

    /**
     * @return mixed
     */
    public function getLastResponseCode()
    {
        return $this->lastResponseCode;
    }

    /**
     * @return mixed
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @return string
     */
    public function getAuthurl()
    {
        return $this->authurl;
    }

    /**
     * @param string $authurl
     */
    public function setAuthurl($authurl)
    {
        $this->authurl = $authurl;
    }

    /**
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param string $base
     */
    public function setBase($base)
    {
        $this->base = $base;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Automile constructor.
     */
    public function __construct(Automile $automile = null)
    {
        if ($automile) {
            $this->token = $automile->getToken();
            $this->base = $automile->getBase();
        }
    }

    public function authenticate($client_id, $client_secret, $username, $password, $scopes = array()) {

        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->lastEndpoint = $this->authurl;

        $ch = curl_init();

        $fields = array(
            "grant_type" => "password",
            "scope" => implode(" ", $scopes),
            "username" => $username,
            "password" => $password
        );

        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        curl_setopt($ch, CURLOPT_URL, $this->authurl);
        curl_setopt($ch, CURLOPT_ENCODING, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Connection: Keep-Alive',
            "Authorization: Basic " . base64_encode($this->client_id . ":" . $this->client_secret)
        ));

        $response= curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $result = substr($response, $header_size);

        $this->lastHeaders = $header;
        $this->lastResponse = $result;

        if (curl_error($ch)) {
            $error_message = curl_error($ch);
            return $error_message;
        } else {
            $info = curl_getinfo($ch);
            $this->lastResponseCode = $info["http_code"];
        }

        curl_close($ch);
        $token = json_decode($result);
        $this->token = $token->access_token;
        return $this->token;
    }

    protected function post($endpoint, $jsonobject) {
        $this->lastEndpoint = $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonobject);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Connection: Keep-Alive',
            "Authorization: Bearer " . $this->token
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $result = substr($response, $header_size);

        $this->lastHeaders = $header;
        $this->lastResponse = $result;

        if (curl_error($ch)) {
            $error_message = curl_error($ch);
            return $error_message;
        } else {
            $info = curl_getinfo($ch);
            $this->lastResponseCode = $info["http_code"];
        }

        curl_close($ch);

        return $result;
    }

    protected function get($endpoint) {
        $this->lastEndpoint = $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Connection: Keep-Alive',
            "Authorization: Bearer " . $this->token
        ));
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $response= curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $result = substr($response, $header_size);

        $this->lastHeaders = $header;
        $this->lastResponse = $result;

        if (curl_error($ch)) {
            $error_message = curl_error($ch);
            return $error_message;
        } else {
            $info = curl_getinfo($ch);
            $this->lastResponseCode = $info["http_code"];
        }

        curl_close($ch);

        return json_decode($result);
    }

    protected function delete($endpoint) {
        $this->lastEndpoint = $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Connection: Keep-Alive',
            "Authorization: Bearer " . $this->token
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $response= curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $result = substr($response, $header_size);

        $this->lastHeaders = $header;
        $this->lastResponse = $result;

        if (curl_error($ch)) {
            $error_message = curl_error($ch);
            return $error_message;
        } else {
            $info = curl_getinfo($ch);
            $this->lastResponseCode = $info["http_code"];
        }

        curl_close($ch);

        return $result;
    }

    protected function put($endpoint, $jsonobject) {
        $this->lastEndpoint = $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonobject);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Connection: Keep-Alive',
            "Authorization: Bearer " . $this->token
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $response= curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $result = substr($response, $header_size);

        $this->lastHeaders = $header;
        $this->lastResponse = $result;

        if (curl_error($ch)) {
            $error_message = curl_error($ch);
            return $error_message;
        } else {
            $info = curl_getinfo($ch);
            $this->lastResponseCode = $info["http_code"];
        }

        curl_close($ch);

        return $result;
    }

    protected function json() {
        return json_encode($this);
    }
}