<?php
//$output = shell_exec('docker inspect tuyensinh-web');
//$container_details = json_decode($output, true);
//print_r(reset($container_details[0]['NetworkSettings']['Networks'])['IPAddress']);
namespace App\Services;
$docker = new Docker();
print_r($docker->inspect_container('tuyensinh-web'));

$docker = new Docker();
print_r($docker->get_container_ip('tuyensinh-web'));
print_r("\n\n".$docker->run_container('busybox'));
