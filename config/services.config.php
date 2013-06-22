<?php

namespace PhantomJsModule;

use Zend\ServiceManager\ServiceLocatorInterface;

return array(
    'factories' => array(
        'phantomjs' => function(ServiceLocatorInterface $sl) {
            $config = $sl->get('Config');
            return new Service\Client($config['phantomjs']['bin']);
        }
    )
);
