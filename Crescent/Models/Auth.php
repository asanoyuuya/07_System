<?php declare(strict_types=1);

require_once(dirname(__FILE__) . '/DB.php');

class Auth extends DB 
{
    /**
     * PDOインスタンスを生成
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 認証許可
     * @param int|string $login_id
     * @return array|bool
     */
    public function login(string $login_id): array|bool
    {
        try {
            
            $sql = 'SELECT';
            $sql .= ' *';
            $sql .= ' FROM ' . $this->tblAdmin;
            $sql .= ' WHERE login_id=:login_id';
            
            $stmt = $this->pdoObj->prepare($sql);
            $stmt->bindValue(':login_id', $login_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}