#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Commands\InitCommand;
use Commands\Objects\CreateCommand;
use Commands\Objects\DeleteCommand;
use Commands\Objects\GetCommand;
use Commands\Objects\UpdateCommand;
use Symfony\Component\Console\Application;

if (file_exists(__DIR__.'/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();
}

$application = new Application();

$application->add(new GetCommand());
$application->add(new CreateCommand());
$application->add(new DeleteCommand());
$application->add(new UpdateCommand());
$application->add(new InitCommand());

$application->run();
