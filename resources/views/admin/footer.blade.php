
<!-- jQuery -->
<script src=" {{asset ('template/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset ('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset ('template/admin/dist/js/adminlte.min.js') }}"></script>

<script src="{{asset ('template/admin/js/main.js') }}"></script>
{{-- morris chart --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
{{-- date picker --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $(document).ready(function() {
        // chart30daysorder();
        if (window.location.pathname === '/admin/revenue/list') {
            var chart = new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'chart',
                // option
                lineColors:['#819C79', '#fc8710', '#A4ADD3', '#766B56'],
                hideHover: 'auto',
                parseTime: false,
                xkey: 'period',
                ykeys: ['order','sales','profit','quantity'],
                labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
            });
        }


        $('#btn-dashboard-filter').click(function() {
            var _token = $('input[name="_token"]').val();
            var from_date = $("#datepicker").val();
            var to_date = $("#datepicker2").val();

            $.ajax({
                url: '/filterbydate',
                method: "POST",
                dataType: "JSON",
                data: { from_date: from_date, to_date: to_date, _token: _token},

                success:function(data){
                    chart.setData(data);
                }
                // error: function(jqXHR, textStatus, errorThrown) {
                //     console.error("AJAX request failed: " + textStatus, errorThrown);
                // }
            })
        })

        $('.dashboard-filter').change(function() {
            var dashboard_value  = $(this).val();
            var _token  = $('input[name="_token"]').val();
            // alert(dashboard_value);
            // alert(_token);
            $.ajax({
                urL: '/dashboardfilter',
                method: "POST",
                dataType: "JSON",
                data: {dashboard_value: dashboard_value, _token : _token },

                success:function(data) {
                    chart.setData(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus, errorThrown);
                }
            })
        })

        $( function() {
            $('#datepicker').datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
                duration: "slow"
            });

            $('#datepicker2').datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
                duration: "slow"
            });
        } );


    })

    // duyệt comment
    $('.comment_duyet_btn').click(function () {
           var comment_status = $(this).data('comment_status');
           var comment_id = $(this).data('comment_id');
           var comment_product_id = $(this).attr('id');
           if (comment_status == 1) {
               var alerts = "Duyệt thành công";
           } else {
               var alerts = "Bỏ duyệt thành công";
           }

           $.ajax({
               url: '/admin/allow-comment',
               method: "POST",
               data: {comment_status: comment_status,
                           comment_id: comment_id,
                           comment_product_id: comment_product_id
                       },
               headers: {
                   'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
               },


               success:function(data) {
                   location.reload();
                   $('#notify_comment').html('<span class="text text-alert">'+alerts+'</span>');
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.error("AJAX request failed: " + textStatus, errorThrown);
               }
           })
       });

       $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_'+comment_id).val();

            var comment_product_id = $(this).data('product_id');
            // alert(comment);
            var alerts = 'Trả lời bình luận thành công';
           $.ajax({
               url: '/admin/reply-comment',
               method: "POST",
               data: {comment: comment,
                           comment_id: comment_id,
                           comment_product_id: comment_product_id
                       },
               headers: {
                   'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
               },


               success:function(data) {
                $('.reply_comment_'+comment_id).val('');
                   $('#notify_comment').html('<span class="text text-alert" >'+alerts+'</span>');
                   $('#notify_comment').fadeOut(3000);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                   console.error("AJAX request failed: " + textStatus, errorThrown);
               }
           })
       })





    </script>

@yield('footer')
