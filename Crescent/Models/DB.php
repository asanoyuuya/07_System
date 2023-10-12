<?php declare(strict_types=1);

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class DB
{
    protected $pdoObj;
    protected $tblMain;
    protected $tblAdmin;

    /**
     * PDOインスタンスを生成
     */
    public function __construct()
    {
        $env = Dotenv::createImmutable(__DIR__ . '/../')->load();
        $this->tblMain = $env['TBL_MAIN'];
        $this->tblAdmin = $env['TBL_ADMN'];

        try {
            $this->pdoObj = new PDO(
                'mysql:host=' . $env['DB_HOST'] . '; dbname=' . $env['DB_NAME'] . '; charset=utf8',
                $env['DB_USER'],
                $env['DB_PASS'],
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}