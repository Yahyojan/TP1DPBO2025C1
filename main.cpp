#include <iostream>
#include "Petshop.cpp"

using namespace std;

int main() {
    Petshop myPetShop;
    int choice;
    int id;
    char name[50], category[50];
    double price;

    do {
        cout << "\nMenu:\n";
        cout << "1. Tampilkan Produk\n";
        cout << "2. Tambah Produk\n";
        cout << "3. Perbarui Produk\n";
        cout << "4. Hapus Produk\n";
        cout << "5. Cari Produk berdasarkan Nama\n";
        cout << "6. Keluar\n";
        cout << "Pilih opsi: ";
        cin >> choice;

        switch (choice) {
            case 1:
                myPetShop.displayProducts();
                break;
            case 2:
                cout << "Masukkan Nama Produk: ";
                cin.ignore();
                cin.getline(name, 50);
                cout << "Masukkan Kategori Produk: ";
                cin.getline(category, 50);
                cout << "Masukkan Harga Produk: ";
                cin >> price;
                myPetShop.addProduct(name, category, price);
                break;
            case 3:
                cout << "Masukkan ID Produk yang akan diperbarui: ";
                cin >> id;
                cout << "Masukkan Nama Produk Baru: ";
                cin.ignore();
                cin.getline(name, 50);
                cout << "Masukkan Kategori Produk Baru: ";
                cin.getline(category, 50);
                cout << "Masukkan Harga Produk Baru: ";
                cin >> price;
                myPetShop.updateProduct(id, name, category, price);
                break;
            case 4:
                cout << "Masukkan ID Produk yang akan dihapus: ";
                cin >> id;
                myPetShop.deleteProduct(id);
                break;
            case 5:
                cout << "Masukkan Nama Produk yang dicari: ";
                cin.ignore();
                cin.getline(name, 50);
                myPetShop.searchProductByName(name);
                break;
            case 6:
                cout << "Keluar dari program.\n";
                break;
            default:
                cout << "Pilihan tidak valid.\n";
        }
    } while (choice != 6);

    return 0;
}