<?php

require('easybitcoin.php');

$bitcoin = new Bitcoin("username", "password");
$block_number  = $argv[1] + 0;

$block_hash = $bitcoin->getblockhash($block_number);
$block = $bitcoin->getblock($block_hash);

var_dump($block);
var_dump(count($block["tx"]));

