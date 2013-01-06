#!/usr/bin/env php
<?php

$dbFilename = __DIR__ . '/../db/fig_poll.sqlite';

clearstatcache();

if (!file_exists($dbFilename)) {
    echo "DB does not exist\n\n";

    exit(1);
}

try {
    $db = new PDO('sqlite:' . $dbFilename);
} catch (Exception $e) {
    echo $e->getMessage() . "\n\n";

    exit(1);
}

$sqls = array();
$sqls[] = "INSERT INTO poll (id, name, link, is_successful, start_date, end_date) VALUES (NULL, 'Logger', 'https://github.com/php-fig/fig-standards/pull/60', 1, '2012-12-14', '2012-12-27');";
$sqls[] = "INSERT INTO poll (id, name, link, is_successful, start_date, end_date) VALUES (NULL, 'Logger', 'https://github.com/php-fig/fig-standards/pull/60', 1, '2012-12-14', '2013-02-27');";
$sqls[] = "INSERT INTO poll (id, name, link, is_successful, start_date, end_date) VALUES (NULL, 'Logger', 'https://github.com/php-fig/fig-standards/pull/60', 0, '2012-12-14', '2012-12-27');";
$sqls[] = 'INSERT INTO "user" ("id", "github_id", "is_admin", "is_fig") VALUES (NULL, "dlsniper", 1, 1)';

foreach($sqls as $sql) {
    $result = $db->query($sql);


    if ($result === false) {
        echo "Something went wrong while adding the fixtures into the database\n\n";

        exit(1);
    }
}

echo "DB fixtures added succesfully\n\n";

exit(0);

