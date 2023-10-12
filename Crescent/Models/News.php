<?php declare(strict_types=1);

require_once(dirname(__FILE__) . '/DB.php');

class News extends DB
{
    /**
     * PDOインスタンスを生成
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ニュースの全件を返す
     *
     * @param string $desc
     * @return array
     */
    public function all(string $desc, int $offset = 0, int $limit = 0): array
    {
        try {
            $sql = 'SELECT';
            $sql .= ' *';
            $sql .= ' FROM ' . $this->tblMain;
            $sql .= ' WHERE delete_at is NULL';
            
            if ($desc) {
                $sql .= ' ORDER BY posted_at DESC, id DESC';
            }
            if ($limit) {
                $sql .= ' LIMIT ' . $offset . ', ' .  $limit;
            }
            return $this->pdoObj->query($sql)->fetchAll();
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
    
    /**
     * ニュースの１件のレコードを追加
     *
     *@param array $postArr
     *@return void
     *
     */
    public function add(array $postArr): void
    {
        try {
            $sql  = 'INSERT';
            $sql .= ' INTO ' . $this->tblMain;
            $sql .= ' (posted_at, title, message, image)';
            $sql .= ' VALUES ("' . $postArr['posted'] . '", :title, :message, "' . $postArr['image'] . '")';
            
            $stmt = $this->pdoObj->prepare($sql);
            $stmt->bindValue(':title', $postArr['title'], PDO::PARAM_STR);
            $stmt->bindValue(':message', $postArr['message'], PDO::PARAM_STR);
            $stmt->execute();
            
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
    
    /**
     * ニュースの１件のレコードを取得
     *
     *@param int|string $id
     *@return array|bool
     *
     */
    public function find(int | string $id): array|bool
    {
        try {
            $sql  = 'SELECT';
            $sql .= ' *';
            $sql .= ' FROM ' . $this->tblMain;
            $sql .= ' WHERE id = :id AND delete_at is NULL';
            
            $stmt = $this->pdoObj->prepare($sql);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
    
    /**
     * ニュースの１件のレコードを削除
             *
             *@param int|string $id
             *@return void
             *
             */
            public function delete(int | string $id): void
            {
                try {
                    $sql  = 'UPDATE';
                    $sql .= ' ' . $this->tblMain;
                    $sql .= ' SET delete_at = NOW()';
                    $sql .= ' WHERE id = :id';
                    
                    $stmt = $this->pdoObj->prepare($sql);
                    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
                    $stmt->execute();
                    
                } catch (PDOException $e) {
                    header('Content-Type: text/plain; charset=UTF-8', true, 500);
                    exit($e->getMessage());
                }
            }

    /**
     * ニュースの１件のレコードを編集
             *
             *@param int|string $id
             *@return void
             *
             */
            public function update(array $postArr, int | string $id): void
            {
                try {
                    $sql  = 'UPDATE';
                    $sql .= ' ' . $this->tblMain;
                    $sql .= ' SET posted_at = :posted_at, title = :title, message = :message, image = :image';
                    $sql .= ' WHERE id = :id';
                    
                    $stmt = $this->pdoObj->prepare($sql);
                    $stmt->bindValue(':posted_at', $postArr['posted'], PDO::PARAM_STR);
                    $stmt->bindValue(':title', $postArr['title'], PDO::PARAM_STR);
                    $stmt->bindValue(':message', $postArr['message'], PDO::PARAM_STR);
                    $stmt->bindValue(':image', $postArr['image'], PDO::PARAM_STR);
                    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
                    $stmt->execute();
                    
                } catch (PDOException $e) {
                    header('Content-Type: text/plain; charset=UTF-8', true, 500);
                    exit($e->getMessage());
                }
            }
            
       /**
     * ニュースの全件数を取得
     *
     * @return int
     */
    public function count(): int
    {
        try {
            $sql = 'SELECT';
            $sql .= ' COUNT(*) AS hits';
            $sql .= ' FROM ' . $this->tblMain;
            $stmt = $this->pdoObj->query($sql);
            return $stmt->fetch()['hits'];
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}