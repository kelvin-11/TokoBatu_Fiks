<script>
    $(document).ready(function() {
        $('#detail-customer').hide()
        $('#detail-penjual').hide()
        $('#detail-produk').hide()
        $('#detail-jasa').hide()
        $('#detail-category').hide()
        $('#detail-pesanan').hide()

        $('#card1').on('click', function(e) {
            console.log(e.target.id);
            if (e.target.id == "customer") {
                $('#detail-customer').show()
                $('#detail-penjual').hide()
                $('#detail-produk').hide()
                $('#detail-jasa').hide()
                $('#detail-category').hide()
                $('#detail-pesanan').hide()
            } else if (e.target.id == "penjual") {
                $('#detail-customer').hide()
                $('#detail-penjual').show()
                $('#detail-produk').hide()
                $('#detail-jasa').hide()
                $('#detail-category').hide()
                $('#detail-pesanan').hide()
            } else if (e.target.id == "produk") {
                $('#detail-customer').hide()
                $('#detail-penjual').hide()
                $('#detail-produk').show()
                $('#detail-jasa').hide()
                $('#detail-category').hide()
                $('#detail-pesanan').hide()
            } else if (e.target.id == "jasa") {
                $('#detail-customer').hide()
                $('#detail-penjual').hide()
                $('#detail-produk').hide()
                $('#detail-jasa').show()
                $('#detail-category').hide()
                $('#detail-pesanan').hide()
            }
        })

        $('#card2').on('click', function(e) {
            console.log(e.target.id);
            if (e.target.id == "category") {
                $('#detail-customer').hide()
                $('#detail-penjual').hide()
                $('#detail-produk').hide()
                $('#detail-jasa').hide()
                $('#detail-category').show()
                $('#detail-pesanan').hide()
            } else if (e.target.id == "pesanan") {
                $('#detail-customer').hide()
                $('#detail-penjual').hide()
                $('#detail-produk').hide()
                $('#detail-jasa').hide()
                $('#detail-category').hide()
                $('#detail-pesanan').show()
            }
        })
    })
</script>