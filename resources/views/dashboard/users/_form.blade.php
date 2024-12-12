<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <div>
            <x-form.input name="phone" class="border border-dark " type="text" label="رقم الجوال" :value="$user->phone" autocomplete="" />
        </div>

        <!-- name -->
        <div class="mt-4">
            <x-form.input name="name" :value="$user->name" class="border border-dark" type="text" label="الاسم" />
        </div>

        <!-- email -->
        <div class="mt-4">
            <x-form.input name="email" :value="$user->email" class="border border-dark" type="text" label="البريد الالكتروني" />
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
            <button class="btn text-white mb-4" style="background-color:#009FBF;width:150px" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>