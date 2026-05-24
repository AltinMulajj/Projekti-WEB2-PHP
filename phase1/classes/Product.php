require_once __DIR__ . '/../config/database.php';

class Product
{
    private static $conn = null;

    private string $id;
    private string $name;
    private float $price;
    private string $category;
    private string $image;
    private string $description;
    private bool $featured;
    private bool $on_sale;

    public function __construct(
        string $id,
        string $name,
        float $price,
        string $category,
        string $image,
        string $description,
        bool $featured = false,
        bool $on_sale = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->image = $image;
        $this->description = $description;
        $this->featured = $featured;
        $this->on_sale = $on_sale;
    }
}
private static function db()
{
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