@extends('admin.layout.admin_dashboard')
@section('admin_content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.category.create') }}" type="button" class="btn btn-primary">Kategori Ekle</a>

                </div>
            </div> --}}
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">DataTable Example</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sıra</th>
                                <th>Eğitmen Adı</th>
                                <th>Kullanıcı Adı</th>
                                <th>Eğitmen Mail</th>
                                <th>Eğitmen Telefon</th>
                                <th>Durum</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructors as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ !empty($item->image) ? asset($item->image) : asset('admin/no_image.jpg') }}" width="80px">
                                    </td>

                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>

                                        <form action="{{ route('admin.instructor.update', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $item->status == 1 ? 0 : 1 }}">
                                            @if($item->status == 1)
                                            <button class="btn btn-success" type="submit">Aktif</button>
                                            @else
                                            <button class="btn btn-danger" type="submit">Pasif</button>
                                            @endif
                                        </form>
                                    </td>

                                </tr>
                            @endforeach



                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
