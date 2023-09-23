@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tiêu đề</th>
            <th>Link</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($sliders as $key => $slide)
            <tr>
                <td>{{ $slide->id }}</td>
                <td>{{ $slide->name }}</td>
                <td>{{ $slide->url }}</td>
                <td><a href="{{ $slide->file }}" target="_blank"><img src="{{ $slide->file }}" height="40px" alt=""></a></td>
                {{-- <td>{{ $slide->price_sale }}</td> --}}
                <td>{!! \App\Helpers\Helper::active($slide->active) !!}</td>
                <td>{{ $slide->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slide->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $slide->id }}, '/admin/sliders/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $sliders->links() !!}
    </div>
@endsection

