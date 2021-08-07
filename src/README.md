# Simple Step inside Slim 3
- Install Slim3
```
    composer require slim/slim:3.*
```

- Initiate Container 
```
    $container = $app->getContainer();
```

- Installing twig template engine
```
    composer require slim/twig-view:2.*
```

- Register Twig-view component as view on Slim3 Container
```
    $container['view'] = function ($container) {
        $view = new \Slim\Views\Twig('path/to/templates', [
            'cache' => 'path/to/cache'
        ]);

        // Instantiate and add Slim specific extension
        $router = $container->get('router');
        $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
        $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

        return $view;
    };
```

- autoload app folder using psr-4
```
    // add autoload on composer.json
    "require" :{
    ...
    },
    "autoload": {
        "psr-4": {
            "App\\" : "app"
        }
    }

    //update autoload
    composer dump-autoload -o 
```

- installing Eloquent
```
    composer require illuminate/database
```

- configure illuminate, add in settings
```
    'settings' => [
        ...,
        'db' => [
                        'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'user',
            'password' => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
```

- configure db container for using Eloquent
```
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
    $container['db'] = function ($container) use ($capsule){
        return $capsule;
    };
```