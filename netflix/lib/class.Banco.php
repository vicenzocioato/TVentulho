<?php
require_once "../config/conexao.php";
class Banco {
    private static $pdo;

    static function getConexao(){
        global $CONEXAO;

        if (!self::$pdo){
            self::$pdo = new PDO("{$CONEXAO['banco']}:dbname={$CONEXAO['dbname']};charset=utf8mb4;host={$CONEXAO['host']}", $CONEXAO['user'], $CONEXAO['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"]);
        }

        return self::$pdo;
    }
}
?>