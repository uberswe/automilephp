<?php
/**
 * User: Markus Tenghamn
 * Date: 16/08/16
 * Time: 19:54
 */

namespace Markustenghamn\Automile;

class ResourceOwnerTrip extends Automile {
    public function getTrips($tripid = null) {
        if ($tripid) {
            $endpoint = $this->getBase()."/v1/resourceowner/trips/".trim($tripid);
            return $this->get($endpoint);
        }
        $endpoint = $this->getBase()."/v1/resourceowner/trips/";
        return $this->get($endpoint);
    }

    public function getTripsDetails($tripid) {
        $endpoint = $this->getBase()."/v1/resourceowner/trips/".trim($tripid)."/details";
        return $this->get($endpoint);
    }
}