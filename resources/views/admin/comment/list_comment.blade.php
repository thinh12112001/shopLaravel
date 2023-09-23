@extends('admin.main')

@section('content')
<style>
    ul.list_rep li {
        list-style-type: decimal;
        color: blue;

    }
</style>
<div id="notify_comment"></div>
<table class="table">
    <thead>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Tên người comment</th>
        <th>Nội dung comment</th>
        <th>Tên sản phẩm</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
        <th style="width: 100px">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
        @foreach($comments as $key => $comment)
            @if ($comment->comment_name != 'Admin')
                <tr >
                    <td>{{ $comment->comment_id }}</td>
                    <td>{{ $comment->comment_name }}</td>
                    <td style="width: 300px">{{ $comment->comment }}
                        <ul class="list_rep">
                            @foreach ($comments as $key => $comment_reply)
                                @if($comment_reply->comment_parent_comment == $comment->comment_id)

                                    <li>{{$comment_reply->comment}}</li>
                                @endif
                            @endforeach
                        </ul>
                    @if ($comment->comment_status == 1)
                            <br/><textarea class="form-control reply_comment_{{$comment->comment_id}}"  rows="5"></textarea>
                            <br/><button class="btn btn-default btn-xs btn-reply-comment" data-comment_id="{{$comment->comment_id}}"
                                data-product_id="{{$comment->comment_product_id}}">Trả lời bình luận</button>
                        </td>
                    @endif

                    <td>
                        <a href="../../san-pham/{{$comment->comment_product_id}}-{{ Str::slug($comment->product->name, '-') }}.html" target="_blank">{{$comment->product->name}}</a>
                    </td>
                        <td>
                            @if ($comment->comment_status == 0)
                                <input type="button" data-comment_status="1" data-comment_id="{{$comment->comment_id}}" id="{{$comment->comment_product_id}}"
                                class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt">
                            @else
                                <input type="button" data-comment_status="0" data-comment_id="{{$comment->comment_id}}" id="{{$comment->comment_product_id}}"
                                    class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ duyệt">
                            @endif
                        </td>
                    {{-- <td></td> --}}
                    <td>{{ $comment->comment_date }}</td>
                    <td>
                        {{-- <a class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $comment->comment_id }}, '/admin/comments/destroy')">
                            <i class="fas fa-trash"></i>
                        </a> --}}
                    </td>
                </tr>
        @endif
        @endforeach
    </tbody>
</table>

<div class="card-footer clearfix">
    {!! $comments->links() !!}
</div>
@endsection
