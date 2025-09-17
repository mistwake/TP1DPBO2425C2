# TP1

## JANJI
Saya Anas Miftakhul Falah dengan 2410865 mengerjakan tugas praktikum 1
dalam mata kuliah DPBO untuk keberkahan-Nya maka saya
tidak akan melakukan kecurangan seperti yang telah di spesifikasikan Aamiin.

## DESIGN
- Program ini dibuat untuk manajemen barang elektronik di sebuah toko elektronik.
- Yang dimana program ini dibuat menggunakan 4 bahasa, yaitu C++, Python, Java, PHP.
- Fitur daripada program: Tambah, menampilkan, hapus, update, cari data spesifik.

## FLOW CODE
1. Mulai Program
   - Inisialisasi array kosong untuk menyimpan data barang nya.
2. Tampilkan menu utama
   - (1)Tambah data
   - (2)Tampilkan data
   - (3)Update data
   - (4)Hapus data
   - (5)Cari data
   - (0)Keluar 
4. User diminta masukkan menu mana yang ingin digunakan
5. Switch case
   - Jika 1 (tammbah data)
     - Input ID
     - Cek apakah ID sudah tersebut sudah digunakan atau belum
       - Jika ada: maka akan menampilkan pesan error.
       - Jika belum: maka lanjut input nama, harga, stok.
       - Menambahkan barang baru ke array.
       - Menampilkan pesan sukses.
    - Jika 2 (tampilkan data)
      - melakukan looping sebanyak jumlah barang di array.
      - cetak ID, nama, harga, stok.
    - Jika 3 (update data)
      - input id yang mau diupdate
      - cari di tiap index id yang sesuai
        - jika ketemu: user diminta untuk nama baru, harga baru, stok baru.
        - jika tidak ada id tsb: menampilkan pesan error.
    - Jika 4 (hapus data)
      - input ID yang mau dihapus
      - cari di tiap index id yang sesuai
        - jika ketemu: hapus dari array.
        - jika tidak ketemu: tampilkan pesan error.
    - Jika 5 (cari data)
      - input ID yang mau dicari
      - cari di tiap index id yang sesuai
        - jika ketemu: tampilkan detail barang
        - jika tidak ada: tampilkan pesan error.
    - jika 0 (keluar)
      - Tampilkan pesan "program seslesai".

## DOKUMENTASI
  [C++](https://youtu.be/H26400hEQdc)
  [Python](https://youtu.be/e06oddERDa8)
  [Java](https://youtu.be/EFFiAUxY6Ik)
  [PHP](https://youtu.be/j1JL4t2OB_4)
      
