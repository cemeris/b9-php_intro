<?php
class DB
{
    protected $conn;
    protected $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name;

        $this->conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function getAll() {
        $sql = "SELECT * FROM `$this->table_name`";
        $result = $this->conn->query($sql);

        if ($result === false) {
            return [
                'status' => false
            ];
        }
        elseif ($result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $entities = [];
            foreach ($data as $row) {
                $id = $row['id'];
                unset($row['id']);
                $entities[$id] = $row;
            }

            return [
                'entities' => $entities,
                'status' => true
            ];
        } else {
            return [
                'entities' => [],
                'status' => true
            ];
        }
    }

    public function add(array $entity) {
        $columns = '';
        $values = '';

        $left_elements = count($entity);
        foreach ($entity as $column => $value) {
            $columns .= $column;

            $value = $this->conn->real_escape_string($value);
            $values .= "'$value'";

            if ($left_elements-- > 1) {
                $columns .= ', ';
                $values .= ', ';
            }
        }

        $sql = "INSERT INTO `$this->table_name` ($columns)
        VALUES ($values)";

        if ($this->conn->query($sql) === true) {
            $id = $this->conn->insert_id;

            $entity['id'] = $id;

            return [
                'status' => true,
                'entity' => $entity
            ];;
        } else {
            return [
                'status' => false,
                'message' => "Error: " . $sql . "<br>" . $this->conn->error
            ];
        }
    }
}