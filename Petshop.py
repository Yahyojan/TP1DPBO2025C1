class Petshop:
    products = []
    next_id = 1

    def __init__(self, name, category, price):
        self.id = Petshop.next_id
        self.name = name
        self.category = category
        self.price = price
        Petshop.products.append(self)
        Petshop.next_id += 1

    @staticmethod
    def display_products():
        if not Petshop.products:
            print("❌ Tidak ada produk yang tersedia.")
            return
        
        # Table Header
        line = "=" * 60
        print(line)
        print(f"| {'ID':<3} | {'🛍️ Nama':<12} | {'📦 Kategori':<10} | {'💰 Harga':<10} |")
        print(line)

        # Table Content
        for product in Petshop.products:
            print(f"| {product.id:<3} | {product.name:<12} | {product.category:<10} | Rp{product.price:<8.2f} |")
        
        print(line)

    @staticmethod
    def update_product(id, name, category, price):
        for product in Petshop.products:
            if product.id == id:
                product.name = name
                product.category = category
                product.price = price
                print("✅ Produk berhasil diperbarui.")
                return
        print(f"❌ Produk dengan ID {id} tidak ditemukan.")

    @staticmethod
    def delete_product(id):
        for product in Petshop.products:
            if product.id == id:
                Petshop.products.remove(product)
                print("✅ Produk berhasil dihapus.")
                return
        print(f"❌ Produk dengan ID {id} tidak ditemukan.")

    @staticmethod
    def search_product_by_name(name):
        found = False
        for product in Petshop.products:
            if product.name.lower() == name.lower():
                print("\n✅ Produk ditemukan:")
                print("-" * 40)
                print(f"🛍️ Nama Produk : {product.name}")
                print(f"📦 Kategori    : {product.category}")
                print(f"💰 Harga       : Rp{product.price}")
                print("-" * 40)
                found = True
        if not found:
            print(f"❌ Produk dengan nama '{name}' tidak ditemukan.")
