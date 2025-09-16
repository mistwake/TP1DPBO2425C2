class BarangElektronik:
    def __init__(self, id=0, nama="", harga=0, stok=0):
        self.__id = id
        self.__nama = nama
        self.__harga = harga
        self.__stok = stok

    # getter dan setter
    def set_id(self, id): self.__id = id
    def get_id(self): return self.__id

    def set_nama(self, nama): self.__nama = nama
    def get_nama(self): return self.__nama

    def set_harga(self, harga): self.__harga = harga
    def get_harga(self): return self.__harga

    def set_stok(self, stok): self.__stok = stok
    def get_stok(self): return self.__stok


# CRUD
daftar = []
# kita simpan list BarangElektronik di sini


def cari_index_by_id(id):
    for i, brg in enumerate(daftar):
        if brg.get_id() == id:
            return i
    return -1


def tambah_data():
    try:
        id = int(input("Masukkan ID: "))
    except ValueError:
        print("ID harus angka")
        return
    if cari_index_by_id(id) != -1:
        print("ID sudah digunakan.\n")
        return

    nama = input("Masukkan Nama: ")
    try:
        harga = int(input("Masukkan Harga: "))
        stok = int(input("Masukkan Stok: "))
    except ValueError:
        print("Harga/Stok harus angka")
        return

    daftar.append(BarangElektronik(id, nama, harga, stok))
    print("Data berhasil ditambahkan!\n")


def tampilkan_data():
    print("\n=== Daftar Barang Elektronik ===")
    for brg in daftar:
        print(f"ID: {brg.get_id()}, Nama: {brg.get_nama()}, Harga: {brg.get_harga()}, Stok: {brg.get_stok()}")
    print()


def update_data():
    try:
        id = int(input("Masukkan ID yang ingin diupdate: "))
    except ValueError:
        print("ID harus angka")
        return
    idx = cari_index_by_id(id)
    if idx != -1:
        nama_baru = input("Masukkan Nama baru: ")
        try:
            harga_baru = int(input("Masukkan Harga baru: "))
            stok_baru = int(input("Masukkan Stok baru: "))
        except ValueError:
            print("Harga/Stok harus angka")
            return
        daftar[idx].set_nama(nama_baru)
        daftar[idx].set_harga(harga_baru)
        daftar[idx].set_stok(stok_baru)
        print("Data berhasil diupdate!\n")
    else:
        print("Barang tidak ditemukan.\n")


def hapus_data():
    try:
        id = int(input("Masukkan ID yang ingin dihapus: "))
    except ValueError:
        print("ID harus angka")
        return
    idx = cari_index_by_id(id)
    if idx != -1:
        daftar.pop(idx)
        print("Data berhasil dihapus.\n")
    else:
        print("Barang tidak ditemukan.\n")


def cari_data():
    try:
        id = int(input("Masukkan ID yang ingin dicari: "))
    except ValueError:
        print("ID harus angka")
        return
    idx = cari_index_by_id(id)
    if idx != -1:
        brg = daftar[idx]
        print(f"Ditemukan: ID {brg.get_id()}, Nama: {brg.get_nama()}, Harga: {brg.get_harga()}, Stok: {brg.get_stok()}\n")
    else:
        print("Barang tidak ditemukan.\n")
