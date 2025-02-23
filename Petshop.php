<?php
session_start(); // Mulai session

class Petshop {
    private $id;
    private $name;
    private $category;
    private $price;
    private $image;

    // Constructor
    public function __construct($id, $name, $category, $price, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->image = $image;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getCategory() { return $this->category; }
    public function getPrice() { return $this->price; }
    public function getImage() { return $this->image; }

    // Setters
    public function setName($name) { $this->name = $name; }
    public function setCategory($category) { $this->category = $category; }
    public function setPrice($price) { $this->price = $price; }
    public function setImage($image) { $this->image = $image; }

    // Add Pet
    public static function addPet($pet) {
        if (!isset($_SESSION['pets'])) {
            $_SESSION['pets'] = []; // Inisialisasi session jika belum ada
        }
        $_SESSION['pets'][] = $pet; // Simpan pet ke session
    }

    // Get All Pets
    public static function getAllPets() {
        return $_SESSION['pets'] ?? []; // Ambil data dari session, default array kosong jika tidak ada
    }

    // Delete Pet by ID
    public static function deletePet($id) {
        if (isset($_SESSION['pets'])) {
            foreach ($_SESSION['pets'] as $key => $pet) {
                if ($pet->getId() == $id) {
                    unset($_SESSION['pets'][$key]); // Hapus pet dari session
                    $_SESSION['pets'] = array_values($_SESSION['pets']); // Re-index array
                    return true;
                }
            }
        }
        return false;
    }

    // Update Pet by ID
    public static function updatePet($id, $name, $category, $price, $image) {
        if (isset($_SESSION['pets'])) {
            foreach ($_SESSION['pets'] as $key => $pet) {
                if ($pet->getId() == $id) {
                    // Update data pet
                    $_SESSION['pets'][$key]->setName($name);
                    $_SESSION['pets'][$key]->setCategory($category);
                    $_SESSION['pets'][$key]->setPrice($price);
                    if ($image !== null) {
                        $_SESSION['pets'][$key]->setImage($image);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    // Get Pet by ID
    public static function getPetById($id) {
        if (isset($_SESSION['pets'])) {
            foreach ($_SESSION['pets'] as $pet) {
                if ($pet->getId() == $id) {
                    return $pet;
                }
            }
        }
        return null;
    }
}
?>