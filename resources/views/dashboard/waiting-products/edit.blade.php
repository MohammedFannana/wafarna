<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> طلبات الانتظار </li>
    <li class="breadcrumb-item active"> تعديل طلبات الانتظار </li>
    @endsection


    <!-- invoke component alert components -->
    <div class="m-2 ms-3 me-3">
        <x-alert type="success" name="success" />
        <x-alert type="error" name="error" />
    </div>



    <form action="{{route('dashboard.products.update' , $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row" style="justify-content: flex-end;">
            <div class="col-md-6" style="margin-right: 15px;">
        
                <!-- name -->
                <div class="mt-4">
                    <x-form.input name="name" :value="$product->name" class="border border-dark" type="text" label="اسم السلعة" />
                </div>
        
                <!-- descripton -->
                <div class="mt-4">
                    <x-form.textarea name="description" :value="$product->description" class="border border-dark"  label=" وصف السلعة" />
                </div>
        
        
                <!-- categories -->
        
                <div class="row mt-2" style="flex-direction: row-reverse; ">
        
                    <div class="mt-4 col-md-12">
                        <label> الأقسام  </label>
                        <select class="form-select form-control border border-dark" name="category_id" class=" is-invalid => $errors->has('category_id')"  dir="rtl">
        
                            @foreach($categories as $category)
        
                                @if ($button == "حفظ")
                                    <option value="">غير محدد</option>
                                @endif
                            
                                <option value="{{$category->id}}" @selected($product->category_id == $category->id)> {{$category->name}} </option>
                            @endforeach
        
                        </select>
        
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
        
                    </div>
        
                </div>
        
                <!-- users -->
                <div class="row mt-2" style="flex-direction: row-reverse;">
        
                    <div class="mt-4 col-md-12">
                        <label> صاحب الطلب  </label>
                        <select class="form-select form-control border border-dark" name="user_id" class=" is-invalid => $errors->has('user_id')"  dir="rtl">
        
                            @if ($button == "حفظ")
                                <option value="">غير محدد</option>
                            @endif
        
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @selected($product->user_id == $user->id)> {{$user->name}} </option>
                            @endforeach
        
                        </select>
        
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
        
                    </div>
                </div>
        
        
                {{-- wait day --}}
                <div class="mt-4">
                    <x-form.input name="day_count" class="border border-dark " type="number" label="فترة انتظار الطلب" :value="$product->day_count"/>
                </div>
        
            
                <div class="flex items-center gap-4 mt-4">
                    <button class="btn text-white mb-4" style="background-color:#009FBF; width:150px" type="submit"> تعديل </button>
                </div>
            </div>
        </div>

    </form>

 

</x-dashboard-layout>