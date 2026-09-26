<?php

require_once __DIR__ . "/../core/Model.php";

class User extends Model
{
    public function create(array $data): bool
    {
        $sql = "INSERT INTO users
                (first_name, last_name, email, password, location, description, occupation)
                VALUES
                (:first_name, :last_name, :email, :password, :location, :description, :occupation)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":first_name" => $data["first_name"],
            ":last_name" => $data["last_name"],
            ":email" => $data["email"],
            ":password" => $data["password"],
            ":location" => $data["location"] ?? null,
            ":description" => $data["description"] ?? null,
            ":occupation" => $data["occupation"] ?? null
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT *
                FROM users
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":email" => $email
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT *
                FROM users
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function getAll(): array
    {
        $sql = "SELECT id, first_name, last_name, email,
                       location, description, occupation
                FROM users
                ORDER BY id DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }
public function emailExists(string $email): bool
{
    $sql = "SELECT id
            FROM users
            WHERE email = :email
            LIMIT 1";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ":email" => $email
    ]);

    return (bool) $stmt->fetch();
}

public function count(): int
{
    $sql = "SELECT COUNT(*) AS total
            FROM users";

    $stmt = $this->db->query($sql);

    return (int) $stmt->fetch()["total"];
}

}
