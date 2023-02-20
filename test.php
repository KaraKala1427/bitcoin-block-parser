<?php
include_once 'autoload.php';

use Output\OutputFactory;

$pub_key_ecdsa = "0496B538E853519C726A2C91E61EC11600AE1390813A627C66FB8BE7947BE63C52DA7589379515D4E0A604F8141781E62294721166BF621E73A82CBF2342C858EE";
//$pub_key_ecdsa = "2c6DSiU4Rq3P4ZxziKxzrL5LmMBrzjrJX";

$address = OutputFactory::p2pk($pub_key_ecdsa)->address();
echo $address."\n";


