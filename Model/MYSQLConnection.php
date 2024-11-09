<?php


class MYSQLConnection extends PDO
{
    private const serverName = 'sql205.infinityfree.com';
    private const database = 'if0_37682655_rushi_projects';
    private const username = 'if0_37682655';
    private const password = 'H4Oib4haS7ytmq';
    private const connectionString = 'mysql:host=' . self::serverName . ";dbname=" . self::database;

    private ?PDO $connection = null;

    public function __construct()
    {
        parent::__construct(self::connectionString,self::username,self::password);
        $this->connection = new PDO(self::connectionString, self::username, self::password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!isset($this->connection)) {
            echo "connection is not done";
            throw new PDOException("Connection not established");
        }
    }
}