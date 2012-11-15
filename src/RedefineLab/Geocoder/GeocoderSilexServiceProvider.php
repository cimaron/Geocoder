<?php

namespace RedefineLab\Geocoder;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GeocoderSilexServiceProvider implements ServiceProviderInterface
{

    public function boot(Application $app)
    {
        // nothing to do here
    }

    public function register(Application $app)
    {
        $app['geocoder.google'] = $app->share(function() use ($app)
                {
                    return new GoogleGeocoder($app);
                });
    }

}
