<?php

//require_once __DIR__ . "/entities/games.php";

$api = $app['controllers_factory'];

$api->get('/', function() {
  return 'api';
})->secure('ROLE_ADMIN');

$api->get('/games/{id}', function(Silex\Application $app, $id) use($app) {

  $dql = "
          SELECT g.id, g.year, g.city, c.title AS country
          FROM Games g
              LEFT JOIN g.countries c
          ";

  $query = $app['entityManager']->createQuery($dql);
  $result = $query->getResult();
  /*$result = array(
    'type' => 'ADD_GAME',
    'state' => array(
      'games' => $query->getResult()
    )
  );*/

  //Utils::dumper($result);
  return json_encode($result);
})
->value('id', '0')
->secure('ROLE_ADMIN');

return $api;
