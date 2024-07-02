<?php
// /namespace solo con las clases del proyecto/
namespace app\libs\connection;

final class Connection{

        public static function get(){

            return new \PDO(DB_DSN,
        DB_USER,DB_PASS,
    [
        \PDO::ATTR_DEFAULT_FETCH_MODE=> \PDO::FETCH_OBJ

    ]);

        }
    }