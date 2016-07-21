<?php


class PDOConnection
{
    protected static $instance = null;
    protected $PDOconnection = null;
    protected $PDOStatement = null;

    /**
     *
     * PDOConnection constructor.
     */
    private function __construct() {}

    /**
     * @return null|PDOConnection
     */
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new PDOConnection();
        }
        return self::$instance;
    }

    /**
     * @return bool|null|PDO
     */
    public function getConnection()
    {
        if (is_null($this->PDOconnection))
        {
            if(!file_exists(__DIR__.'/../config.php'))
            {
                return false;
            }

            include(__DIR__.'/../config.php');

            try
            {
                $this->PDOconnection = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['password']);
                return $this->PDOconnection;
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        return $this->PDOconnection;
    }

    /**
     * @param $sql
     * @return PDOStatement
     */
    public function prepareStatement($sql)
    {
        try
        {
            $this->PDOStatement = $this->PDOconnection->prepare($sql);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
        return $this->PDOStatement;
    }

    /**
     * @param $parameters
     * @return mixed
     */
    public function executeStatement($parameters)
    {
        return $this->PDOStatement->execute($parameters);
    }

    /**
     * @param int $fetch_style
     * @return mixed
     */
    public function fetchOne($fetch_style = PDO::FETCH_ASSOC)
    {
        return $this->PDOStatement->fetch($fetch_style);
    }

    /**
     * @param int $fetch_style
     * @return mixed
     */
    public function fetchMany($fetch_style = PDO::FETCH_ASSOC)
    {
        return $this->PDOStatement->fetchAll($fetch_style);
    }

    /**
     * @return mixed
     */
    public function getLastInsertID()
    {
       return $this->PDOconnection->lastInsertID();
    }
}