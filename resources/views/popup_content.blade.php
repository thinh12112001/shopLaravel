<!-- Nội dung popup -->
<p>Sản phẩm đã được thêm vào giỏ hàng! Product ID: {{ $product->id }}</p>
<button onclick="stayOnPage()">Xem tiếp</button>
<button onclick="redirectToCart()">Đến thanh toán</button>

<script>
    function stayOnPage() {
        const popup = document.getElementById('popup');
        popup.style.display = 'none';
    }

    function redirectToCart() {
        window.location.href = '/carts';
    }
</script>
