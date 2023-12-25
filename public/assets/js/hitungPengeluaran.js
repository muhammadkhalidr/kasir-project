    // Fungsi untuk menghitung total
    function hitungTotal() {
        var jumlahInput = document.getElementById('jumlah');
        var totalInput = document.getElementById('total');

        // Konversi nilai jumlahInput menjadi angka (pastikan input hanya berisi angka)
        var jumlah = parseFloat(jumlahInput.value) || 0;

        // Hitung total (misalnya, jika Anda ingin menggandakan jumlah)
        var total = jumlah;

        // Isi nilai total ke dalam input 'txttotal'
        totalInput.value = total;
    }

    // Panggil fungsi hitungTotal saat nilai 'txtjumlah' berubah
    document.getElementById('jumlah').addEventListener('input', hitungTotal);

    // Panggil fungsi hitungTotal saat halaman dimuat (jika nilai awal 'txtjumlah' sudah ada)
    window.addEventListener('load', hitungTotal);