

<div class="row isotope-grid">
    {{-- <form>
        @csrf --}}

        @foreach ($blogs as $key => $blog)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">

                    <a href="/blog/detail/{{ $blog->id }}-{{ Str::slug($blog->name, '-') }}.html"><img src="{{$blog->file}}" class="img img-responsive img-thumbnail" alt="IMG-blog"></a>
                    {{-- <input type="button" data-toggle="modal" data-target="#xemnhanh" value="Quick View" class="btn btn-default xemnhanh"
                    data-id_blog="{{$blog->id}}" name="add-to-cart"> --}}
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="/blog/detail/{{ $blog->id }}-{{ Str::slug($blog->name, '-') }}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{$blog->name}}
                        </a>
                    </div>


                </div>
            </div>
        </div>
        @endforeach

    {{-- </form> --}}

{{--
<script>
// Lưu trạng thái
    localStorage.setItem('scrollPosition', window.scrollY);

    // Khôi phục trạng thái sau khi tải lại trang
    window.onload = function() {
        const scrollPosition = localStorage.getItem('scrollPosition');

        if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
            localStorage.removeItem('scrollPosition');
        }
    };

    function addToCart() {
        var form = document.getElementById('addToCartForm');
        var formData = new FormData(form);

        $.ajax({
            url: '/add-cart-main-page', // Đường dẫn đến controller để xử lý dữ liệu
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Xử lý kết quả từ controller (nếu cần)
                // console.log(loadedItems);
                location.reload();
                // console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script> --}}

