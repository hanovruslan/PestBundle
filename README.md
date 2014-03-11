Symfony2 Bundle

Service for https://github.com/educoder/pest

## Installation and configuration:

### Get the bundle

Add to your `evlz-pest-bundle` to your dependencies:

``` json

{

    "require": {

        ...
        "evlz/pest-bundle": "~1.0"

    }

}

```

To install, run `php composer[.phar] [update|install]`.

### Add EvlzPestBundle to your application kernel

```php

// app/AppKernel.php

public function registerBundles()

{

    return array(

        // ...

        new Evlz\PestBundle\EvlzPestBundle(),

        // ...

    );

}

```

You can get the pest service simply by using the container. From your controller you can do:

```php

$baseUrl = 'http://gdata.youtube.com';

// get service

$rest = $this->get('evlz_pest.rest');

// create client. \PestJSON by default

$client = $rest->createClient($baseUrl);

// create \Pest client

$clientType = \Evlz\PestBundle\Entity\Factory::TYPE_MAIN;//
$client = $rest->createClient($baseUrl, $clientType);

// create \Pest client. forced re-creation

$clientType = \Evlz\PestBundle\Entity\Factory::TYPE_JSON;//
$client = $rest->createClient($baseUrl, $clientType, true);



```

Please, see https://github.com/educoder/pest for details
