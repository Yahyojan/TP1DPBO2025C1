from Petshop import Petshop

def main():
    while True:
        print("\n🐾 Welcome to the Petshop Management System 🐾")
        print("==============================================")
        print("1️⃣ Add a new product")
        print("2️⃣ Display all products")
        print("3️⃣ Update a product")
        print("4️⃣ Delete a product")
        print("5️⃣ Search for a product")
        print("6️⃣ Exit")
        print("==============================================")
        choice = input("➡️ Choose an option (1-6): ")

        if choice == "1":
            # User input for new product
            name = input("Enter product name: ")
            category = input("Enter category: ")
            price = float(input("Enter price: "))
            Petshop(name, category, price)  # Automatically adds to the list
            print("✅ Product added successfully!")

        elif choice == "2":
            # Display products in a formatted table
            Petshop.display_products()

        elif choice == "3":
            # Update a product by ID
            Petshop.display_products()
            product_id = int(input("Enter product ID to update: "))
            new_name = input("Enter new name: ")
            new_category = input("Enter new category: ")
            new_price = float(input("Enter new price: "))
            Petshop.update_product(product_id, new_name, new_category, new_price)
            print("✅ Product updated successfully!")

        elif choice == "4":
            # Delete a product by ID
            Petshop.display_products()
            product_id = int(input("Enter product ID to delete: "))
            Petshop.delete_product(product_id)
            print("✅ Product deleted successfully!")

        elif choice == "5":
            # Search for a product by name
            search_name = input("Enter product name to search: ")
            Petshop.search_product_by_name(search_name)

        elif choice == "6":
            print("👋 Exiting program. Have a great day!")
            break  # Exit the loop

        else:
            print("❌ Invalid option! Please choose between 1-6.")

if __name__ == "__main__":
    main()
