<?php

namespace RedefineLab\Geocoder;

class GoogleGeocoder implements Geocoder
{

    private $noSingleResultChar;
    private $results;

    public function __construct($noSingleResultChar = '#')
    {
        $this->noSingleResultChar = $noSingleResultChar;
    }

    public function geocodeAddress($address)
    {
        $address = str_replace(' ', '+', $address);
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $this->results = json_decode(curl_exec($ch));
    }

    public function getLatitude()
    {
        if (!$this->resultIsValid())
        {
            return null;
        }

/*
        if (count($this->results->results) != 1)
        {
            return $this->noSingleResultChar;
        }
*/
        return $this->results->results[0]->geometry->location->lat;
    }

    public function getLongitude()
    {
        if (!$this->resultIsValid())
        {
            return null;
        }
/*
        if (count($this->results->results) != 1)
        {
            return $this->noSingleResultChar;
        }
*/
        return $this->results->results[0]->geometry->location->lng;
    }

    private function resultIsValid()
    {
        return (is_object($this->results) && ($this->results->status == 'OK' || $this->results->status == 'ZERO_RESULTS'));
    }

}
