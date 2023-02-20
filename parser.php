<?php
include_once 'autoload.php';

use Output\RpcRequest;

$block_number  = $argv[1] + 0;
var_dump($block_number);

$payload_by_hash = [
    "jsonrpc" => "1.0",
    "id" => "curltest",
    "method" => "getblockhash",
    "params" => [$block_number]
];
$block_hash = json_decode(RpcRequest::rpcMethodCall($payload_by_hash), true)['result'];

$payload_by_number = [
    "jsonrpc" => "1.0",
    "id" => "curltest",
    "method" => "getblock",
    "params" => [$block_hash]
];

$block = json_decode(RpcRequest::rpcMethodCall($payload_by_number), true);



