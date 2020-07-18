@extends('layouts.dashboard.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> اللغات
                                </li>
                                <li class="breadcrumb-item  "><a href="{{route('admin.maincategories.create')}}">اضافه قسم جديد</a>
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
                                    <h4 class="card-title">القسام الرئيسيه </h4>
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
                                                <th>صوره القسم</th>
                                                <th> القسم</th>
                                                <th>اللغه</th>
                                                <th>الحاله</th>
                                                
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @isset($categories)
                                           @foreach ($categories as $index => $category)
                                              <tr>

                                                  <td>{{ $index+1 }}</td>
                                                  <td><img style="width:50px;height:50px;" src="{{ $category->image}}" alt=""></td>

                                                  <td>{{ $category->name}}</td>
                                                  <td>{{ get_default_lang()}}</td>
                                                  <td>{{ $category->getActive()}}</td>

                                                  <td>
                                                      <a href="{{ route('admin.maincategories.edit', $category->id)}}"
                                                        class="btn btn-outline-primary btn-sm box-shadow-3 mr-1 mb-1">Edit</a>

                                                      <a href="{{ route('admin.maincategories.destroy', $category->id)}}"  class="btn btn-outline-danger btn-sm box-shadow-3 mr-1 mb-1">Delete</a>
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
