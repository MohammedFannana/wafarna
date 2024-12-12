<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

    
        <!-- name -->
        <div class="mt-4">
            <x-form.input name="name" :value="$plan->name" class="border border-dark" type="text" label="الاسم" />
        </div>

        <!-- descripton -->
        <div class="mt-4">
            <x-form.textarea name="description" :value="$plan->description" class="border border-dark"  label=" الوصف" />
        </div>
    
        {{-- price --}}
        <div class="mt-4">
            <x-form.input name="price" class="border border-dark " type="text" label="السعر" :value="$plan->price"/>
        </div>

        {{-- period --}}
        <div class="mt-4">
            <x-form.input name="period" class="border border-dark " type="text" label="فترة الاشتراك بالاشهر" :value="$plan->period"/>
        </div>




        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF;width:150px" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>