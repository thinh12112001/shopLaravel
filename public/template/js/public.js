$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore() {
    const page = $('#page').val();

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: {page},
        url: '/services/load-product',
        success : function (result) {
            if (result.html !== '') {
                $('#loadProduct').append(result.html);
                $('#page').val(page + 1);

                // lưu lại thông tin tránh bị mất khi load lại website
                const loadedItems = localStorage.getItem('loadedItems') || [];
                loadedItems.push(result.html);
                localStorage.setItem('loadedItems', JSON.stringify(loadedItems));

                console.log(loadedItems);
            } else {
                alert('Đã load xong Sản Phẩm');
                $('#button-loadMore').css('display', 'none');

            }
        }
    })
}
