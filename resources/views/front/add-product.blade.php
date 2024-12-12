<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
    <!-- إضافة رابط إلى ملف CSS الخاص بـ Bootstrap -->
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
       <link  rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
       <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
       <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
       <link rel="stylesheet" href="{{asset('css/add-product.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >
    <div class="container mt-5">
        <h2 class="h2-1">إضافة منشور جديد</h2>

        <x-alert type="success" name="success" />


        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <!-- حقل اسم السلعة -->
            <div class="form-group">
                <label for="productName">اسم السلعة</label>
                <input type="text" name="name" :value="old('name')"  @class(['form-control', 'is-invalid'=> $errors->has('name')]) id="productName" placeholder="ادخل اسم السلعة">
                <x-error name="name" class="mt-2" />
            </div>

            <!-- حقل نوع السلعة -->

            <div class="form-group">

                <label for="productType"> الأقسام  </label>
                <select style="padding-right: 30px"  id="productType" @class(['form-control', 'form-select','is-invalid'=> $errors->has('category_id')])  name="category_id"   dir="rtl">

                    <option value="">غير محدد</option>

                    @foreach($categories as $category)
                    <option value="{{$category->id}}"> {{$category->name}} </option>
                    @endforeach

                </select>

                @error('category_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror

            </div>


            <!-- حقل وصف السلعة -->
            <div class="form-group">
                <label for="productDescription">وصف السلعة</label>
                <textarea name="description" :value="old('description')"  @class(['form-control', 'is-invalid'=> $errors->has('description')]) id="productDescription" rows="4" placeholder="ادخل وصف السلعة" ></textarea>
                <x-error name="description" class="mt-2" />
            </div>

            

            <!-- حقل السعر -->
            <div class="form-group">
                <label for="productPrice">السعر</label>
                <input type="number" name="price" :value="old('price')"  @class(['form-control', 'is-invalid'=> $errors->has('price')]) id="productPrice" placeholder="ادخل سعر السلعة" step="0.01" >
                <x-error name="price" class="mt-2" />
            </div>

            <!-- حقل مكان البيع -->
            <div class="form-group">
                <label for="saleLocation">مكان البيع</label>
                <input type="text" name="place" :value="old('place')" @class(['form-control', 'is-invalid'=> $errors->has('place')]) id="saleLocation" placeholder="ادخل مكان البيع">
                <x-error name="place" class="mt-2" />

            </div>

            <!-- حقل رقم واتساب -->
            <div class="form-group">
                <label for="whatsappNumber">رقم للتواصل عبر واتساب</label>
                <input type="tel" name="phone" :value="old('phone')"  @class(['form-control', 'is-invalid'=> $errors->has('phone')]) id="whatsappNumber" placeholder="ادخل رقم الهاتف مع رمز البلد" >
                <small class="form-text text-muted">سيمكنك هذا الرقم من التواصل عبر واتساب.</small>
                <x-error name="phone" class="mt-2" />

            </div>

            <!-- حقل رفع صورة السلعة -->
            <div class="form-group">
                <label for="productImage">رفع صورة للسلعة</label> <br>
                <input type="file" class="image" name="image"  @class(['form-control-file', 'btn-outline-danger', 'is-invalid'=> $errors->has('image')]) id="productImage" >
                <x-error name="image" class="mt-2" />

            </div>

        
            <!-- زر إرسال المنشور -->
            <button type="submit" class="btn btn-danger mt-3" style="width: 120px">إرسال</button>
        </form>
    </div>

    <!-- إضافة رابط إلى ملف JavaScript الخاص بـ Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/js.js')}}"></script>

</body>
</html>
