<?php
/**
 * User: Markus Tenghamn
 * Date: 16/08/16
 * Time: 19:55
 */

namespace Markustenghamn\Automile;


class ResourceOwnerTriggers extends Automile  {
    public $IMEIConfigId=0;
    public $TriggerType=0;
    public $TriggerTypeData="";
    public $ValidFrom="2016-08-11T07:31:37.067Z";
    public $ValidTo="2016-08-11T07:31:37.067Z";
    public $DestinationType=1;
    public $DestinationData="";
    public $DeliveryType=0;


    public function postTriggers() {
        $endpoint = $this->getBase()."/v1/resourceowner/triggers";
        return $this->post($endpoint, $this->json());
    }

    public function getTriggers($triggerid=null) {
        if ($triggerid) {
            $endpoint = $this->getBase()."/v1/resourceowner/triggers/".$triggerid;
            return $this->get($endpoint);
        }
        $endpoint = $this->getBase()."/v1/resourceowner/triggers";
        return $this->get($endpoint);
    }

    public function deleteTriggers($triggerid) {
        $endpoint = $this->getBase()."/v1/resourceowner/triggers/".$triggerid;
        return $this->delete($endpoint);
    }

    public function putTriggers($triggerid) {
        $endpoint = $this->getBase()."/v1/resourceowner/triggers/".$triggerid;
        $jsonobject = json_encode($this);
        return $this->put($endpoint, $jsonobject);
    }

    public function putTriggersMute($triggerid) {
        $endpoint = $this->getBase()."/v1/resourceowner/triggers/mute/".$triggerid;
        return $this->put($endpoint, $this->json());
    }

    public function putTriggersUnmute($triggerid) {
        $endpoint = $this->getBase()."/v1/resourceowner/triggers/unmute/".$triggerid;
        return $this->put($endpoint, $this->json());
    }

    /**
     * @return integer
     */
    public function getIMEIConfigId()
    {
        return $this->IMEIConfigId;
    }

    /**
     * @param integer $IMEIConfigId
     * required
     */
    public function setIMEIConfigId($IMEIConfigId)
    {
        $this->IMEIConfigId = $IMEIConfigId;
    }

    /**
     * @return integer or null
     */
    public function getTriggerType()
    {
        return $this->TriggerType;
    }

    /**
     * @param integer $TriggerType
     * optional
     * 02 = MILStatusOnOff,
     * 04 = DeviceConnect,
     * 05 = DeviceDisconnect,
     * 09 = EngineCoolantTemperatureThresholdReached,
     * 10 = SpeedNotification,
     * 12 = BatteryShutdown,
     * 13 = Geofence,
     * 15 = TripEnd,
     * 16 = TripStart,
     * 18 = Accident
     */
    public function setTriggerType($TriggerType)
    {
        $this->TriggerType = $TriggerType;
    }

    /**
     * @return string
     */
    public function getTriggerTypeData()
    {
        return $this->TriggerTypeData;
    }

    /**
     * @param string $TriggerTypeData
     * optional
     * Used to set a threshold value for Speed trigger
     */
    public function setTriggerTypeData($TriggerTypeData)
    {
        $this->TriggerTypeData = $TriggerTypeData;
    }

    /**
     * @return string
     */
    public function getValidFrom()
    {
        return $this->ValidFrom;
    }

    /**
     * @param string $ValidFrom
     * optional
     * Should be a date time string with format 2016-08-11T07:31:37.067Z
     */
    public function setValidFrom($ValidFrom)
    {
        $this->ValidFrom = $ValidFrom;
    }

    /**
     * @return string
     */
    public function getValidTo()
    {
        return $this->ValidTo;
    }

    /**
     * @param string $ValidTo
     * optional
     * Should be a date time string with format 2016-08-11T07:31:37.067Z
     */
    public function setValidTo($ValidTo)
    {
        $this->ValidTo = $ValidTo;
    }

    /**
     * @return integer
     */
    public function getDestinationType()
    {
        return $this->DestinationType;
    }

    /**
     * @param integer $DestinationType
     * optional
     * 1 = Email,
     * 2 = Sms ,
     * 3 = HttpPost,
     * 5 = MobilePush,
     */
    public function setDestinationType($DestinationType)
    {
        $this->DestinationType = $DestinationType;
    }

    /**
     * @return string
     */
    public function getDestinationData()
    {
        return $this->DestinationData;
    }

    /**
     * @param string $DestinationData
     * Email, url or number that the notification should be sent to
     */
    public function setDestinationData($DestinationData)
    {
        $this->DestinationData = $DestinationData;
    }

    /**
     * @return integer
     */
    public function getDeliveryType()
    {
        return $this->DeliveryType;
    }

    /**
     * @param integer $DeliveryType
     * optional
     * 0 =
     * 1 = EveryTrip
     * 2 =
     * 3 =
     */
    public function setDeliveryType($DeliveryType)
    {
        $this->DeliveryType = $DeliveryType;
    }
}