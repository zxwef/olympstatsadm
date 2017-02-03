<?php

namespace Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SportsControllerProvider implements ControllerProviderInterface {
    public function connect(Application $app) {
        
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function(Request $request) use($app) {

          $sport = $app['entityManager']->find('Sports', $request->get('id'));

          if($sport) {
            $sport->setTitle($request->get('title'));
          } else {
            $sport = new \Sports();
            $sport->setType('')->setTitle($request->get('title'));
            $app['entityManager']->persist($sport);
          }

          $app['entityManager']->flush();

          return json_encode(array(
            'response' => 'ok'
          ));
        })
        ->method('PUT|POST|PATCH')
        ->secure('ROLE_ADMIN');

        $controllers->get('/', function(Request $request) use($app) {

          $dqlCount = "
            SELECT COUNT(s.id) AS cnt
            FROM Sports s
          ";

          $queryCount = $app['entityManager']->createQuery($dqlCount);
          $total = $queryCount->getResult()[0]['cnt'];

          $page = empty($request->get('p')) ? 0 : intval($request->get('p'));
          $cnt = 3;
          //$total = 10;
          $offset = $page * $cnt;

          $dql = "
            SELECT s.id, s.title
            FROM Sports s
            ORDER BY s.id DESC
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

        return $controllers;
    }
}
