<?php

require_once __DIR__ . "/../core/Model.php";

class Photo extends Model
{
    public function create(array $data): bool
    {
        $sql = "INSERT INTO photos
                (user_id, file_name, title, description)
                VALUES
                (:user_id, :file_name, :title, :description)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":user_id" => $data["user_id"],
            ":file_name" => $data["file_name"],
            ":title" => $data["title"],
            ":description" => $data["description"] ?? null
        ]);
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT
                    p.id,
                    p.user_id,
                    p.file_name,
                    p.title,
                    p.description,
                    p.date_time,
                    u.first_name,
                    u.last_name
                FROM photos p
                INNER JOIN users u ON p.user_id = u.id
                WHERE p.id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        $photo = $stmt->fetch();

        return $photo ?: null;
    }

    public function getAll(): array
    {
        $sql = "SELECT
                    p.id,
                    p.user_id,
                    p.file_name,
                    p.title,
                    p.description,
                    p.date_time,
                    u.first_name,
                    u.last_name
                FROM photos p
                INNER JOIN users u ON p.user_id = u.id
                ORDER BY p.date_time DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    public function getByUserId(int $userId): array
    {
        $sql = "SELECT
                    id,
                    user_id,
                    file_name,
                    title,
                    description,
                    date_time
                FROM photos
                WHERE user_id = :user_id
                ORDER BY date_time DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":user_id" => $userId
        ]);

        return $stmt->fetchAll();
    }


public function delete(int $id, int $userId): bool
{
    $sql = "SELECT file_name
            FROM photos
            WHERE id = :id
            AND user_id = :user_id";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ":id" => $id,
        ":user_id" => $userId
    ]);

    $photo = $stmt->fetch();

    if (!$photo) {
        return false;
    }

    $deleteSql = "DELETE FROM photos
                  WHERE id = :id
                  AND user_id = :user_id";

    $deleteStmt = $this->db->prepare($deleteSql);

    $deleted = $deleteStmt->execute([
        ":id" => $id,
        ":user_id" => $userId
    ]);

    if ($deleted) {
        $filePath = __DIR__ .
            "/../public/images/uploads/" .
            $photo["file_name"];

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    return $deleted;
}

public function count(): int
{
    $sql = "SELECT COUNT(*) AS total
            FROM photos";

    $stmt = $this->db->query($sql);

    return (int) $stmt->fetch()["total"];
}

}
