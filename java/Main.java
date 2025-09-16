public class Main {
    public static void main(String[] args) {
        int pilihan;
        do {
            System.out.println("=== MENU TOKO ELEKTRONIK ===");
            System.out.println("1. Tambah Data");
            System.out.println("2. Tampilkan Data");
            System.out.println("3. Update Data");
            System.out.println("4. Hapus Data");
            System.out.println("5. Cari Data");
            System.out.println("0. Keluar");
            System.out.print("Pilih menu: ");
            pilihan = BarangElektronik.sc.nextInt();

            switch (pilihan) {
                case 1:
                    BarangElektronik.tambahData();
                    break;
                case 2:
                    BarangElektronik.tampilkanData();
                    break;
                case 3:
                    BarangElektronik.updateData();
                    break;
                case 4:
                    BarangElektronik.hapusData();
                    break;
                case 5:
                    BarangElektronik.cariData();
                    break;
                case 0:
                    System.out.println("Program selesai.");
                    break;
                default:
                    System.out.println("Pilihan tidak valid.");
            }
        } while (pilihan != 0);
    }
}
