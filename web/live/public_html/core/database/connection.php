<?php


class connection
{
    public static function make($config)
    {

        try {

            //return new PDO('mysql:host=iuliablog.develop.eiddew.com;dbname=iuliablogdb', 'iuliausr', 'z53kaF2kDdN1j6t');

            return new PDO(
            $config['connection'].';dbname='.$config['name'],
            $config['username'],
            $config['password'],
            $config['options']
            );

        } catch (PDOException $e) {

            die('COULD NOT CONNECT.');

        }

    }

}

