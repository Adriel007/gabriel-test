<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'dbgabriel';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
    public function query($sql)
    {
        $this->conn->exec($sql);
        return $this->conn->query($sql);
    }
    public function insert($table, $data)
    {
        $this->conn->exec('INSERT INTO ' . $table . ' SET ' . implode(', ', $data));
        return $this->conn->lastInsertId();
    }
    public function update($table, $data, $where)
    {
        $this->conn->exec('UPDATE ' . $table . ' SET ' . implode(', ', $data) . ' WHERE ' . $where);
    }
    public function delete($table, $where)
    {
        $this->conn->exec('DELETE FROM ' . $table . ' WHERE ' . $where);
    }
    public function select($table, $fields = '*', $where = '1=1')
    {
        return $this->conn->query('SELECT ' . $fields . ' FROM ' . $table . ' WHERE ' . $where);
    }

}