<?php
/**
 * User: Markus Tenghamn
 * Date: 16/08/16
 * Time: 19:56
 */

namespace Markustenghamn\Automile;

class ResourceOwnerIMEIConfig extends Automile {

    public $IMEI = "";
    public $VehicleId = 0;
    public $SerialNumber = "";
    public $IMEIDeviceType = 0;

    /**
     * @return string
     */
    public function getIMEI()
    {
        return $this->IMEI;
    }

    /**
     * @param string $IMEI
     * required
     */
    public function setIMEI($IMEI)
    {
        $this->IMEI = $IMEI;
    }

    /**
     * @return int
     */
    public function getVehicleId()
    {
        return $this->VehicleId;
    }

    /**
     * @param int $VehicleId
     * required
     */
    public function setVehicleId($VehicleId)
    {
        $this->VehicleId = $VehicleId;
    }

    /**
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->SerialNumber;
    }

    /**
     * @param string $SerialNumber
     * required
     */
    public function setSerialNumber($SerialNumber)
    {
        $this->SerialNumber = $SerialNumber;
    }

    /**
     * @return int
     */
    public function getIMEIDeviceType()
    {
        return $this->IMEIDeviceType;
    }

    /**
     * @param int $IMEIDeviceType
     * optional
     * 0 =
     * 1 =
     * 2 =
     * 3 =
     */
    public function setIMEIDeviceType($IMEIDeviceType)
    {
        $this->IMEIDeviceType = $IMEIDeviceType;
    }

    public function getImeiconfigs($imeiconfigid = null) {
        if ($imeiconfigid) {
            $endpoint = $this->getBase()."/v1/resourceowner/imeiconfigs/".$imeiconfigid;
            return $this->get($endpoint);
        }
        $endpoint = $this->getBase()."/v1/resourceowner/imeiconfigs";
        return $this->get($endpoint);
    }

    public function postImeiconfigs() {
        $endpoint = $this->getBase()."/v1/resourceowner/imeiconfigs";
        return $this->post($endpoint, $this->json());
    }

    public function deleteImeiconfigs($imeiconfigid) {
        $endpoint = $this->getBase()."/v1/resourceowner/imeiconfigs/".$imeiconfigid;
        return $this->delete($endpoint);
    }

    public function putImeiconfigs($imeiconfigid) {
        $endpoint = $this->getBase()."/v1/resourceowner/imeiconfigs/".$imeiconfigid;
        return $this->put($endpoint, $this->json());
    }
}