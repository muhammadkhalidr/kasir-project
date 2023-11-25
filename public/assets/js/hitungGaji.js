            // var inputJumlahKerja = document.getElementById('txtjumlahkerja');
            // var inputPersenGaji = document.getElementById('txtpersen');
            // var inputJumlahGaji = document.getElementById('txtgaji');
            // inputJumlahKerja.addEventListener('input', hitungGaji);
            // inputPersenGaji.addEventListener('input', hitungGaji);
            // function hitungGaji() {
            //     var jumlahKerja = parseFloat(inputJumlahKerja.value);
            //     var persenGaji = parseFloat(inputPersenGaji.value);
            //     var gajiTotal = (jumlahKerja * 10000) * (persenGaji / 100);
            //     inputJumlahGaji.value = gajiTotal;
            // }

            var hargaJumlahKerja = 10000; // Inisialisasi harga kerja dengan nilai default
            var inputJumlahKerja = document.getElementById('txtjumlahkerja');
            var inputPersenGaji = document.getElementById('txtpersen');
            var inputJumlahGaji = document.getElementById('txtgaji');
            var inputHargaKerja = document.getElementById('hargaKerja');
            var updateButton = document.getElementById('updateButton');
        
            // Mengisi nilai awal input harga kerja dengan hargaJumlahKerja default
            inputHargaKerja.value = hargaJumlahKerja;
        
            // Event listener untuk menghitung gaji saat input berubah
            inputJumlahKerja.addEventListener('input', hitungGaji);
            inputPersenGaji.addEventListener('input', hitungGaji);
        
            // Event listener untuk mengubah hargaJumlahKerja saat tombol "Update Harga Jumlah Kerja" diklik
            updateButton.addEventListener('click', function() {
                // Ambil nilai yang diinputkan oleh admin
                var newHargaKerja = parseFloat(inputHargaKerja.value);
        
                // Validasi input harga kerja (misalnya, pastikan nilainya positif)
                if (newHargaKerja > 0) {
                    hargaJumlahKerja = newHargaKerja;
        
                    // Perbarui harga kerja di sini jika diperlukan
                    // Misalnya: hargaJumlahKerja = newHargaKerja;
        
                    // Tutup modal
                    $('#settingHargaKerja').modal('hide');
                } else {
                    alert('Jangan 0 Dong!');
                }
            });
        
            function hitungGaji() {
                var jumlahKerja = parseFloat(inputJumlahKerja.value);
                var persenGaji = parseFloat(inputPersenGaji.value);
                var gajiTotal = (jumlahKerja * hargaJumlahKerja) * (persenGaji / 100);
                inputJumlahGaji.value = gajiTotal;
            }