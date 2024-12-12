<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
        <link  rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{asset('css/css.css')}}">
        <link rel="icon" href="{{asset('image/logo.png')}}" >
        <title>وفرنا للبضائع المخفضة</title>
        <!-- Styles -->
        <style>
            .product-box {
                position: relative;
                overflow: hidden;
                border: 1px solid #ddd;
                border-radius: 8px;
                margin-bottom: 20px;
                transition: transform 0.3s ease-in-out;
                
            }
            .product-box img {
                width: 100%;
                height: auto;
                display: block;
                transition: opacity 0.3s ease-in-out;
            }
            .product-box:hover img {
                opacity: 0.5; /* Reduce opacity of image on hover */
            }
            .product-info {
                padding: 15px;
                background-color: red;
                color: white;
                text-align: center;
                border-radius: 0 0 8px 8px;
                transition: transform 0.3s ease-in-out;
                transform: translateY(100%);
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .product-box:hover .product-info {
                transform: translateY(0);
            }
            .product-info .btn-view-product {
                background-color: red;
                color: white;
                border: 2px solid red;
                border-radius: 4px;
                padding: 10px 20px;
                text-decoration: none;
                display: inline-block;
                margin-top: 10px;
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            .product-info .btn-view-product:hover {
                background-color: white;
                color: red;
            }
            .fixed-button-container {
                position: fixed;
                right: 20px;
                bottom: 20px;
                text-align: center;
                z-index: 1000;
            }
            .box {
                width: 100%; /* عرض الصندوق بشكل مرن */
                height: 250px; /* ارتفاع الصندوق */
                background-size: cover; /* تغطية كاملة للصندوق */
                background-position: center; /* وضع الصورة في المركز */
                background-repeat: no-repeat; /* عدم تكرار الصورة */
                border: 2px solid #000; /* إطار للصندوق (اختياري) */
                background-image: url({{asset('image/logo.png')}}); /* مسار الصورة */

            }
    
            /* استجابة الوسائط */
            @media (max-width: 768px) {
                .box {
                    height: 300px; /* تقليل ارتفاع الصندوق على الشاشات الصغيرة */
                }
            }
    
            @media (max-width: 576px) {
                .product-info {
                    font-size: 14px; /* تصغير حجم الخط في المعلومات على الشاشات الصغيرة */
                    padding: 10px; /* تقليل الحشو في المعلومات على الشاشات الصغيرة */
                }
                .product-info .btn-view-product {
                    padding: 8px 16px; /* تقليل الحشو في الزر على الشاشات الصغيرة */
                    font-size: 12px; /* تصغير حجم الخط في الزر على الشاشات الصغيرة */
                }
            }
        </style>

    </head>

    <body>

        <nav class="navbar navbar-expand-lg bg-body-tertiary rtl">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="{{asset('image/logo.png')}}" alt="logo" class="nav_img"></a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <button type="button" class="btn btn-danger button1"> <a href="{{route('login')}}" class="custom-link">تسجيل الدخول </a></button>
                    </li>
                    <li class="nav-item">
                    <button type="button" class="btn btn-danger button2"><a href="{{route('register')}}" class="custom-link">انشاء حساب </a></button>
                    </li>

                </ul>
                </div>
            </div>
        </nav> 

        <!-- سكشن 1 -->
        <div class="div_1">
            <div class="container container-custom ">
            <div class="row align-items-center ">
            
                
                <!-- عنوان وفقرات على اليمين -->
                <div class="col-md-6 title-section">
                    <h1  class="h1_sc">  {{$introduction->name}}   </h1>
                    <p class="p1_sc"> {{$introduction->description}} </p>
                </div>
                    <!-- صورة على اليسار -->
                <div class="col-md-6">
                    <div class="image-section">
                        <img src="{{asset($introduction->image)}}" alt="صورة">
                    </div>
                </div>
                        
            </div>
        </div>


        </div>

        <!-- sc -->
        <div class="container mt-5">
            <div class="row">
                <h2 class="title_sec2" >خدماتنا!</h2>

                @foreach ($categories as $category)

                <div class="col-md-4">
                    <div class="product-box box">
                    
                        <div class="product-info">
                            <h4> {{$category->name}} </h4>
                            <p> {{$category->discription}} </p>
                            <a href="{{route('product.show',$category->id)}}" class="btn btn-view-product">عرض المنتج</a>                            
                        </div>
                    </div>
                </div>

                @endforeach
                
            </div>


        </div>

        <!-- sc2 -->
        <div class="container container-custom">
            <div class="row align-items-center">
                <h2 class="title_sec2" >كيف يمكنني خدمتك  !</h2>
                <!-- عنوان ونصوص على اليمين -->
                <div class="col-md-6 title-section">
                    
                    <h2>{{$platform_detail->name}}  </h2>
                    <p class="psc2"> {{$platform_detail->description}} </p>
                </div>
                <!-- صورة على اليسار -->
                <div class="col-md-6 image-section ">
                    <img src="{{asset($platform_detail->image)}}" alt="عن المنصة" class="img-fluid">

                </div>
            </div>
        </div>



        <!-- الفوتر -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <!-- المقطع الأول: صورة خلفية بشكل بيضاوي -->
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <div class="bg-image">
                            <img src="{{asset('image/logo.png')}}" alt="شعار">
                        </div>
                    </div>

                    <!-- المقطع الثاني: روابط -->
                    <div class="col-md-4 text-center">
                        <div class="links">
                            <a href="#link1">الرئيسية</a>
                            <a href="#link2">بروفايل</a>
                            <a href="#link3">اضافة طلب</a>
                            <a href="#link4">الرسائل </a>
                        </div>
                    </div>

                    <!-- المقطع الثالث: نموذج إدخال شكوى -->
                    <div class="col-md-4">
                        <div class="complaint-form">
                            <h4>إدخال شكوى</h4>
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" class="form-control" id="name" placeholder="أدخل اسمك">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" placeholder="أدخل بريدك الإلكتروني">
                                </div>
                                <div class="mb-3">
                                    <label for="complaint" class="form-label">الشكوى</label>
                                    <textarea class="form-control" id="complaint" rows="4" placeholder="أدخل الشكوى هنا"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">إرسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3">
            <p>&copy; 2024 وفرنا للبضائع المخفضة. جميع الحقوق محفوظة.</p>
        </footer> 

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
