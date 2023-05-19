<?php
// ====A+P+P+K+E+Y====
namespace App\Utils;

use GuzzleHttp\Client as Client;

class Notification
{
    /**
     * @param string $title title of message
     * @param string $body body or content message
     * @param string $token user token to send notif
     */

     public function send($title, $body, $token, $click_action = null)
    {
        $header = array();
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization: key=' . env('FCM_SERVER_KEY');
        // $header[] = 'project_id: ' . env('FCM_PROJECT_ID');

        $payload = [
            'to' => $token,
            'priority' => 'high',
            'notification' => [
                'title' => $title,
                'body' => $body,
                'click_action' => $click_action
            ]
        ];

        $crl = curl_init();
        curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($crl, CURLOPT_POST,true);
        curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($crl, CURLOPT_SSL_VERIFYHOST, false); //should be off on production
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false); //shoule be off on production

        $rest = curl_exec($crl);
        if ($rest === false) {
            return curl_error($crl);
        }
        curl_close($crl);
        return $rest;
    }

    public function newSend($token, $title, $body, $id_order)
    {
        $message = [
            'to' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
            ],
            'data' => [
                'title' => $title,
                'body' => $body,
                'click_action' => 'order',
                'id_order' => $id_order,
            ]
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.env('FCM_SERVER_KEY'),
            ]
        ]);

        $response = $client->POST('https://fcm.googleapis.com/fcm/send',[
            'body' => json_encode($message)
        ]);

        // return $response->getBody();
    }

    public function newSendTopics($topics, $title, $body, $id_order)
    {
        $message = [
            'to' => $topics,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
            ],
            'data' => [
                'title' => $title,
                'body' => $body,
                'click_action' => 'new_order',
                'id_order' => $id_order,
            ]
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.env('FCM_SERVER_KEY'),
            ]
        ]);

        $response = $client->POST('https://fcm.googleapis.com/fcm/send',[
            'body' => json_encode($message)
        ]);

        // return $response->getBody();
    }

    public function newSendOrder($token, $title, $body, $id_order)
    {
        $message = [
            'to' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
            ],
            'data' => [
                'title' => $title,
                'body' => $body,
                'click_action' => 'new_order',
                'id_order' => $id_order,
            ]
        ];

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.env('FCM_SERVER_KEY'),
            ]
        ]);

        $response = $client->POST('https://fcm.googleapis.com/fcm/send',[
            'body' => json_encode($message)
        ]);

        // return $response->getBody();
    }
}
