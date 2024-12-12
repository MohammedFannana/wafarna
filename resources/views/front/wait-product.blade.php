<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقديم طلب انتظار منتج</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
          <link  rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
          <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
          <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
          <link rel="stylesheet" href="{{asset('css/wait-product.css')}}">
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">تقديم طلب انتظار سلعة</h3>
                </div>

                <div class="card-body">
                    <!-- invoke component alert components -->
                    <x-alert type="success" name="success" />

                    <form action="{{route('waitingProduct.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="itemType" class="form-label">نوع السلعة</label>
                            <select id="itemType"  @class(['form-select','is-invalid'=> $errors->has('category_id')])  name="category_id">
                                <option value="" disabled selected>اختر نوع السلعة</option>

                                @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach

                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror


                        </div>

                        <div class="mb-3">
                            <label for="itemDescription" class="form-label">وصف السلعة</label>
                            <textarea id="itemDescription" name="description" @class(['form-control','is-invalid'=> $errors->has('description')])  rows="3"></textarea>
                            <x-error name="description" class="mt-2" />
                        </div>

                        <div class="form-group" style="text-align:right ;">
                            <label for="productName">اسم السلعة</label>
                            <input type="text" name="name" @class(['form-control','is-invalid'=> $errors->has('description')]) id="productName" placeholder="ادخل اسم السلعة"  style="text-align:right ;"> 
                            <x-error name="name" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="waitTime" class="form-label">فترة الانتظار بالايام</label>
                            <input type="number" name="day_count" id="waitTime" @class(['form-control','is-invalid'=> $errors->has('day_count')]) min="0" >
                            <x-error name="day_count" class="mt-2" />
                        </div>
                    

                        <button type="submit" class="btn btn-danger">إرسال الطلب</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
