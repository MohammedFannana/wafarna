<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <!-- name -->
        <div class="mt-4">
            <x-form.input name="name" :value="$product->name" class="border border-dark" type="text" label="الاسم" />
        </div>

        <!-- descripton -->
        <div class="mt-4">
            <x-form.textarea name="description" :value="$product->description" class="border border-dark"  label=" الوصف" />
        </div>


        <!-- categories -->

        <div class="row mt-2" style="flex-direction: row-reverse; ">

            <div class="mt-4 col-md-12">
                <label> الأقسام  </label>
                <select class="form-select form-control border border-dark" name="category_id" class=" is-invalid => $errors->has('category_id')"  dir="rtl">

                    @if($button == " حفظ ")
                    <option value="">غير محدد</option>
                    @endif

                    @foreach($categories as $category)
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

        <!-- merchants -->
        <div class="row" style="flex-direction: row-reverse;">

            <div class="mt-4 col-md-12">
                <label> (مالك المنتج ) التاجر </label> 

                <select class="form-select form-control border border-dark" name="user_id" class=" is-invalid => $errors->has('user_id')"  dir="rtl">

                    @if($button == " حفظ ")
                    <option value="">غير محدد</option>
                    @endif

                    @foreach($merchants as $merchant)    
                        <option value="{{$merchant->id}}" @selected($product->user_id == $merchant->id)> {{$merchant->name}} </option>
                    @endforeach

                </select>

                @error('user_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror

            </div>
        </div>


        {{-- price --}}
        <div class="mt-4">
            <x-form.input name="price" class="border border-dark " type="text" label="السعر" :value="$product->price"/>
        </div>

        {{-- place --}}
        <div class="mt-4">
            <x-form.input name="place" class="border border-dark " type="text" label="مكان البيع" :value="$product->place"/>
        </div>

        {{-- phone --}}
        <div class="mt-4">
            <x-form.input name="phone" class="border border-dark " type="text" label=" رقم التواصل " :value="$product->phone"/>
        </div>

        <!-- image -->
        <div class="mt-4">
            <x-form.input name="image" class="border border-dark" type="file" label="الصورة" />
            @if($button == " تعديل ")
                <img src="{{asset('storage/' . $product->image)}}" alt="" width="80px">
            @endif
        </div>


        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF; width:150px" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>