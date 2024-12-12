<x-dashboard-layout title="لوحة التحكم">

    @push('styles')
    <style>
        /* Basic styling */
        .custom-select {
            position: relative;
            display: inline-block;
            cursor: pointer;
            background: #fff;
            padding: 5px;
            border: 1px solid black;
        }
    
    
        .dropdown-content {
            display: none;
            position: relative;
            background-color: #f9f9f9;
            width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
    
        .dropdown-content label {
            display: block;
            padding: 8px;
            cursor: pointer;
        }
    
        .dropdown-content label:hover {
            background-color: #f1f1f1;
        }
    
        .custom-select.active .dropdown-content {
            display: block;
        }
    
        .result {
            margin-top: 20px;
        }
    </style>
    @endpush

    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> التجار </li>
    <li class="breadcrumb-item active"> تعديل  بيانات التاجر </li>
    @endsection

    <form action="{{route('dashboard.merchant.update' , $merchant->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row" style="justify-content: flex-end;">
            <div class="col-md-6" style="margin-right: 15px;">

                <!-- Phone -->
                <div>
                    <x-form.input name="phone" class="border border-dark " type="text" label="رقم الجوال" :value="$merchant->phone" autocomplete="" />
                </div>

                <!-- name -->
                <div class="mt-4">
                    <x-form.input name="name" :value="$merchant->name" class="border border-dark" type="text" label="الاسم" />
                </div>

                <!-- email -->
                <div class="mt-4">
                    <x-form.input name="email" :value="$merchant->email" class="border border-dark" type="text" label="البريد الالكتروني" />
                </div>

                <!-- descripton -->
                <div class="mt-4">
                    <x-form.textarea name="discription" :value="$merchant->discription" class="border border-dark"  label=" الوصف" />
                </div>


                <!-- categories -->
                <div class="row" style="flex-direction: row-reverse;">

                    <div class="mt-4 col-md-12">
                        <label> الأقسام المتوفرة </label>

                        <div class="custom-select">
                            <div class="select-box d-flex flex-row-reverse justify-content-between" id="selectBox">
                                @foreach ($categoryMerchantIds as $merchant_name => $merchant_id  )
                                    {{ $merchant_name }}
                                @endforeach
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="black" d="m12 13.171l4.95-4.95l1.414 1.415L12 16L5.636 9.636L7.05 8.222z"/></svg>
                            </div>
                            <div class="dropdown-content" id="dropdown">
                                @foreach($categories as $category)
                                    <label class="d-flex" style="gap: 10px"><input type="checkbox" @checked(in_array($category->id, $categoryMerchantIds)) name="categories_id[]" value="{{$category->id}}" class="checkbox" data-category-name="{{$category->name}}"> {{$category->name}}</label>
                                @endforeach
                            </div>
                            @error('categories_id[]')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
                

                <!-- commercial register -->
                <div class="mt-4">
                    <x-form.input name="commercial_register" class="border border-dark" type="text" label="السجل التجاري" :value="$merchant->commercial_register" />
                </div>

                <div class="mt-4">
                    <x-form.input name="subscription_end_data" class="border border-dark" type="date" label=" صلاحية الحساب حتى " :value="$merchant->subscriptions->subscription_end_data " />
                </div>


                <div class="flex items-center gap-4 mt-4">
                    <button class="btn text-white mb-4" style="background-color:#009FBF; width:150px" type="submit"> تعديل </button>
                </div>
            </div>
            
        </div>


    </form>

    @push('scripts')
    <script>
       // Toggle dropdown visibility
        document.getElementById('selectBox').addEventListener('click', function() {
            document.querySelector('.custom-select').classList.toggle('active');
        });

        // Display data based on checkbox selections
        const checkboxes = document.querySelectorAll('.checkbox');
        const resultDiv = document.getElementById('selectBox');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateResult();
            });
        });

        function updateResult() {
            const selectedOptions = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedOptions.push(checkbox.getAttribute('data-category-name'));
                }
            });

            resultDiv.innerHTML = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'لم يتم اختيار تاجر';
        }

        // Close dropdown only when clicking outside of both select-box and dropdown-content
        window.onclick = function(event) {
            if (!event.target.closest('.select-box') && !event.target.closest('.dropdown-content')) {
                document.querySelector('.custom-select').classList.remove('active');
            }
        };

    </script>
    @endpush 

</x-dashboard-layout>

