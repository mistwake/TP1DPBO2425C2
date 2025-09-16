#include <iostream>
#include <string>
using namespace std;

// class barang elektronik
class BarangElektronik
{
private:
    int id;      // atribut id
    string nama; // atribut nama
    int harga;   // atribut harga
    int stok;    // atirbut stok

public:
    BarangElektronik()
    {
        id = 0;
        nama = "";
        harga = 0;
        stok = 0;
    }

    BarangElektronik(int id, const string &nama, int harga, int stok)
    {
        this->id = id;
        this->nama = nama;
        this->harga = harga;
        this->stok = stok;
    }

    void setId(int id)
    {
        this->id = id;
    }
    int getId()
    {
        return id;
    }

    void setNama(string nama)
    {
        this->nama = nama;
    }
    string getNama()
    {
        return nama;
    }

    void setHarga(int harga)
    {
        this->harga = harga;
    }
    int getHarga()
    {
        return harga;
    }

    void setStok(int stok)
    {
        this->stok = stok;
    }
    int getStok()
    {
        return stok;
    }
};

// array barang global sederhana
BarangElektronik daftar[100];
int jumlahBarang = 0;

// fungsi bantu cari index
int cariIndexById(int id)
{
    for (int i = 0; i < jumlahBarang; i++)
    {
        if (daftar[i].getId() == id)
        {
            return i;
        }
    }
    return -1;
}

void tambahData()
{
    int id, stok;
    int harga;
    string nama;

    cout << "Masukkan ID: ";
    cin >> id;
    // cek ID sudah ada atau belum
    if (cariIndexById(id) != -1)
    {
        cout << "ID sudah digunakan, silakan masukkan ID lain.\n";
        return;
    }

    cin.ignore();
    cout << "Masukkan Nama: ";
    getline(cin, nama);
    cout << "Masukkan Harga: ";
    cin >> harga;
    cout << "Masukkan Stok: ";
    cin >> stok;

    daftar[jumlahBarang] = BarangElektronik(id, nama, harga, stok);
    jumlahBarang++;
    cout << "Data berhasil ditambahkan!\n";
    cout << "\n";
}

void tampilkanData()
{
    cout << "\n=== Daftar Barang Elektronik ===\n";
    for (int i = 0; i < jumlahBarang; i++)
    {
        cout << "ID: " << daftar[i].getId()
             << ", Nama: " << daftar[i].getNama()
             << ", Harga: " << daftar[i].getHarga()
             << ", Stok: " << daftar[i].getStok() << endl;
    }
    cout << endl;
}

void updateData()
{
    int id;
    cout << "Masukkan ID yang ingin diupdate: ";
    cin >> id;
    int idx = cariIndexById(id);
    if (idx != -1)
    {
        string namaBaru;
        int hargaBaru;
        int stokBaru;
        cin.ignore();
        cout << "Masukkan Nama baru: ";
        getline(cin, namaBaru);
        cout << "Masukkan Harga baru: ";
        cin >> hargaBaru;
        cout << "Masukkan Stok baru: ";
        cin >> stokBaru;

        daftar[idx].setNama(namaBaru);
        daftar[idx].setHarga(hargaBaru);
        daftar[idx].setStok(stokBaru);
        cout << "Data berhasil diupdate!\n";
        cout << "\n";
    }
    else
    {
        cout << "Barang dengan ID tersebut tidak ditemukan.\n";
    }
}

void hapusData()
{
    int id;
    cout << "Masukkan ID yang ingin dihapus: ";
    cin >> id;
    int idx = cariIndexById(id);
    if (idx != -1)
    {
        for (int i = idx; i < jumlahBarang - 1; i++)
        {
            daftar[i] = daftar[i + 1];
        }
        jumlahBarang--;
        cout << "Data berhasil dihapus.\n";
        cout << "\n";
    }
    else
    {
        cout << "Barang dengan ID tersebut tidak ditemukan.\n";
    }
}

void cariData()
{
    int id;
    cout << "Masukkan ID yang ingin dicari: ";
    cin >> id;
    int idx = cariIndexById(id);
    if (idx != -1)
    {
        cout << "Ditemukan: ID " << daftar[idx].getId()
             << ", Nama: " << daftar[idx].getNama()
             << ", Harga: " << daftar[idx].getHarga()
             << ", Stok: " << daftar[idx].getStok() << endl;
        cout << "\n";
    }
    else
    {
        cout << "Barang tidak ditemukan.\n";
    }
}
