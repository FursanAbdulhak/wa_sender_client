<?php

namespace Alareqi\FilamentWhatsapp;

use Illuminate\Support\Facades\Http;


class WhatsappClient
{
    public $api_url;
    protected $authKey;
    protected $appKey;


    protected $http;

    // construtor
    public function __construct($api_url, $appKey, $authKey)
    {
        $this->api_url = $api_url;
        $this->authKey = $authKey;
        $this->appKey = $appKey;


        $headers = [
            'Content-Type' => 'application/json',
            "connection" => 'keep-alive',

        ];
        $this->http = Http::baseUrl($this->api_url)

            ->withHeaders($headers)->timeout(500)->retry(3, 100);
    }
    // send message
    public function    sendMessage(WhatsappMessage $message)
    {

        try {
            $message->jsonSerialize();

            $data = array_merge($message->jsonSerialize(), [
                'appkey' => $this->appKey,
                'authkey' => $this->authKey
            ]);

            $response = $this->http->post('/create-message', $data);

            $body = $response->json();
            if ($body == null) {
                return -1;
            }
            return $body;
        } catch (\Throwable $th) {


            return -1;
        }
    }

    // on whatsapp
    public function onWhatsapp($whatsappId)
    {
        try {
            $response = $this->http->post('/misc/on-whatsapp', [
                'appkey' => $this->appKey,
                'authkey' => $this->authKey,
                "whatsapp_id" => $whatsappId
            ]);

            $body = $response->json();
            if ($body) {
                return $body["exist"];
            } else {
                return -1;
            }
        } catch (\Exception $e) {
            return -1;
        }
    }

    public function schedulMessage(WhatsappMessage $message)
    {

        try {
            $data = array_merge($message->jsonSerialize(), [
                'appkey' => $this->appKey,
                'authkey' => $this->authKey
            ]);

            $response = $this->http->post('/schedule-message/create', $data)->json();
            if ($response != null) {
                return   $response;
            } else {
                return -1;
            }
        } catch (\Exception $e) {

            return -1;
        }
    }

    public function schedulMessageStatus($id)
    {

        $data = [
            "appkey" => $this->appKey,
            "authkey" => $this->authKey,

        ];

        try {
            return $this->http->get("/schedule-message/" . $id, $data)->json();
        } catch (\Exception $e) {

            return -1;
        }
    }
}
