<?php

namespace App\Services;

class Docker
{
    public function container_exists($container_identifier) {
        $command = "docker inspect $container_identifier";
        exec($command, $output, $result_code);
        return $result_code == 0;
    }
    public function inspect_container($container_name) {
        $command = "docker inspect $container_name";
        exec($command, $output, $result_code);
        return $result_code == 0 ? json_decode($output, true) : null;
    }
    public function stop_container($container_name): ?string
    {
        $command = "docker stop $container_name";
        exec($command, $output, $result_code);
        if ($result_code != 0) return null;
        return trim($output, "\n");
    }
    public function change_container_passwd($container_name, $container_passwd, $container_user = 'root' ): bool
    {
        $command = "echo $container_user:$container_passwd | docker exec -i $container_name chpasswd";
        exec($command, $output, $result_code);
        return $result_code == 0;
    }
    public function run_container($image, $name = null, $network = null, $parameters = "", $remove_if_stop = true, $background = true): ?string
    {
        $name_opt = !is_null($name) ? " --name $name" : "";
        $network_opt = !is_null($network) ? " --network $network" : "";
        $remove_opt = !is_null($remove_if_stop) ? " --rm" : "";
        $background = !is_null($background) ? " --detach" : "";
        $command = "docker run".$name_opt.$network_opt.$remove_opt.$background." ".$image." ".$parameters;
        exec($command, $output, $result_code);
        if ($result_code != 0) return null;
        return trim($output, "\n");
    }
    public function get_container_ip($container_name, $network_name = null) {
        $container_details = $this->inspect_container($container_name);
        if (is_null($network_name)) {
            return reset($container_details[0]['NetworkSettings']['Networks'])['IPAddress'];
        }

        return $container_details[0]['NetworkSettings']['Networks'][$network_name]['IPAddress'];
    }
}
