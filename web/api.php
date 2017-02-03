<?php
// https://habrahabr.ru/post/149678/
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$api = $app['controllers_factory'];

$api->get('/', function() {
  return '';
})->secure('ROLE_ADMIN');

$api->delete('/games/{id}', function($id) use($app) {

  $game = $app['entityManager']->find('Games', $id);
  $app['entityManager']->remove($game);
  $app['entityManager']->flush();

  return json_encode(array('status' => 'ok'));
})->secure('ROLE_ADMIN');

$api->get('/games/{id}', function($id) use($app) {

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
/*
$api->post('/sports', function(Request $request) use($app) {

  $sport = $app['entityManager']->find('Sports', $request->get('id'));

  if($sport) {
    $sport->setTitle($request->get('title'));
  } else {
    $sport = new Sports();
    $sport->setTitle($request->get('title'));
    $app['entityManager']->persist($sport);
  }

  $app['entityManager']->flush();

  return json_encode(array(
    'response' => 'ok'
  ));
})->secure('ROLE_ADMIN');

$api->get('/sports', function(Request $request) use($app) {

  $dqlCount = "
    SELECT COUNT(s.id) AS cnt
    FROM Sports s
  ";

  $queryCount = $app['entityManager']->createQuery($dqlCount);
  $total = $queryCount->getResult()[0]['cnt'];

  $page = empty($request->get('p')) ? 1 : intval($request->get('p'));
  $cnt = 3;
  //$total = 10;
  $offset = ($page - 1) * $cnt;

  $dql = "
    SELECT s.id, s.title
    FROM Sports s
  ";

  $query = $app['entityManager']
            ->createQuery($dql)
            ->setFirstResult($offset)
            ->setMaxResults($cnt);
  $result = $query->getResult();

  return json_encode(array(
    'response' => array(
      'items' => $result,
      'total' => $total,
      'cnt' => $cnt,
      'page' => $page,
    )
  ));
})->secure('ROLE_ADMIN');
*/
// отследить ошибку, чтобы был нормальный ответ для варианта без id (http://olympstatsadm.station8.tk/api/1.0/disciplines)
$api->get('/disciplines/{id}', function($id) use($app) {
  $dql = "
    SELECT d.id, d.title, d.sex
    FROM Disciplines d
    WHERE d.sportid = :sportID
  ";

  $query = $app['entityManager']->createQuery($dql)->setParameter(':sportID', $id);
  $result = $query->getResult();

  return json_encode(array(
    'response' => $result
  ));
})->secure('ROLE_ADMIN');

$api->get('/ogame/{id}', function() use($app) {
  $result = array();


  return json_encode(array(
    'response' => $result
  ));
});

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
