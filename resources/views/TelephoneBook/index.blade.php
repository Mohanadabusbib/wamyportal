@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">دليل الهاتف</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0 tx-md-16-f">/ تعديل مستخدم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="table-responsive">
                           
                            <table id="example" class="table key-buttons text-md-nowrap" style="font-size: 16px">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">{{__('lable.empId')}}</th>
                                        <th class="border-bottom-0">{{__('lable.name')}}</th>
                                        <th class="border-bottom-0">{{__('lable.email')}}</th>
                                        <th class="border-bottom-0">{{__('lable.mobile')}}</th>
                                        <th class="border-bottom-0">تعديل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{$item->empid}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile ? $item->mobile : 'غير مسجل'}}</td>
                                        <td>
                                            @can('proc-delete-savings')
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-emp_name="{{ $item->name }}" data-id="{{ $item->id }}"
                                                data-empid="{{ $item->empid }}"
                                                data-mobile="{{ $item->mobile }}"
                                                data-target="#delete_file">
                                                    تعديل
                                                </button>
                                            @endcan
                                        </td>
                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- row closed -->
        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل المستخدم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form action="{{route('TB.store')}}" method="POST" onkeydown="return event.key != 'Enter'>
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h4 style="color:red">
                                {{-- هل أنت متاكد من عملية الغاء الإشتراك للموظف ادناه؟ --}}
                                هل تريد تعديل المستخدم ؟
                            </h4>
                            </p>
                            <input type="hidden" name="id" id="id" value="">
                            <label for="emp_name">الموظف</label>
                            <input type="text" name="emp_name" id="emp_name" value="" disabled>
                            <input type="hidden" name="emp_name" id="emp_name" value="">
                            <input type="hidden" name="empid" id="empid" value="">
                            <br>
                            <label for="department_id">{{__('lable.department')}}</label>
                            <select class="form-control" name="department_id" required>
                                <option>الرجاء إختيار الإدارة</option>
                                @foreach ($departments as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="section_id">{{__('lable.section')}}</label>
                            <select class="form-control" name="section_id">
                                {{-- <option>الرجاء إختيار القسم</option> --}}
                            </select>
                            <br>
                            <label for="job">الوظيفة</label>
                            <input type="text" name="job" id="job" value="">
                            <br>
                            <label for="mobile">الجوال</label>
                            <input type="text" name="mobile" id="mobile" value="" required>
                            <br>
                            <label for="extn">التحويلة</label>
                            <input type="text" name="extn" id="extn" value="" required>
                            <br>
                            <input type="text" name="active" id="active" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('js')
<script src="{{asset('public/assets/js/jquery-3.4.1.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/js/popper.min.js')}}"></script>
<script src="{{asset('public/assets/js/main.js')}}"></script>


<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var emp_name = button.data('emp_name')
        var empid = button.data('empid')
        var mobile = button.data('mobile')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #emp_name').val(emp_name);
        modal.find('.modal-body #empid').val(empid);
        modal.find('.modal-body #mobile').val(mobile);
       
    })
</script>
@endsection