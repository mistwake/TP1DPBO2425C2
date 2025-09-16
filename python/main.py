import barang_elektronik as be

def main():
    while True:
        print("=== MENU TOKO ELEKTRONIK ===")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Update Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("0. Keluar")
        pilihan = input("Pilih menu: ")

        if pilihan == "1":
            be.tambah_data()
        elif pilihan == "2":
            be.tampilkan_data()
        elif pilihan == "3":
            be.update_data()
        elif pilihan == "4":
            be.hapus_data()
        elif pilihan == "5":
            be.cari_data()
        elif pilihan == "0":
            print("Program selesai.")
            break
        else:
            print("Pilihan tidak valid.\n")

if __name__ == "__main__":
    main()
