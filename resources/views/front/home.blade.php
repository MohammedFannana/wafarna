<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> وفرنا </title>
        <link rel="icon" href="{{asset('image/logo.png')}}" >

        <!-- رابط CSS لBootstrap -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
        <link rel="stylesheet" href="{{asset('css/home.css')}}">

        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    </head>

    <body>

        <!-- ناف بار -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid ">
                <a class="navbar-brand" href="#"><img src="{{asset('image/logo.png')}}" alt="logo"></a>
                <div class="div_nav1">

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse div_nav " id="navbarSupportedContent">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="بحث" aria-label="search">
                            <button class="btn btn-outline-danger" type="submit">بحث</button>
                        </form>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text_ui ">
                        
                            <li class="nav-item ui_li ">
                                <a class="nav-link " href="{{route('notification')}}">رسائل  
                                    @if($unreadCount)
                                        <sup class="bg-danger text-white p-1 rounded">{{$unreadCount}}</sup>
                                    @endif
                                </a>
                            </li>

                            <li class="nav-item dropdown ui_li">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                الطلبات
                                </a>
                                <ul class="dropdown-menu ui_li">
                                <li><a class="dropdown-item" href="{{route('waitingProduct.create')}}">طلب انتظار </a></li>

                                @can('add_producta_available')
                                    <li><a class="dropdown-item" href="{{route('product.create')}}">طلب اضافة سلعة</a></li>
                                @endcan

                                <li><a class="dropdown-item" href="{{route('waitingProduct.index')}}">طلبات الانتظار</a></li>
                                </ul>
                            </li>
                            <li class="nav-item ui_li ">
                                <a class="nav-link " aria-current="page" href="{{route('home')}}">الرئيسية </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('profile.edit')}}">
                                    <img src="{{asset('image/personal.png')}}" alt="صفحة الروفايل" style="height: 60px;">
                                </a>
                                
                            </li>
                
                        </ul>
                
                    </div>

                </div>
            </div>
        </nav>

        <!-- سكشن 1 -->
        <div class="div_1">
            <div class="container container-custom ">
                <div class="row align-items-center ">
            

                    <!-- صورة على اليسار -->
                        <div class="col-md-6">
                            <div class="image-section">
                                <img src="{{asset($introduction->image)}}" alt="صورة">
                            </div>
                        </div>
                    <!-- عنوان وفقرات على اليمين -->
                    <div class="col-md-6 title-section">
                        <h1  class="h1_sc">  {{$introduction->name}}   </h1>
                        <p class="p1_sc">
                            {{$introduction->description}}
                        </p>
                    </div>
                            
                </div>
            </div>

        </div>

        <!-- سكشن 2 -->

        <div class="container mt-5">
            <div class="row">

                @foreach ($categories as $category)

                <div class="col-md-4">
                    <div class="product-box box" style="background-image: url('{{  $category->image_category_url }}');">
                    
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

        <!-- سكشن 3 -->
        <section class="container my-5 section-3">

            <div class="image">
                <img src="{{asset($platform_detail->image)}}" alt="عن المنصة">
            </div>
            <div class="text text-right">
                <h2 class="text_h2">عن المنصة</h2>
                <h3 class="text_h3"> {{$platform_detail->name}} </h3>
                <p>
                    {{$platform_detail->description}}
                </p>
            </div>
        
        </section>

        <!-- الفوتر -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                <!-- المقطع الثالث: نموذج إدخال شكوى -->
                    <div class="col-md-4">
                        <div class="complaint-form">
                            <h4>إدخال شكوى</h4>

                            <form method="post" action="{{route('complaint.mail')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="أدخل اسمك" >
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="أدخل بريدك الإلكتروني">
                                </div>

                                <div class="mb-3">
                                    <label for="complaint" class="form-label">الشكوى</label>
                                    <textarea class="form-control" name="complaint" id="complaint" rows="4" placeholder="أدخل الشكوى هنا"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">إرسال</button>

                            </form>
                        </div>
                    </div>

                    <!-- المقطع الثاني: روابط -->
                    <div class="col-md-4 text-center">
                        <div class="links">
                            <a href="{{route('home')}}">الرئيسية</a>
                            <a href="{{route('profile.edit')}}">الصفحة الشخصي</a>
                            <a href="#link3">اضافة طلب</a>
                            <a href="{{route('notification')}}">الرسائل </a>
                        </div>
                    </div>
                        <!-- المقطع الأول: صورة خلفية بشكل بيضاوي -->
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div class="bg-image">
                                <img src="{{asset('image/logo.png')}}" alt="logo">
                            </div>
                        </div>
                </div>
            </div>
        </footer>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3">
            <p>&copy; 2024 وفرنا للبضائع المخفضة. جميع الحقوق محفوظة.</p>
        </footer> 

        <!-- رابط JavaScript لBootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- رابط JavaScript لBootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        
    </body>
    
</html>
