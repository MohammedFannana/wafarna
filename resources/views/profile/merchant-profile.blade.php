<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <!-- Bootstrap CSS -->
           <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
           <link  rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
           <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
           <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
           <link rel="stylesheet" href="{{asset('css/profile.css')}}">
        
    <title>الصفحة الشخصية</title>
    <!-- إضافة Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- إضافة CSS مخصص -->
    <style>
        body{
            margin-top: 20px;
        }
     </style>

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
    {{-- <header class="header-h1 text-white text-center py-3 mb-4">
        <h1 class="">المعلومات الشخصية</h1>
    </header>  --}}

    <div class="container">
        <div class="profile-card">
    
            <div class="profile-info" style="position: relative">
                <h2 class="profile-h1">البيانات الشخصية</h2>

                <x-alert type="success" name="success"/>


                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form class="form-profile" method="post" action="{{ route('profile.update' , $user->id) }}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')

                    <div class="profile-header">
                        <img id="profileImage" src="{{$user->image_url}}" alt="صورة شخصية">
                    </div>

                    <div class="profile-image">
                        <input type="file" name="image" id="" class="image_input" style="width: 200px">
                    </div>

                    <div class="form-group">
                        <label for="fullName">الاسم</label>
                        <input type="text" id="name" name="name" @class(['form-control', 'is-invalid'=> $errors->has('name')])  value="{{old('name', $user->name)}}" >
                        <x-error name="name" class="mt-2" />
                    </div> 

                    <div class="form-group">
                        <label for="contactNumber">رقم الهاتف</label>
                        <input type="text" id="contactNumber" name="phone" @class(['form-control', 'is-invalid'=> $errors->has('phone')])  value="{{old('phone', $user->phone)}}">
                        <x-error name="phone" class="mt-2" />

                    </div>
                    
                    <div class="form-group">
                        <label for="contactNumber">بريد الكتروني</label>
                        <input type="email"  id="contactNumber" name="email" @class(['form-control', 'is-invalid'=> $errors->has('email')])  value="{{old('email', $user->email)}}">
                        <x-error name="email" class="mt-2" />
                    </div>

                    <input type="hidden" name="user_type" value="merchant">

                    <div class="form-group">
                        <label for="fullName">رقم السجل التجاري</label>
                        <input type="text" id="fullName" name="commercial_register" @class(['form-control', 'is-invalid'=> $errors->has('commercial_register')])  value="{{old('commercial_register', $user->commercial_register)}}">
                        <x-error name="commercial_register" class="mt-2" />
                    </div>

                    <!-- categories -->
                    <div class="form-group mb-3">

                        <label> الأقسام المتوفرة </label>

                        <div class="custom-select w-100 rounded d-flex" style="flex-direction: row-reverse;padding: .375rem .75rem; border: 1px solid #ced4da;">
                            <div class="select-box d-flex flex-row-reverse justify-content-between" id="selectBox">
                                @foreach ($categoryMerchantIds as $merchant_name => $merchant_id  )
                                    {{ $merchant_name }}
                                @endforeach
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="black" d="m12 13.171l4.95-4.95l1.414 1.415L12 16L5.636 9.636L7.05 8.222z"/></svg>
                            </div>
                            <div class="dropdown-content" id="dropdown">
                                @foreach($categories as $category)
                                    <label class="d-flex" style="gap: 10px"><input type="checkbox" @checked(in_array($category->id, $categoryMerchantIds)) name="categories_id[]" value="{{$category->id}}" @class(['checkbox', 'is-invalid'=> $errors->has('categories_id[]')])   data-category-name="{{$category->name}}"> {{$category->name}}</label>
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
                        <label for="bio">وصف التاجر</label>
                        <textarea @class(['form-control', 'is-invalid'=> $errors->has('discription')]) name="discription" id="bio" rows="3" > {{old('discription', $user->discription)}}</textarea>
                        <x-error name="discription" class="mt-2" />
                    </div>
                
                    
                    <div class="form-group">
                        <label for="website">موقع خاص</label>
                        <input name="website_link" type="url" @class(['form-control', 'is-invalid'=> $errors->has('website_link')]) id="website" value="{{old('website_link', $user->website_link)}}">
                        <x-error name="website_link" class="mt-2" />

                    </div>

                
                    <div class="row  mb-3">
                        <div class="col">
                            <button type="submit" class="btn btn-danger w-100 mt-2">حفظ</button>
                        </div>
                    </div>
                </form>

                {{-- style="position: absolute;bottom:0;right: 145px;" --}}
                <div class="row gx-2 gy-2 justify-content-between">
                    <!-- Change Password Button -->
                    <div class="col-12 col-sm-auto">
                        <button type="button" class="btn btn-danger w-100">
                            <a href="{{ route('password.edit') }}" class="nav-link text-white">تغيير كلمة المرور</a>
                        </button>
                    </div>
            
                    <!-- Logout Button -->
                    <div class="col-12 col-sm-auto">
                        <form action="{{ route('logout') }}" method="post" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">تسجيل الخروج</button>
                        </form>
                    </div>
            
                    <!-- Subscribe Button -->
                    <div class="col-12 col-sm-auto">
                        <button type="button" class="btn btn-danger w-100">
                            <a href="{{route('plan')}}" class="nav-link text-white">اشتراك بالموقع</a>
                        </button>
                    </div>
                </div>
                

            </div>
        </div>
    </div>

    <!-- إضافة Bootstrap و JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/js.js')}}"></script>
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
</body>
</html>
