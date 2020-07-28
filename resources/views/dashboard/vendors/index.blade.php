@extends('layouts.dashboard.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المتاجر  </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> المتاجر
                                </li>
                                <li class="breadcrumb-item  "><a href="{{route('admin.vendors.create')}}">اضافه متجر جديد</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">المتاجر  </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>



                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th> اللوجو</th>
                                                <th> الاسم</th>

                                                <th> رقم الفون</th>
                                                <th>  القسم الرئيسى</th>
                                                <th>الحاله</th>
                                                <th>العنوان</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @isset($vendors)
                                           @foreach ($vendors as $index => $vendor)
                                              <tr>

                                                  <td>{{ $index+1 }}</td>
                                                  <td><img style="width:50px;height:50px;" src="{{ $vendor->logo}}" alt=""></td>

                                                  <td>{{ $vendor->name}}</td>
                                                  <td>  {{ $vendor->phone}} </td>
                                                  <td>{{ $vendor->category->name}}</td>
                                                  <td>{{ $vendor->getActive()}}</td>
                                                  <td>{{ $vendor->address}}</td>
                                                  <td>
                                                      <a href="{{ route('admin.vendors.edit', $vendor->id)}}"
                                                        class="btn btn-outline-primary btn-sm box-shadow-3 mr-1 mb-1">تعديل</a>

                                                      <a href="{{ route('admin.vendors.destroy', $vendor->id)}}"  class="btn btn-outline-danger btn-sm box-shadow-3 mr-1 mb-1">حذف</a>
                                                      <a href="{{ route('admin.vendors.changeStatus', $vendor->id)}}"class="btn btn-outline-success btn-sm box-shadow-3 mr-1 mb-1">
                                                        @if ($vendor->active == 0)
                                                           <span class="btn btn-primary btn-sm">تفعيل</span>
                                                           @else
                                                           <span class="btn btn-danger btn-sm">الغاء تفعيل</span>

                                                        @endif
                                                    </a>
                                                  </td>
                                                </tr>
                                                  @endforeach

                                           @endisset

                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
