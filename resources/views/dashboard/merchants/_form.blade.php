<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

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


        @if($button == " حفظ ")

        <!-- Password -->
        <div class="mt-4">
            <x-form.input name="password" class="border border-dark" type="password" label="كلمة المرور" autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.input name="password_confirmation" class="border border-dark" type="password" label=" تأكيد كلمة المرور  " autocomplete="new-password" />
        </div>

        @endif


        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF; width:150px" type="submit"> {{$button}} </button>
        </div>
    </div>
    
</div>

{{-- @push('scripts') --}}
        
    {{-- @endpush --}}