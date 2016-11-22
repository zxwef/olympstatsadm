<?php

use Symfony\Component\HttpFoundation\Request;

$api = $app['controllers_factory'];

$api->get('/', function() {
  return '';
})->secure('ROLE_ADMIN');

$api->get('/games/{id}', function(Silex\Application $app, $id) use($app) {

  if(!empty($id)) {
    $dql = "
            SELECT g.id, g.year, g.season, g.city, c.title AS country
            FROM Games g
                LEFT JOIN g.countries c
            WHERE g.id = :id
            ";

    $query = $app['entityManager']->createQuery($dql)->setParameter(':id', $id);
    $item = $query->getResult();

    $result = array(
      'response' => $item ? $item[0] : array()
    );
  } else {
    $dql = "
            SELECT g.id, g.year, g.season, g.city, c.title AS country
            FROM Games g
                LEFT JOIN g.countries c
            ";

    $query = $app['entityManager']->createQuery($dql);
    $items = $query->getResult();
    $result = array(
      'response' => array(
        'items' => $items
      )
    );
  }

  return json_encode($result);
})
->value('id', '0')
->secure('ROLE_ADMIN');

$api->match('/games', function(Silex\Application $app, Request $request) use($app) {
  try {
    $game = $app['entityManager']->find('Games', $request->get('id'));
    $country = $app['entityManager']->find('Countries', $request->get('country'));

    if($game) {
      $game->setYear($request->get('year'))
            ->setSeason($request->get('season'))
            ->setCountry($country)
            ->setCity($request->get('city'));
    } else {
      $game = new Games();
      $game->setId($request->get('id'))
            ->setYear($request->get('year'))
            ->setSeason($request->get('season'))
            ->setCountry($country)
            ->setCity($request->get('city'));

      $app['entityManager']->persist($game);
    }

    $app['entityManager']->flush();

    return json_encode(array('response' => array()));
  } catch(Exception $e) {
    Utils::dumper($e->getMessage(), 1, '');
  }
})
->method('PUT|POST|PATCH')
->secure('ROLE_ADMIN');

$api->get('/countries', function(Silex\Application $app, Request $request) use($app) {

  $dql = "
          SELECT c.id, c.title AS name
          FROM Countries c
          ";

  $query = $app['entityManager']->createQuery($dql);
  $result = array(
      'response' => $query->getResult()
  );

  //Utils::dumper($result, 1);
  return json_encode($result);
})
->secure('ROLE_ADMIN');

return $api;
