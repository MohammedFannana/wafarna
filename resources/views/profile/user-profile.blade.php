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
    </head>

    <body >
        <!-- <header class="header-h1 text-white text-center py-3 mb-4">
            <h1 class="">المعلومات الشخصية</h1>
        </header> -->

        <div class="container">
            <div class="profile-card">
                
                <div class="profile-info">
                    <h2 class="profile-h1">البيانات الشخصية</h2>

                    <x-alert type="success" name="success"/>


                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form class="form-profile" method="post" action="{{ route('profile.update' , $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="profile-header">
                            <img id="profileImage" src="{{$user->image_url}}" alt="صورة شخصية">
                        </div>

                        <div class="profile-image">
                            <input type="file" name="image" id="" class="image_input">
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

                        <input type="hidden" name="user_type" value="customer">


                        <div class="form-group">
                            <label for="contactNumber">بريد الكتروني</label>
                            <input type="email"  id="contactNumber" name="email" @class(['form-control', 'is-invalid'=> $errors->has('email')])  value="{{old('email', $user->email)}}">
                            <x-error name="email" class="mt-2" />
                        </div>

                        <div class="row  mb-3">
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100 mt-2">حفظ</button>
                            </div>
                        </div>

                    </form>


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
                                <a href="{{route('profile.convert')}}" class="nav-link text-white"> التسجيل كتاجر</a>
                            </button>
                        </div>
                    </div>
                    


                </div>
            </div>
        </div>

        <!-- إضافة Bootstrap و JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('js/js.js')}}"></script>
    </body>
</html>
