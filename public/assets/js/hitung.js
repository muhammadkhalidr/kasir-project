function hitungHarga() {
    // Ambil nilai harga barang dan jumlah barang dari input
    var hargaBarang = parseFloat(document.getElementById('txtharga').value);
    var jumlahBarang = parseFloat(document.getElementById('txtjumlah').value);

    // Periksa jika nilai harga barang atau jumlah barang adalah 0
    if (isNaN(hargaBarang) || isNaN(jumlahBarang)) {
        // Jika salah satu nilai adalah NaN, tampilkan 0 pada total harga
        document.getElementById('txttotal').value = 0;
    } else {
        // Hitung total harga
        var totalHarga = hargaBarang * jumlahBarang;

        // Tampilkan total harga di input "txttotal"
        document.getElementById('txttotal').value = totalHarga;
    }

    // Ambil nilai uang muka dari input
    var uangMuka = parseFloat(document.getElementById('txtdp').value);

    // Hitung sisa uang
    var sisaUang = totalHarga - uangMuka;

    // Periksa jika nilai uang muka adalah NaN
    if (isNaN(sisaUang)) {
        // Jika uang muka adalah NaN, tampilkan 0 pada sisa
        document.getElementById('txtsisa').value = 0;
    } else {
        // Tampilkan sisa uang di input "txtsisa"
        document.getElementById('txtsisa').value = sisaUang;
    }
}

// Tambahkan event listener untuk menghitung harga secara otomatis saat nilai input berubah
document.getElementById('txtharga').addEventListener('input', hitungHarga);
document.getElementById('txtjumlah').addEventListener('input', hitungHarga);
document.getElementById('txtdp').addEventListener('input', hitungHarga);


