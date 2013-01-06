#!/usr/bin/env php
<?php

$dbFilename = __DIR__ . '/../db/fig_poll.sqlite';

clearstatcache();

if (file_exists($dbFilename)) {
    echo "DB already exists\n\n";

    exit(0);
}

try {
    $db = new PDO('sqlite:' . $dbFilename);
} catch (Exception $e) {
    echo $e->getMessage() . "\n\n";

    exit(1);
}

$sqls = array();
$sqls[] = 'CREATE TABLE "user" ("id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, "github_id" VARCHAR(200), "is_admin" BOOLEAN, "is_fig" BOOLEAN)';
$sqls[] = 'CREATE TABLE "poll" ("id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, "name" VARCHAR(255), "link" VARCHAR(255), "is_successful" BOOLEAN, "start_date" DATE, "end_date" DATE)';
$sqls[] = 'CREATE TABLE "vote" ("id" INTEGER PRIMARY KEY NOT NULL, "poll_id" INTEGER NOT NULL, "user_id" INTEGER NOT NULL)';

foreach($sqls as $sql) {
    $result = $db->query($sql);


    if ($result === false) {
        echo "Something went wrong while creating the basic DB structure\n\n";

        exit(1);
    }
}

echo "DB created succesfully\n\n";

exit(0);
