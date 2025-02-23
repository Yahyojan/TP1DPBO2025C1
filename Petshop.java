import java.util.ArrayList;

public class Petshop {
    private int id;
    private String name;
    private String category;
    private double price;

    private static ArrayList<Petshop> products = new ArrayList<>();
    private static int nextId = 1;

    public Petshop(String name, String category, double price) {
        this.id = nextId++;
        this.name = name;
        this.category = category;
        this.price = price;
        products.add(this);
    }

    public int getId() { return this.id; }
    public String getName() { return this.name; }
    public String getCategory() { return this.category; }
    public double getPrice() { return this.price; }

    public static void displayProducts() {
        if (products.isEmpty()) {
            System.out.println("❌ Tidak ada produk yang tersedia.");
            return;
        }

        // Table header with correct line extension
        String line = "===========================================================";
        System.out.println(line);
        System.out.printf("| %-3s | %-12s | %-10s | %-10s |\n", "ID", "🛍️ Nama", "📦 Kategori", "💰 Harga");
        System.out.println(line);

        // Table content
        for (Petshop product : products) {
            System.out.printf("| %-3d | %-12s | %-10s | Rp%-8.2f |\n",
                    product.getId(), product.getName(), product.getCategory(), product.getPrice());
        }
        System.out.println(line);
    }

    public static void updateProduct(int id, String name, String category, double price) {
        for (Petshop product : products) {
            if (product.getId() == id) {
                product.name = name;
                product.category = category;
                product.price = price;
                System.out.println("✅ Produk berhasil diperbarui.");
                return;
            }
        }
        System.out.println("❌ Produk dengan ID " + id + " tidak ditemukan.");
    }

    public static void deleteProduct(int id) {
        for (int i = 0; i < products.size(); i++) {
            if (products.get(i).getId() == id) {
                products.remove(i);
                System.out.println("✅ Produk berhasil dihapus.");
                return;
            }
        }
        System.out.println("❌ Produk dengan ID " + id + " tidak ditemukan.");
    }

    public static void searchProductByName(String name) {
        boolean found = false;
        for (Petshop product : products) {
            if (product.getName().equalsIgnoreCase(name)) {
                System.out.println("\n✅ Produk ditemukan:");
                System.out.println("-------------------------------");
                System.out.println("🛍️ Nama Produk : " + product.getName());
                System.out.println("📦 Kategori    : " + product.getCategory());
                System.out.println("💰 Harga       : Rp" + product.getPrice());
                System.out.println("-------------------------------");
                found = true;
            }
        }
        if (!found) {
            System.out.println("❌ Produk dengan nama '" + name + "' tidak ditemukan.");
        }
    }
}
