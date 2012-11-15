<?php

namespace RedefineLab\Geocoder;

interface Geocoder
{
    public function geocodeAddress($address);

    public function getLatitude();

    public function getLongitude();

}
