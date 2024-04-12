@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.cities.index') }}">لیست شهرها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت شهر جدید</li>
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
                    <h3 class="card-title">ثبت شهر جدید</h3>
                </div>
                <div class="card-body">

                    @include('components.errors')

                    <form action="{{ route('admin.cities.store') }}" method="post" class="save">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">نام شهر <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="نام شهر را اینجا وارد کنید" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="province_id" class="control-label">استان</label>
                                    <span class="text-danger">&starf;</span>
                                    <select class="form-control" name="province_id" id="province_id" required>
                                        <option class="text-muted">-- استان مورد نظر را انتخاب کنید --</option>
                                        @foreach($provinces as $id => $province)
                                            <option value="{{ $id }}" @if($id == old('province_id')) selected @endif>{{ $province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p class="control-label">وضعیت <span class="text-danger">&starf;</span></p>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="status" value="{{ old('status', 1) }}" @if(old('status', 1)) checked @endif>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                </div>
                            </div>
                        </div>

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
