#!/usr/bin/env php
<?php

namespace Typo3Upgrade;

// php configuration
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// define root path (one dir up)
$typo3RootDir = realpath(__DIR__ . '/../');
define('TYPO3_ROOT_DIR', $typo3RootDir);
chdir(TYPO3_ROOT_DIR);

require_once('./vendor/autoload.php');
require_once(__DIR__ . '/functions.php');

// cleanup opcache
clearCache();

// get composer and run initial install
if (!file_exists('composer.phar')) {
    copy('https://getcomposer.org/installer', 'composer-setup.php');
    exec('php composer-setup.php');
    unlink('composer-setup.php');
}

$instance = getCurrentInstance();
$upgradeBranches = getUpgradeBranches();
$isFirst = true;

foreach ($upgradeBranches as $numericVersion => $branch) {
    run('echo "---------------------- git checkout ' . $branch . '"');
    run('git checkout ' . $branch);
    run('rm -rf typo3_src typo3 index.php typo3conf/ext typo3temp vendor typo3conf/realurl_autoconf.php');
    run('git reset --hard');

    clearCache();
    run('php composer.phar install');
    clearCache();

    run('./vendor/bin/typo3cms database:updateschema "*.add,*.change"');
    if (!$isFirst) {
        run('./vendor/bin/typo3cms upgrade:all');
    }

    dbUpdate(__DIR__ . '/sql/' . $numericVersion . '.sql');
    dbUpdate(__DIR__ . '/config/project/'. $numericVersion . '.sql');
    dbUpdate(__DIR__ . '/config/instances/' . $instance . '/' . $numericVersion . '.sql');

    $isFirst = false;
}
