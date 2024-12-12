<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلبات الانتظار</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
           <!-- Bootstrap CSS -->
           <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
           <link  rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
           <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
           <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
           <link rel="stylesheet" href="{{asset('css/waiting-order.css')}}">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    
    body {
        padding-top: 20px;
    }
    .notification-card {
        margin-bottom: 15px;
    }

.card-title{
    text-align: right;
    color: #E4121F;
    font-family: Arial, Helvetica;
    font-size: xx-large;

}
.card-text{
    text-align: right;
}
.text-center{
    font-family: Arial, Helvetica;
    color: #E4121F;
    font-size: 40px;
}
  </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">طلبات الانتظار</h1>
                <div class="mt-4">

                    <x-alert type="success" name="success" />

                    @forelse ($waiting_products as $waiting_product )
                        
                        <div class="card notification-card">
                            <div class="card-body">
                                <h5 class="card-title">{{$waiting_product->name}}</h5>
                                <p class="card-text"> {{$waiting_product->description}} </p>
                                <div class="d-flex justify-content-between align-items-end flex-row-reverse">
                                    <div>

                                        <div class="d-flex align-items-center justify-content-end">
                                            <span style="color:red ; font-size:x-large;" > {{$waiting_product->day_count}} </span>
                                            <span class="fs-6">: مدة الانتظار بالايام</span>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <span style="color:red ;"> {{$waiting_product->end_date}} </span>
                                            <span class="fs-6">: تاريخ نهاية المدة</span>
                                        </div>

                                    </div>


                                    @can('waiting_product_available' , [$waiting_product] )

                                        <form action="{{route('waitingProduct.update', $waiting_product->id)}}" method="post">
                                            @csrf
                                            @method('put')
                                            
                                            <input type="hidden" name="status" value="complete">
                                            <button type="submit" class="btn btn-danger"> تم توفير المنتج </button>
                                        </form>

                                    @endif

                                </div>
                            </div>
                        </div>

                    @empty
                        <p class="text-center fs-4 bg-danger text-white p-2"> لا يوجد منتجات على قائمة الانتظار </p>
                    @endforelse

                
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript, jQuery, and Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
