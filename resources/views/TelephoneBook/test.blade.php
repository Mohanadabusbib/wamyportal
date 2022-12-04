<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body ">
                {{-- <div class="search-item">
                    <label for="department_id">{{__('lable.department')}}</label>
                    <select class="item" name="department_id" id="department_id">
                        <option>الرجاء إختيار الإدارة</option>
                        @foreach ($departments as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-item">
                    <label for="section_id">{{__('lable.section')}}</label>
                    <select class="item" name="section_id" >
                        
                    </select>
                </div> --}}
                <div class="search-item">
                    <form action="{{ route('search') }}" method="post">
                        @csrf
                        <label for="searchItem">بحث</label>
                        <input class="item" type="text" name="searchItem" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>