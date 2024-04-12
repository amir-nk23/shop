@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.roles.index') }}">لیست نقش ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت نقش جدید</li>
        </ol>
        <div class="mt-3 mt-lg-0">
        </div>
    </div>
    <!--  Page-header closed -->

    <!-- row opened -->
    <div class="row">
        <div class="col-md">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title">ثبت نقش جدید</h3>
                </div>
                <div class="card-body">

                    @include('core::includes.validation-errors')

                    <form action="{{ route('admin.roles.store') }}" method="post" class="save">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">نام (به انگلیسی) <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="نام را به انگلیسی اینجا وارد کنید" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="label" class="control-label">نام قابل مشاهده (به فارسی) <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control" name="label" id="label" placeholder="نام قابل مشاهده را به فارسی اینجا وارد کنید" value="{{ old('label') }}" required>
                                </div>
                            </div>
                        </div>

                        <h4 class="header p-2">مجوزها</h4>
                        @foreach($permissions->chunk(4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $permission)
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permission->name }}">
                                                <span class="custom-control-label">{{ $permission->label }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    <button class="btn btn-pink" type="submit">ثبت و ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div><!-- col end -->
    </div>
    <!-- row closed -->
@endsection
