<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//------------------------------------------------------------------------------
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../config/bootstrap.php';
require_once __DIR__.'/utils.php';
require_once __DIR__.'/UserProvider.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

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

/* Middleware
*******************************************************************************/

$app->before(function (Request $request) { // Parsing the request body
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

/* Routing
*******************************************************************************/

$app->mount('/api/1.0', include "api.php");
$app->mount('/api/1.0/sports', new Controllers\SportsControllerProvider());

$app->get('/', function() use($app) {
  return Utils::render("index.tpl.php");
})->secure('ROLE_ADMIN');

$app->get('/login', function() use($app) {
  return Utils::render("login.layout.tpl.php");
});

/*$app->error(function (\Exception $e, Request $request, $code) {
  switch ($code) {
      case 404:
          $message = array(
            'status' => 'error',
            'msg' => 'The requested page could not be found. '
          );
          break;
      default:
          $message = array(
            'status' => 'error',
            'msg' => 'We are sorry, but something went terribly wrong. '
          );;
  }

  return new Response(json_encode($message));
});
*/

$app->run();

//-----------------------------------------------------------------------------
