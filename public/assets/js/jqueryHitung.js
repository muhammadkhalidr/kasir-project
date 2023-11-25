$(document).ready(function() {
    // Menangani klik pada tombol tambahform
    $(document).on("click", ".tambahform", function() {
        // Duplikat form-transaksi
        var newForm = $(".form-transaksi:first").clone();

        // Bersihkan nilai input di form baru
        newForm.find("input").val("");

        // Sisipkan form baru setelah form terakhir
        $(".form-transaksi:last").after(newForm);
    });

    $(document).on("input", ".jumlah, .harga, .uangmuka, .sisa", function() {
        // Menghitung total untuk setiap form
        $(".form-transaksi").each(function() {
            var jumlah = parseFloat($(this).find(".jumlah").val()) || 0;
            var harga = parseFloat($(this).find(".harga").val()) || 0;

            var total = jumlah * harga;

            $(this).find(".total").val(total);
        });

        // Menghitung subtotal dari semua total
        var subtotal = 0;
        $(".form-transaksi").each(function() {
            subtotal += parseFloat($(this).find(".total").val()) || 0;
        });

        // Mengambil nilai uang muka
        var uangMuka = parseFloat($(".uangmuka").val()) || 0;

        // Mengurangkan uang muka dari total, bukan dari subtotal
        var totalSetelahUangMuka = subtotal - uangMuka;

        // Mengupdate nilai input subtotal
        $(".subtotal").val(subtotal);

        var sisaPembayaran = parseFloat($(".sisa").val()) || 0;
        $(".sisa").val(totalSetelahUangMuka);
    });

    // Menambahkan event listener untuk input uangmuka
    $(document).on("input", ".uangmuka", function() {
        // Menghitung kembali subtotal saat input uangmuka diubah
        var subtotal = 0;
        $(".form-transaksi").each(function() {
            subtotal += parseFloat($(this).find(".total").val()) || 0;
        });

        // Mengambil nilai uang muka
        var uangMuka = parseFloat($(".uangmuka").val()) || 0;

        // Mengurangkan uang muka dari total
        var totalSetelahUangMuka = uangMuka;

        // Mengupdate nilai input subtotal
        $(".subtotal").val(subtotal);
    });


    // Menangani perubahan nilai saat formulir baru ditambahkan
    $(document).on("input", ".form-transaksi:last .jumlah, .form-transaksi:last .harga", function() {
        var jumlah = parseFloat($(this).closest(".row").find(".jumlah").val()) || 0;
        var harga = parseFloat($(this).closest(".row").find(".harga").val()) || 0;

        var total = jumlah * harga;

        $(this).closest(".row").find(".total").val(total);
    });
});