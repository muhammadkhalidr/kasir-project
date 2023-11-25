@include('laporan.partials.header')
@include('partials.sidebar')


<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Data Laporan</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid mt-3">
        @yield('content')
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->

@include('laporan.partials.footer')
{{-- jQuery --}}
<script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });

    // Fetch records
    function fetch(start_date, end_date) {
        $.ajax({
            url: "{{ route('laporan/gaji/records') }}",
            type: "GET",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(data) {
                // Datatables
                var i = 1;
                $('#lgaji').DataTable({
                    "data": data.gajise,
                    // buttons
                    "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "buttons": [
                        'excel', 'pdf'
                    ],
                    // responsive
                    "responsive": true,
                    "columns": [{
                            "data": "id_gaji"
                        },
                        {
                            "data": "nama_karyawan"
                        },
                        {
                            "data": "persen_gaji"
                        },
                        {
                            "data": "jumlah_gaji"
                        },
                        {
                            "data": "created_at",
                            "render": function(data, type, row, meta) {
                                return moment(row.created_at).format('DD-MM-YYYY');
                            }
                        }
                    ]
                });
            }
        });
    }

    fetch();

    // Filter
    $(document).on("click", "#filter", function(e) {
        e.preventDefault();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        if (start_date == "" || end_date == "") {
            alert("Cari dulu tanggal nysssa");
        } else {
            $('#lgaji').DataTable().destroy();
            fetch(start_date, end_date);
        }
    });

    // Reset
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        $("#start_date").val(''); // empty value
        $("#end_date").val('');
        $('#lgaji').DataTable().destroy();
        fetch();
    });
</script>

</body>

</html>
