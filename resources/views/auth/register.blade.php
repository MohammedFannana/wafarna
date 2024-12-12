<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/signup.css')}}">
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
       <link  rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
       <link rel="stylesheet" href={{asset('css/bootstrap.min.css.map')}}>
       <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
       <link rel="stylesheet" href="{{asset('css/sign.css')}}">
    <style>
        .hero-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .container-custom {
            margin-top: 50px;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }

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
            position: absolute;
            background-color: #f9f9f9;
            width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            left: 0px;
            top: 30px
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
</head>
<body>
    <div class="container-fluid p-0">
        <!-- صورة في وسط أعلى الصفحة -->
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{asset('image/signup.png')}}" alt="صورة تعبيرية" class="hero-image">
            </div>
        </div>
    </div>

    <div class="container container-custom div_1">
        <h2 class="text-center mb-4">إنشاء حساب</h2>


        <div class="form-group text_r">
            <label for="account-type"> اختر نوع الحساب</label>

            <select name="user_type"  id="account-type" @class(['form-control' , 'is-invalid'=> $errors->has('user_type')]) >
                <option value="" disabled selected class="text_r">اختر نوع الحساب</option>
                <option value="customer" class="text_r">زبون</option>
                <option value="merchant" class="text_r">تاجر</option>
            </select>

        </div>


        <form id="customer-form" method="POST" action="{{ route('register') }}" style="display: none;">
            @csrf
            <h3>تسجيل الزبون</h3>
        
            <div class="form-group">
                <label for="customer-name">الاسم</label>
                <input type="text" name="name" :value="old('name')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('name')]) id="customer-name" placeholder="الاسم">
                <x-error name="name" class="mt-2" />
            </div>

            <input type="hidden" name="user_type" value="customer">
        
            <div class="form-group">
                <label for="customer-email">البريد الالكتروني</label>
                <input type="email" name="email" :value="old('email')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('email')]) id="customer-email" placeholder="البريد الالكتروني">
                <x-error name="email" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="customer-phone">رقم الهاتف</label>
                <input type="text" name="phone" :value="old('phone')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('phone')]) id="customer-phone" placeholder="رقم الجوال">
                <x-error name="phone" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="customer-password">كلمة السر</label>
                <input name="password" type="password" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('password')]) id="customer-password" placeholder="كلمة السر" autocomplete="new-password">
                <x-error name="password" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="customer-confirm-password">تأكيد كلمة السر</label>
                <input type="password" name="password_confirmation" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('password_confirmation')]) id="customer-confirm-password" placeholder="تأكيد كلمة السر" autocomplete="new-password">
                <x-error name="password_confirmation" class="mt-2" />
            </div>
        
            <button type="submit" class="btn btn-danger btn-block">إنشاء حساب </button>
        </form>
        
        <form id="merchant-form" method="POST" action="{{ route('register') }}" style="display: none;">
            @csrf
            <h3>تسجيل التاجر</h3>
        
            <div class="form-group">
                <label for="merchant-name">الاسم</label>
                <input type="text" name="name" :value="old('name')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('name')]) id="merchant-name" placeholder="الاسم">
                <x-error name="name" class="mt-2" />
            </div>

            <input type="hidden" name="user_type" value="merchant">

        
            <div class="form-group">
                <label for="merchant-email">البريد الالكتروني</label>
                <input type="email" name="email" :value="old('email')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('email')]) id="merchant-email" placeholder="البريد الالكتروني">
                <x-error name="email" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="merchant-phone">رقم السجل التجاري</label>
                <input type="text" name="commercial_register" :value="old('commercial_register')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('commercial_register')]) id="merchant-phone" placeholder="رقم السجل التجاري">
                <x-error name="commercial_register" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="merchant-job">نشاط التاجر</label>
                <div class="custom-select w-100 rounded d-flex" style="flex-direction: row-reverse; padding: .375rem .75rem; border: 1px solid #ced4da;">
                    <div class="select-box d-flex flex-row-reverse justify-content-between" id="selectBox">
                        اختيار القسم
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <path fill="black" d="m12 13.171l4.95-4.95l1.414 1.415L12 16L5.636 9.636L7.05 8.222z" />
                        </svg>
                    </div>
                    <div class="dropdown-content" id="dropdown">
                        @foreach($categories as $category)
                        <label class="d-flex" style="gap: 10px">
                            <input type="checkbox" name="categories_id[]" value="{{$category->id}}" @class(['checkbox', 'is-invalid'=> $errors->has('categories_id[]')]) data-category-name="{{$category->name}}">
                            {{$category->name}}
                        </label>
                        @endforeach
                    </div>
                    @error('categories_id[]')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        
            <div class="form-group">
                <label for="merchant-phone">رقم الهاتف</label>
                <input type="text" name="phone" :value="old('phone')" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('phone')]) id="merchant-phone" placeholder="رقم الجوال">
                <x-error name="phone" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="merchant-password">كلمة السر</label>
                <input name="password" type="password" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('password')]) id="merchant-password" placeholder="كلمة السر" autocomplete="new-password">
                <x-error name="password" class="mt-2" />
            </div>
        
            <div class="form-group">
                <label for="merchant-confirm-password">تأكيد كلمة السر</label>
                <input type="password" name="password_confirmation" @class(['form-control', 'text_r', 'is-invalid'=> $errors->has('password_confirmation')]) id="merchant-confirm-password" placeholder="تأكيد كلمة السر" autocomplete="new-password">
                <x-error name="password_confirmation" class="mt-2" />
            </div>
        
            <button type="submit" class="btn btn-danger btn-block">إنشاء حساب</button>
        </form>
        
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        const accountType = document.getElementById('account-type');
        const customerForm = document.getElementById('customer-form');
        const merchantForm = document.getElementById('merchant-form');
    
        accountType.addEventListener('change', function() {
            const value = this.value;
    
            if (value === 'customer') {
                customerForm.style.display = 'block';
                merchantForm.style.display = 'none';
            } else if (value === 'merchant') {
                merchantForm.style.display = 'block';
                customerForm.style.display = 'none';
            } else {
                customerForm.style.display = 'none';
                merchantForm.style.display = 'none';
            }
        });
    </script>

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

            resultDiv.innerHTML = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'لم يتم اختيار قسم';
        }

        // Close dropdown only when clicking outside of both select-box and dropdown-content
        window.onclick = function(event) {
            if (!event.target.closest('.select-box') && !event.target.closest('.dropdown-content')) {
                document.querySelector('.custom-select').classList.remove('active');
            }
        };

    </script>

</body>
</html>
