<?php

namespace Output;

class RpcRequest
{
    private static string $url = "https://smart-summer-putty.btc.discover.quiknode.pro/daf5f38024dca451716f5e30831e31b74459187e/";

    public static function rpcMethodCall($payload): bool|string
    {
        $payload = json_encode($payload);
        $ch = curl_init(self::$url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        return curl_exec($ch);
    }

}