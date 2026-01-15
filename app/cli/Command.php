<?php
namespace App\Cli;

abstract class Command {
    abstract public function run($args = []);

    protected function say($message) {
        echo $message . "\n";
    }

    protected function success($message) {
        echo "{$message}\n";
    }

    protected function error($message) {
        echo "{$message}\n";
        exit(1);
    }

    protected function getDB() {
        $config = \App\Config\Config::get('database');

        return new \PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']}",
            $config['username'],
            $config['password']
        );
    }
}