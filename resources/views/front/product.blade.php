<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link  rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
   

    <title>عرض المنتجات</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/exhibition.css')}}">

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

        <div class="container mt-5">
            <div class="row" dir="rtl">

                @forelse($products as $product)

                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="{{$product->cover_image_url}}" class="card-img-top product-img" alt="اسم السلعة">
                            <div class="card-body">
                                <div class="info-container">
                                    <div class="info-text">
                                        <h5 class="card-title">اسم السلعة : {{$product->name}} </h5>
                                        <p class="card-text"> {{$product->price}} :سعر السلعة </p>
                                        <p class="card-text"> {{$product->user->name}} :اسم التاجر </p>
                                        <p class="card-text">عنوان البيع:  {{$product->place}} </p>
                                    </div>
                                </div>
                                <a href="https://wa.me/1234567890" class="btn btn-danger" target="_blank">تواصل عبر WhatsApp</a>
                            </div>
                        </div>
                    </div>

                @empty

                    <div class="container text-danger text-center fs-3" style="margin: 200px 0px">
                        عذرًا، لا توجد منتجات متوفرة للعرض في الوقت الحالي. نعمل على تحديث قائمتنا لتقديم المزيد من الخيارات قريبًا. نشكركم على تفهمكم.
                    </div>

                @endforelse
                
            </div>
        </div>

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
    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
