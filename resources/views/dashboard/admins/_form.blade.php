<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <!-- phone -->
        <div class="mt-4">
            <x-form.input name="phone" value="{{$admin->phone}}" class="border border-dark" type="text" label="الهاتف" />
        </div>

        <!-- name -->
        <div class="mt-4">
            <x-form.input name="name" value="{{$admin->name}}" class="border border-dark" type="text" label="الاسم" />
        </div>

        <!-- email -->
        <div class="mt-4">
            <x-form.input name="email" :value="$admin->email" class="border border-dark" type="text" label="البريد الالكتروني" />
        </div>


        <div class="mt-4">
            <label for=""> نوع الحساب </label>

            <div class="form-check">
                <label  for="merchant">
                    تاجر
                </label>
                <input  type="radio" name="user_type" id="merchant"  value="merchant" @checked($admin->user_type == 'merchant')>
            </div>

            <div class="form-check">
                <label  for="customer">
                    زبون
                </label>
                <input  type="radio" name="user_type" id="customer" value="customer" @checked($admin->user_type == 'customer')>
            </div>
        </div>

        <!-- commercial_register -->
        <div class="mt-4">
            <x-form.input name="commercial_register" value="{{$admin->commercial_register}}" class="border border-dark" type="text" label=" السجل التجاري(اجباري اذا نوع الحساب تاجر)" />
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