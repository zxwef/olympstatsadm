<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//------------------------------------------------------------------------------
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../config/bootstrap.php';
require_once __DIR__.'/utils.php';
require_once __DIR__.'/UserProvider.php';

use Silex\Route;
class MyRoute extends Route
{
    use Route\SecurityTrait;
}

$app = new Silex\Application();
$app['route_class'] = 'MyRoute';

$app['debug'] = DEV_MODE;

$app['entityManager'] = $entityManager;

// http://symfony.com/doc/current/components/security.html
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());

$app['security.default_encoder'] = function ($app) {
    return $app['security.encoder.pbkdf2'];
};

// generate pass
/*$user = new Users();
$plainPassword = 'qwerty';
$encoder = $app['security.encoder_factory']->getEncoder($user);
$encoded = $encoder->encodePassword($plainPassword, '');
Utils::dumper($encoded, 1);*/

$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/',
        'http' => true,
        'users' => array(
            // raw password is foo
            'admin' => array('ROLE_ADMIN', CONFIG_TMP_ADMIN_PSWD),
        ),
    ),
);

$token = $app['security.token_storage']->getToken();

if (null !== $token) {
    $user = $token->getUser();
}

/* Routing
*******************************************************************************/

$app->mount('/api/1.0', include "api.php");

$app->get('/', function() use($app) {
  return Utils::render("index.tpl.php");
})->secure('ROLE_ADMIN');

$app->get('/login', function() use($app) {
  return Utils::render("login.layout.tpl.php");
});

$app->run();

//-----------------------------------------------------------------------------