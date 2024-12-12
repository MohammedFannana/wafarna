<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <div>
            <x-form.input name="name" class="border border-dark " type="text" label=" اسم القسم  " :value="$category->name" autocomplete="" />
        </div>



        <!-- descripton -->
        <div class="mt-4">
            <x-form.textarea name="discription" :value="$category->discription" class="border border-dark"  label=" الوصف" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF;width:150px" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>