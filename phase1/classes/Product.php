<?php


class Product {

    private string $id;
    private string $name;
    private float  $price;
    private string $category;
    private string $image;
    private string $description;
    private bool   $featured;
    private bool   $on_sale;

  
    public function __construct(
        string $id,
        string $name,
        float  $price,
        string $category,
        string $image,
        string $description,
        bool   $featured = false,
        bool   $on_sale  = false
    ) {
        $this->id          = $id;
        $this->name        = $name;
        $this->price       = $price;
        $this->category    = $category;
        $this->image       = $image;
        $this->description = $description;
        $this->featured    = $featured;
        $this->on_sale     = $on_sale;
    }


    public function getId():          string { return $this->id; }
    public function getName():        string { return $this->name; }
    public function getPrice():       float  { return $this->price; }
    public function getCategory():    string { return $this->category; }
    public function getImage():       string { return $this->image; }
    public function getDescription(): string { return $this->description; }
    public function isFeatured():     bool   { return $this->featured; }
    public function isOnSale():       bool   { return $this->on_sale; }


    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPrice(float $price): void {
        // Cmimi nuk mund te jete negativ
        if ($price < 0) return;
        $this->price = $price;
    }

    public function setFeatured(bool $featured): void {
        $this->featured = $featured;
    }

    public function setOnSale(bool $on_sale): void {
        $this->on_sale = $on_sale;
    }


    public function getFormattedPrice(): string {
        return number_format($this->price, 2) . '€';
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['name'],
            $data['price'],
            $data['category'],
            $data['image'],
            $data['description'],
            $data['featured'] ?? false,
            $data['on_sale']  ?? false
        );
    }

  
    public function toArray(): array {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'price'       => $this->price,
            'category'    => $this->category,
            'image'       => $this->image,
            'description' => $this->description,
            'featured'    => $this->featured,
            'on_sale'     => $this->on_sale,
        ];
    }
}