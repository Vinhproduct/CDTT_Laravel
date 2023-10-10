@extends('layouts.admin')

@section('title', 'Tất cả danh mục sản phẩm')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TẤT CẢ DANH MỤC</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Tất cả danh mục</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
 <div class="row">
  <div class="col-md-6">
    <button class="btn btn-sm btn-danger" type="submit">
      <i class="far fa-calendar-times"> </i>Xóa
    </button>
  </div>
  <div class="col-md-6-text-right">
    <a href="{{route('category.index')}}" class="btn btn-sm btn-info">
      <i class="fas fa-trash"></i> Quay về danh sách
      </a>
  </div>
 </div>
        </div>
        <div class="card-body">
         @includeIf('backend.message_alert')
          <table class="table table-bodered">
            <thead>
              <tr>
                <th style="width:20px" class="text-center">#</th>
                <th>Tên  danh mục</th>
                <th>Slug</th>
                <th style="width:140px" class="text-center">Ngày đăng</th>
                <th style="width:200px" class="text-center">Chức năng</th>
                <th style="width:20px" class="text-center">ID</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($list_category as $category)
                  
              
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td class="text-center">{{$category->create_at}}</td>
                <td class="text-center">
       
                <a href="{{route('category.restore',['category'=>$category->id])}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></a>
                <a href="{{route('category.destroy',['category'=>$category->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></a>
                </td>
                <td class="text-center">{{$category->id}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection