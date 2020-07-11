@extends('layouts.dashboard.app')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.languages')}}"> أللغات </a>
                            </li>
                            <li class="breadcrumb-item active">تعديل
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">

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
                            @include('layouts.dashboard.asside.success')
                            @include('layouts.dashboard.asside.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.languages.update', $lang->id)}}" method="POST"
                                          enctype="multipart/form-data">
                                          @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> تعديل</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم اللغة </label>
                                                        <input type="text" value="{{ $lang->name}}" id="name"
                                                               class="form-control"
                                                               placeholder="تعديل اسم اللغة  "
                                                               name="name">
                                                        @error('name')
                                                        <span class="text-danger">{{ $message}} </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="abbre"> الاختصار </label>
                                                        <input type="text" value="{{ $lang->abbre}}" id="abbre"
                                                               class="form-control"
                                                               placeholder="تعديل اختصار اللغة     "
                                                               name="abbre">
                                                               @error('abbre')
                                                               <span class="text-danger">{{ $message}} </span>
                                                               @enderror
                                                    </div>
                                            </div>


                                            </div>


                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="direction"> الاتجاة </label>
                                                        <select name="direction" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر اتجاه اللغة ">
                                                                <option value="rtl"  @if ($lang->direction == 'rtl') ? selected

                                                                @endif>من اليمين الي اليسار</option>
                                                                <option value="ltr" @if ($lang->direction == 'ltr') ? selected

                                                                    @endif>من اليسار الي اليمين</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('direction')
                                                        <span class="text-danger">{{ $message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox" name="active"  value="1"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               @if ($lang->active == 1)

                                                               @endif
                                                               checked/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">الحالة </label>
                                                               @error('direction')
                                                               <span class="text-danger">{{ $message}} </span>
                                                               @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> الغاء
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تعديل
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>


@endsection
