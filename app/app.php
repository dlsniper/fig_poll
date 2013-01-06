<?php

$index = $app['controllers_factory'];

$index->get(
    '/',
    function () use ($app) {

        $sql = "SELECT * FROM poll ORDER BY end_date - DATETIME('now') DESC, id DESC";
        $pollLines = $app['db']->fetchAll($sql);

        if (false !== $pollLines) {

        }

        return $app['twig']->render(
            'index.html.twig',
            array(
                'pollLines' => $pollLines,
            )
        );
    }
);

return $index;