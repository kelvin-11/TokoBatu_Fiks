<!-- Mengatur jumlah minimum dan maksimum yang dapat di beli -->
<script>
    // $(document).ready(function() {
    //     $('.tambah').click(function(e) {
    //         e.preventDefault();
    //         var qty = $(this).closest('.data_produk').find('.qty').val();
    //         var value = parseInt(qty);
    //         value = isNaN(value) ? 0 : value;
    //         if (value < 1000) {
    //             value++;
    //             $(this).closest('.data_produk').find('.qty').val(value);
    //         }
    //     });

    //     $('.kurang').click(function(e) {
    //         e.preventDefault();
    //         var qty = $(this).closest('.data_produk').find('.qty').val();
    //         var value = parseInt(qty);
    //         value = isNaN(value) ? 0 : value;
    //         if (value > 1) {
    //             value--;
    //             $(this).closest('.data_produk').find('.qty').val(value);
    //         }
    //     });
    // });
</script>

<!-- Memgupdate jumlah dan harga total yang ada di keranjang -->
<script>
    function changeValue(id, qty) {
        let harga = $('#hargasatuan-' + id).val();
        let total = harga * qty;
        $('.total-' + id).text(total);

        $.ajax({
            url: "updatekeranjang?total=" + total + "&qty=" + qty + "&id=" + id,
            type: "GET",
            success: function(response) {
                if (response) {
                    $('.pesanan').text(response);
                } else {
                    alert('load-again');
                }
            },
            error: function(error) {
                alert("Error");
                return false;
            },
            cache: false,
            contentType: false,
            processData: false,
        });
        return false;
    }

    function increase(id) {
        let qty = parseInt($('#qty-' + id).val()) + 1;
        $('#qty-' + id).val(qty);
        changeValue(id, qty);
    }

    function decrease(id) {
        let qty = parseInt($('#qty-' + id).val()) - 1;

        if (qty < 1) {
            alert("Jumlah tidak dapat kurang dari 1, Silahkan hapus produk");
            return false;
        }
        $('#qty-' + id).val(qty);
        changeValue(id, qty);
    }
</script>

<!-- Alert stok habis -->
<script>
    $(document).ready(function() {
        $('.add').on('keyup click', function() {
            if ($('.stok').val() == 0) {
                alert('Stok Produk Habis!');
                return false;
            }
        })
    })
</script>

<!-- Ajax API Rajaongkir -->
<script>
    $(document).ready(function() {
        //memilih provinsi
        $.ajax({
            type: 'POST',
            url: 'provinsi',
            success: function(hasil_provinsi) {
                // $("select[name=provinsi]").html(hasil_provinsi);
                $('#provinsi').append(hasil_provinsi);
            }
        })

        //menampilkan kota berdasarkan provinsi yang dipilih
        $("#provinsi").on('change', function() {
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

            $.ajax({
                type: 'POST',
                url: 'distrik',
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(hasil_distrik) {
                    $("#distrik").append(hasil_distrik)
                }
            })
        })

        //Menampilkan jasa kirim setelah memeilih kota asal
        $('#jasacard').hide()
        $('#hr').show()
        $('#distrik').on('change', function(e) {
            console.log(e.target.id);
            if (e.target.id == "distrik") {
                $('#jasacard').show()
                $('#hr').hide()
            }
        })

        //menampilkan data paket setelah memilih jasa kirim
        $('#jasa').on('change', function() {
            //mendapatkan jasa yang dipili
            var jasa_terpilih = $('option:selected', '#jasa').attr("slug")
            //mendapatkan id_kota/kabupaten yang dipilih
            var distrik_terpilih = $('option:selected', '#distrik').attr("id_distrik")
            //mendapatkan total_berat dari inputan
            var total_berat = $('#berat').val()

            $.ajax({
                type: 'POST',
                url: 'paket',
                data: 'jasa=' + jasa_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
                success: function(hasil_paket) {
                    $('#paket').append(hasil_paket)
                }
            })
        })

        //Saat memilih paket dari jasa kirim menampilkan harga ongir dan dijumlahkan dengan total pesanan serta menyimpan data ke database
        $('#kirim').hide()
        $("#paket").on('change', function(e) {
            console.log(e.target.id);
            if (e.target.id == "paket") {
                $('#kirim').show()
            }
            var paket_terpilih = $("option:selected", this).attr("isi_paket")
            var biaya_ongkir = $("option:selected", this).attr("ongkir")
            var perkiraan_waktu = $("option:selected", this).attr("etd")
            var ttl = parseInt($('#ttl').val())

            $.ajax({
                type: 'POST',
                url: 'update',
                data: 'isi_paket=' + paket_terpilih + '&ongkir=' + biaya_ongkir + '&estimasi=' + perkiraan_waktu,
                success: function(response) {
                    $('#biaya_ongkir').text(response)
                    var ttl_akhir = ttl + parseInt(response)
                    $('#total_biaya').text(ttl_akhir)
                }
            })
        })

        //jika memilih kota/kabupaten memasukkan data ke inputan
        $('#distrik').on('change', function() {
            var provinsi_terpilih = $("option:selected", this).attr("nama_provinsi")
            var distrik_terpilih = $("option:selected", this).attr("nama_distrik")
            var type_terpilih = $("option:selected", this).attr("type_distrik")
            var codepos_terpilih = $("option:selected", this).attr("codepos")

            $("input[name=provinsi]").val(provinsi_terpilih)
            $("input[name=distrik]").val(distrik_terpilih)
            $("input[name=type]").val(type_terpilih)
            $("input[name=codepos]").val(codepos_terpilih)
        })
    })
</script>

<!-- Search Data Menggunakan controller-->
<script>
    //search produk menggunakan keyup/ langsung keluar hasil
    $(document).ready(function() {
        $('#search').keyup(function() {
            $.ajax({
                type: 'POST',
                url: 'search',
                data: {
                    q: $(this).val()
                },
                success: function(hasil) {
                    if (hasil.data != "") {
                        $('#template').html(hasil.data)
                    } else {
                        $('#template').html("Produk Yang Anda Cari Tidak Tersedia")
                    }
                    if (hasil.index != "") {
                        $('#index').html(hasil.index)
                    } else {
                        $('#index').html("Produk Yang Anda Cari Tidak Tersedia")
                    }
                }
            })
        })
    })
</script>

<!-- Search Data Memalui data di html -->
<!-- <script>
    $(document).ready(function() {
        $('#search').keyup(function() {
            search_table($(this).val());

            function search_table(value) {
                $('.item').each(function() {
                    var found = 'false';
                    $(this).each(function() {
                        if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                            found = 'true';
                        }
                    })
                    if (found == 'true') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                })
            }
        })
    })
</script> -->