<?php
require_once __DIR__ . '/../config/database.php';

class Product
{
    private static $conn = null;

    private string $id;
    private string $name;
    private float $price;
    private string $category;
    private string $description;
    private bool $featured;
    private bool $on_sale;

    public function __construct(
        string $id,
        string $name,
        float $price,
        string $category,
        string $description,
        bool $featured = false,
        bool $on_sale = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->description = $description;
        $this->featured = $featured;
        $this->on_sale = $on_sale;
    }

public static function db(){
    if (self::$conn === null) {

        self::$conn = mysqli_connect(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );

        if (!self::$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    return self::$conn;
}
public static function all(array $filters = []): array
{
    $conn = self::db();

    $sql = "SELECT * FROM products WHERE 1=1";

    if (!empty($filters['q'])) {

        $search = mysqli_real_escape_string($conn, $filters['q']);

        $sql .= " AND (
            name LIKE '%$search%' 
            OR description LIKE '%$search%' 
            OR category LIKE '%$search%'
        )";
    }

    if (!empty($filters['category']) && $filters['category'] !== 'all') {

        $category = mysqli_real_escape_string($conn, $filters['category']);

        $sql .= " AND category = '$category'";
    }

    $sql .= " ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    $products = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}
public static function create(array $data): bool
{
    $conn = self::db();

    $id = trim($data['id']);
    $name = trim($data['name']);
    $price = (float)$data['price'];
    $category = trim($data['category']);
    $description = trim($data['description']);
    $imagePath = '';

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

    $uploadDir = __DIR__ . '/../assets/images/';

    $fileName = time() . '_' . basename($_FILES['image']['name']);

    $targetFile = $uploadDir . $fileName;

    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

    $imagePath = 'assets/images/' . $fileName;
}

    $featured = isset($data['featured']) ? 1 : 0;
    $on_sale = isset($data['on_sale']) ? 1 : 0;

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO products
        (id, name, price, category, image, description, featured, on_sale)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssdsssii",
        $id,
        $name,
        $price,
        $category,
        $imagePath,
        $description,
        $featured,
        $on_sale
    );

    return mysqli_stmt_execute($stmt);
}
public static function update(string $id, array $data): bool
{
    $conn = self::db();

    $name = trim($data['name']);
    $price = (float)$data['price'];
    $category = trim($data['category']);
    $description = trim($data['description']);
    $currentProduct = self::find($id);

$imagePath = $currentProduct['image'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

    $uploadDir = __DIR__ . '/../assets/images/';

    $fileName = time() . '_' . basename($_FILES['image']['name']);

    $targetFile = $uploadDir . $fileName;

    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

    $imagePath = 'assets/images/' . $fileName;
}

    $featured = isset($data['featured']) ? 1 : 0;
    $on_sale = isset($data['on_sale']) ? 1 : 0;

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE products
        SET name = ?,
            price = ?,
            category = ?,
            image = ?,
            description = ?,
            featured = ?,
            on_sale = ?
        WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sdsssiis",
        $name,
        $price,
        $category,
        $imagePath,
        $description,
        $featured,
        $on_sale,
        $id
    );

    return mysqli_stmt_execute($stmt);
}
public static function delete(string $id): bool
{
    $conn = self::db();

    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM products WHERE id = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $id);

    return mysqli_stmt_execute($stmt);
}
public static function find(string $id): ?array
{
    $conn = self::db();

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM products WHERE id = ? LIMIT 1"
    );

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    return $product ?: null;
}
}
?>