import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        
        while (true) {
            System.out.println("\n📌 Menu:");
            System.out.println("1️⃣  Tampilkan Produk");
            System.out.println("2️⃣  Tambah Produk");
            System.out.println("3️⃣  Perbarui Produk");
            System.out.println("4️⃣  Hapus Produk");
            System.out.println("5️⃣  Cari Produk berdasarkan Nama");
            System.out.println("6️⃣  Keluar");
            System.out.print("➡️  Pilih opsi: ");

            int choice = sc.nextInt();
            sc.nextLine();

            if (choice == 6) {
                System.out.println("👋 Keluar dari program.");
                break;
            }

            switch (choice) {
                case 1:
                    Petshop.displayProducts();
                    break;
                case 2:
                    System.out.print("🛍️ Masukkan Nama Produk: ");
                    String name = sc.nextLine();
                    System.out.print("📦 Masukkan Kategori Produk: ");
                    String category = sc.nextLine();
                    System.out.print("💰 Masukkan Harga Produk: ");
                    double price = sc.nextDouble();
                    new Petshop(name, category, price);
                    System.out.println("✅ Produk berhasil ditambahkan.");
                    break;
                case 3:
                    System.out.print("✏️  Masukkan ID Produk yang akan diperbarui: ");
                    int updateId = sc.nextInt();
                    sc.nextLine();
                    System.out.print("🛍️ Masukkan Nama Produk Baru: ");
                    String newName = sc.nextLine();
                    System.out.print("📦 Masukkan Kategori Produk Baru: ");
                    String newCategory = sc.nextLine();
                    System.out.print("💰 Masukkan Harga Produk Baru: ");
                    double newPrice = sc.nextDouble();
                    Petshop.updateProduct(updateId, newName, newCategory, newPrice);
                    break;
                case 4:
                    System.out.print("🗑️ Masukkan ID Produk yang akan dihapus: ");
                    int deleteId = sc.nextInt();
                    Petshop.deleteProduct(deleteId);
                    break;
                case 5:
                    System.out.print("🔍 Masukkan Nama Produk yang dicari: ");
                    String searchName = sc.nextLine();
                    Petshop.searchProductByName(searchName);
                    break;
                default:
                    System.out.println("⚠️ Pilihan tidak valid.");
            }
        }
        sc.close();
    }
}
