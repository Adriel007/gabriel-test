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
        return $this->conn->query($sql);
    }

    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        $sql = "INSERT INTO $table (" . implode(', ', $keys) . ") VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($values);

        return $this->conn->lastInsertId();
    }

    public function update($table, $data, $where)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
        }
        $setClause = implode(', ', $set);

        $sql = "UPDATE $table SET $setClause WHERE $where";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($data));
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function select($table, $fields = '*', $where = '1=1', $params = [])
    {
        $sql = "SELECT $fields FROM $table WHERE $where";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Função boa pra debuggar
function log_error_json($custom = "")
{
    file_put_contents('log.json', json_encode([
        'last_error' => error_get_last(),
        'json_last_error' => json_last_error(),
        'json_last_error_msg' => json_last_error_msg(),
        'custom' => $custom
    ]));
}