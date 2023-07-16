<?php
namespace App;
class ModelGateway
{
    private \PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT *
        FROM models";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function update(array $current, array $new)
    {

    }

    public function delete(string $id)
    {

    }
}