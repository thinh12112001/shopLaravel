@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên tin tức</th>
            <th>Ảnh mô tả</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($blogs as $key => $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->name }}</td>
                <td>
                    <img src="{{ $blog->file }}" style="height: 50px;" alt="Ảnh bài viết">
                </td>

                <td>{!! \App\Helpers\Helper::active($blog->active) !!}</td>
                <td>{{ $blog->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/blog/edit/{{ $blog->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $blog->id }}, '/admin/blog/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {{-- {!! $blogs->links('pagination::bootstrap-4') !!} --}}
    </div>
@endsection

