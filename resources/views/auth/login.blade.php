<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{asset('css/sign.css')}}">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <img src="{{asset('image/signin.png')}}" alt="تسجيل الدخول" class="login-image">
            <h2 class="text-center mb-4">تسجيل الدخول</h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="customer-phone">رقم الهاتف</label>
                    <input type="text" name="phone" :value="old('phone')" @class(['form-control', 'text_r' , 'is-invalid'=> $errors->has('phone')]) id="customer-phone" placeholder="رقم الجوال" >
                    <x-error name="phone" class="mt-2" />
                </div>

                <div class="form-group">
                    <label for="customer-password">كلمة السر</label>
                    <input name="password" type="password" @class(['form-control', 'text_r' , 'is-invalid'=> $errors->has('password')]) id="customer-password" placeholder="كلمة السر"  autocomplete="new-password">
                    <x-error name="password" class="mt-2" />

                </div>

                <!-- Remember Me -->
                <div class="block mt-1 mb-3">
                    <label for="remember_me" class="inline-flex  items-center">
                        <span class="ms-2 text-sm text-gray-600"> تذكرني </span>
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    </label>
                </div>

                <a href="حط مسار الرئيسية " class="aa"> <button type="submit" class="btn btn-danger btn-block">تسجيل الدخول</button>   </a>

                <div class="text-center mt-3">
                    
                    @if (Route::has('password.request'))

                        <a href="{{ route('password.request') }}" class="d-block">هل نسيت كلمة السر؟</a>

                    @endif

                    <a href="{{route('register')}}" class="d-block">إنشاء حساب</a>
                </div>

            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
