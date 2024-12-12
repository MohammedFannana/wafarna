<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغيير كلمة المرور</title>
    <link rel="stylesheet" href={{asset('css/all.min.css')}}>
       <link  rel="stylesheet" href={{asset('css/bootstrap.min.css')}}>
       <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
       <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
       <link rel="stylesheet" href="{{asset('css/password.css')}}">
 
    <!-- إضافة Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- إضافة Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <!-- إضافة CSS مخصص -->
   
</head>
<body>
    <div class="change-password-container">
        <div class="change-password-card">
            <img src="{{asset('image/password.png')}}" alt="صورة داخل الصندوق">
            <h2 class="text-center">تغيير كلمة المرور</h2>

            <x-alert type="success" name="success"/>


            <form method="post"  id="changePasswordForm" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="oldPassword">كلمة المرور الحالية</label>
                    <input type="password" name="current_password" class="form-control" id="oldPassword"  autocomplete="current-password">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                </div>

                <div class="form-group">
                    <label for="newPassword">كلمة المرور الجديدة</label>
                    <input type="password" name="password" class="form-control" id="newPassword" >
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="form-group">
                    <label for="confirmPassword">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirmPassword">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                </div>

                <button type="submit" class="btn btn-custom w-100 text-white">حفظ كلمة المرور</button>

            </form>
        </div>
    </div>

    <!-- إضافة Bootstrap و JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
