<?php

namespace App\Services;

use App\Models\WettyEvents;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class Wetty
{
    private $docker;
    private $nginx;
    private $wetty_session_token;
    private $target_container;
    private $wetty_container_name;
    private $network;
    function __construct($target_container, $network = null) {
        $this->docker = new Docker();
        $this->nginx = new Nginx();
        $this->target_container = $target_container;
        $this->network = $network;
        $this->wetty_container_name = $this->construct_wetty_container_name();
    }

    private function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    private function randomize_container_access_credentials($target_container, $target_container_user = 'root'): array
    {
        $target_container_password = $this->random_str(8);
        $this->docker->change_container_passwd($target_container, $target_container_password, $target_container_user);
        return array(
            'user' => $target_container_user,
            'passwd' => $target_container_password
        );
    }

    private function construct_wetty_container_name(): string
    {
        return 'wetty-session_'.$this->target_container;
    }

    public function start_wetty_session(): ?string
    {
        $container_access_credentials = $this->randomize_container_access_credentials($this->target_container, 'root');
        $target_container_ip = $this->docker->get_container_ip($this->target_container, $this->network);
        $this->wetty_session_token = Str::uuid();
        $wetty_container_params = "--ssh-host=".trim($target_container_ip)
            ." --ssh-user=".trim($container_access_credentials['user'])
            ." --base=/".$this->wetty_session_token;

        return $this->docker->run_container(
            env('WETTY_DOCKER_IMAGE'),
            $this->wetty_container_name,
            $this->network,
            $wetty_container_params
        );
    }

    public function end_wetty_session() {
        $this->docker->stop_container($this->wetty_container_name);
    }

    private function record_new_session($new_session) {
        # record event
        WettyEvents::create([

        ]);
        # update session
    }

    public function create_wetty_session() {
        if (!$this->docker->container_exists($this->wetty_container_name)) return;
        $new_session = $this->start_wetty_session();
        if (!is_null($new_session)) {
            Log::error("Unable to create wetty container");
        }
        $this->record_new_session($new_session);
    }
}
