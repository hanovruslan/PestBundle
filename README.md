Symfony2 Bundle

Service for https://github.com/educoder/pest

## Installation and configuration:

### Get the bundle

Add to your `evlz-pest-bundle` to your dependencies:

``` json

{

    "require": {

        ...
        "evlz/pest-bundle": "dev-master"

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

// get base service

$rest = $this->get('evlz_pest.rest');

// get json service (auto converting for request\response excluding exception messages (@todo) )

$restJSON = $this->get('evlz_pest.rest_json');


```

Please, see https://github.com/educoder/pest for details
