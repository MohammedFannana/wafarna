<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> تعديل معلومات الصفخة الشخصية </li>
    @endsection


    <!-- invoke component alert components -->
    <div class="m-2 ms-3 me-3">
        <x-alert type="success" name="success" />
    </div>



    <form action="{{route('dashboard.home.information.update' , $home_information->id)}} "method="post" enctype="multipart/form-data">
        
        @csrf
        @method('put')

        <div class="row" style="justify-content: flex-end;">
            <div class="col-md-6" style="margin-right: 15px;">
        
                <!-- name -->
                <div class="mt-4">
                    <x-form.input name="name" :value="$home_information->name" class="border border-dark" type="text" label="الاسم" />
                </div>
        
                <!-- descripton -->
                <div class="mt-4">
                    <x-form.textarea name="description" :value="$home_information->description" class="border border-dark"  label=" الوصف " />
                </div>

                <!-- image -->
                <div class="mt-4">
                    <x-form.input name="image" class="border border-dark" type="file" label="الصورة" />
                    <img src="{{ asset($home_information->image) }}" alt="" width="80px">
                </div>

                <div class="flex items-center gap-4 mt-4">
                    <button class="btn text-white mb-4" style="background-color:#009FBF; width:150px" type="submit"> تعديل </button>
                </div>
            </div>
        </div>

    </form>

</x-dashboard-layout>