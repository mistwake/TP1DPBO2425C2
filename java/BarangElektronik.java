import java.util.Scanner;

public class BarangElektronik {
    private int id;
    private String nama;
    private int harga;
    private int stok;

    public BarangElektronik() {
    }

    public BarangElektronik(int id, String nama, int harga, int stok) {
        this.id = id;
        this.nama = nama;
        this.harga = harga;
        this.stok = stok;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getNama() {
        return nama;
    }

    public void setHarga(int harga) {
        this.harga = harga;
    }

    public int getHarga() {
        return harga;
    }

    public void setStok(int stok) {
        this.stok = stok;
    }

    public int getStok() {
        return stok;
    }

    // CRUD
    public static BarangElektronik[] daftar = new BarangElektronik[100];
    public static int jumlahBarang = 0;
    public static Scanner sc = new Scanner(System.in);

    public static int cariIndexById(int id) {
        for (int i = 0; i < jumlahBarang; i++) {
            if (daftar[i].getId() == id)
                return i;
        }
        return -1;
    }

    public static void tambahData() {
        System.out.print("Masukkan ID: ");
        int id = sc.nextInt();
        sc.nextLine();
        if (cariIndexById(id) != -1) {
            System.out.println("ID sudah digunakan.\n");
            return;
        }
        System.out.print("Masukkan Nama: ");
        String nama = sc.nextLine();
        System.out.print("Masukkan Harga: ");
        int harga = sc.nextInt();
        System.out.print("Masukkan Stok: ");
        int stok = sc.nextInt();

        daftar[jumlahBarang] = new BarangElektronik(id, nama, harga, stok);
        jumlahBarang++;
        System.out.println("Data berhasil ditambahkan!\n");
    }

    public static void tampilkanData() {
        System.out.println("\n=== Daftar Barang Elektronik ===");
        for (int i = 0; i < jumlahBarang; i++) {
            System.out.println("ID: " + daftar[i].getId() +
                    ", Nama: " + daftar[i].getNama() +
                    ", Harga: " + daftar[i].getHarga() +
                    ", Stok: " + daftar[i].getStok());
        }
        System.out.println();
    }

    public static void updateData() {
        System.out.print("Masukkan ID yang ingin diupdate: ");
        int id = sc.nextInt();
        sc.nextLine();
        int idx = cariIndexById(id);
        if (idx != -1) {
            System.out.print("Masukkan Nama baru: ");
            String namaBaru = sc.nextLine();
            System.out.print("Masukkan Harga baru: ");
            int hargaBaru = sc.nextInt();
            System.out.print("Masukkan Stok baru: ");
            int stokBaru = sc.nextInt();
            daftar[idx].setNama(namaBaru);
            daftar[idx].setHarga(hargaBaru);
            daftar[idx].setStok(stokBaru);
            System.out.println("Data berhasil diupdate!\n");
        } else {
            System.out.println("Barang tidak ditemukan.\n");
        }
    }

    public static void hapusData() {
        System.out.print("Masukkan ID yang ingin dihapus: ");
        int id = sc.nextInt();
        int idx = cariIndexById(id);
        if (idx != -1) {
            for (int i = idx; i < jumlahBarang - 1; i++) {
                daftar[i] = daftar[i + 1];
            }
            jumlahBarang--;
            System.out.println("Data berhasil dihapus.\n");
        } else {
            System.out.println("Barang tidak ditemukan.\n");
        }
    }

    public static void cariData() {
        System.out.print("Masukkan ID yang ingin dicari: ");
        int id = sc.nextInt();
        int idx = cariIndexById(id);
        if (idx != -1) {
            System.out.println("Ditemukan: ID " + daftar[idx].getId()
                    + ", Nama: " + daftar[idx].getNama()
                    + ", Harga: " + daftar[idx].getHarga()
                    + ", Stok: " + daftar[idx].getStok() + "\n");
        } else {
            System.out.println("Barang tidak ditemukan.\n");
        }
    }
}
