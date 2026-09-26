<?php

require_once __DIR__ . "/../core/Model.php";

class Comment extends Model
{
    public function create(array $data): bool
    {
        $sql = "INSERT INTO comments
                (photo_id, user_id, comment)
                VALUES
                (:photo_id, :user_id, :comment)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":photo_id" => $data["photo_id"],
            ":user_id" => $data["user_id"],
            ":comment" => $data["comment"]
        ]);
    }

    public function getByPhotoId(int $photoId): array
    {
        $sql = "SELECT
                    c.id,
                    c.photo_id,
                    c.user_id,
                    c.comment,
                    c.date_time,
                    u.first_name,
                    u.last_name
                FROM comments c
                INNER JOIN users u ON c.user_id = u.id
                WHERE c.photo_id = :photo_id
                ORDER BY c.date_time ASC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":photo_id" => $photoId
        ]);

        return $stmt->fetchAll();
    }

 
public function delete(int $id, int $userId): bool
{
    $sql = "DELETE FROM comments
            WHERE id = :id
            AND user_id = :user_id";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ":id" => $id,
        ":user_id" => $userId
    ]);
}


public function count(): int
{
    $sql = "SELECT COUNT(*) AS total
            FROM comments";

    $stmt = $this->db->query($sql);

    return (int) $stmt->fetch()["total"];
}
}
