#include <iostream>
#include <cstring> // For C-style string functions like strcpy, strcmp

using namespace std;

class Petshop {
private:
    struct Product {
        int id;
        char name[50]; // C-style string for name
        char category[50]; // C-style string for category
        double price;
    };

    static const int MAX_PRODUCTS = 100; // Maximum number of products
    Product products[MAX_PRODUCTS]; // Array to store products
    int productCount; // Current number of products

public:
    // Constructor
    Petshop() : productCount(0) {}

    // Destructor
    ~Petshop() {
        cout << "Objek Petshop dihancurkan.\n";
    }

    // Display all products
    void displayProducts() const {
        if (productCount == 0) {
            cout << "Tidak ada produk yang tersedia.\n";
            return;
        }

        for (int i = 0; i < productCount; i++) {
            cout << "ID: " << products[i].id << "\n";
            cout << "Nama Produk: " << products[i].name << "\n";
            cout << "Kategori: " << products[i].category << "\n";
            cout << "Harga: Rp" << products[i].price << "\n";
            cout << "-------------------------\n";
        }
    }

    // Add a new product
    void addProduct(const char* name, const char* category, double price) {
        if (productCount >= MAX_PRODUCTS) {
            cout << "Batas maksimum produk telah tercapai.\n";
            return;
        }

        products[productCount].id = productCount + 1; // Auto-generate ID
        strcpy(products[productCount].name, name); // Copy name
        strcpy(products[productCount].category, category); // Copy category
        products[productCount].price = price;
        productCount++;
        cout << "Produk berhasil ditambahkan.\n";
    }

    // Update a product by ID
    void updateProduct(int id, const char* name, const char* category, double price) {
        for (int i = 0; i < productCount; i++) {
            if (products[i].id == id) {
                strcpy(products[i].name, name); // Update name
                strcpy(products[i].category, category); // Update category
                products[i].price = price; // Update price
                cout << "Produk berhasil diperbarui.\n";
                return;
            }
        }
        cout << "Produk dengan ID " << id << " tidak ditemukan.\n";
    }

    // Delete a product by ID
    void deleteProduct(int id) {
        bool found = false;
        for (int i = 0; i < productCount; i++) {
            if (products[i].id == id) {
                // Shift all elements after the deleted product to the left
                for (int j = i; j < productCount - 1; j++) {
                    products[j] = products[j + 1];
                }
                productCount--;
                found = true;
                cout << "Produk berhasil dihapus.\n";
                break;
            }
        }
        if (!found) {
            cout << "Produk dengan ID " << id << " tidak ditemukan.\n";
        }
    }

    // Search for a product by name
    void searchProductByName(const char* name) const {
        bool found = false;
        for (int i = 0; i < productCount; i++) {
            if (strcmp(products[i].name, name) == 0) { // Compare strings
                cout << "ID: " << products[i].id << "\n";
                cout << "Nama Produk: " << products[i].name << "\n";
                cout << "Kategori: " << products[i].category << "\n";
                cout << "Harga: Rp" << products[i].price << "\n";
                cout << "-------------------------\n";
                found = true;
            }
        }
        if (!found) {
            cout << "Produk dengan nama " << name << " tidak ditemukan.\n";
        }
    }
};