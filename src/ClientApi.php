<?php
/**
 * User: Markus Tenghamn
 * Date: 16/08/16
 * Time: 19:57
 */

namespace Markustenghamn\Automile;

class ClientApi extends Automile {

    public function getApi() {
        $endpoint = $this->getBase()."/v1/client/api";
        return $this->get($endpoint);
    }

}