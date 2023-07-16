<?php
namespace App;
class ListingGateway
{
    private \PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll($sortBy = 'added', $order = 'DESC'): array
    {
        $sql = "SELECT listings.*, models.model_name AS model
    FROM listings
    JOIN models ON listings.model_id = models.id
    ORDER BY $sortBy $order";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function findByUrl(string $url): ?array
    {
        $sql = "SELECT *
            FROM listings
            WHERE url = :url";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':url', $url, \PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row ? $row : null;
    }


    public function create(array $data): string
    {
        $sql = "INSERT INTO listings (model_id, price, memory, battery_capacity, added, url)
                VALUES (:model_id, :price, :memory, :battery_capacity, :added, :url)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":model_id", $data["model_id"], \PDO::PARAM_INT);
        $stmt->bindValue(":price", $data["price"] ?? 0, \PDO::PARAM_INT);
        $stmt->bindValue(":memory", $data["memory"] ?? 0, \PDO::PARAM_INT);
        $stmt->bindValue(":battery_capacity", $data["battery_capacity"] ?? null, \PDO::PARAM_INT);
        $stmt->bindValue(":added", $data["added"] ?? 0, \PDO::PARAM_STR);
        $stmt->bindValue(":url", $data["url"] ?? 0, \PDO::PARAM_STR);

        $stmt->execute();

        $lastInsertId = $this->conn->lastInsertId();

        return $lastInsertId;
    }

    public function getByModel($model): array
    {
        $sql = "SELECT *
                FROM listings
                WHERE model_id = :model
                ORDER BY added DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':model', $model, \PDO::PARAM_INT);
        $stmt->execute();

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