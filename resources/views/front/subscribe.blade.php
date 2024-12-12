<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> الاشتراك</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link  rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('css/subscribe.css')}}">
    <link rel="icon" href="{{asset('image/logo.png')}}" >

</head>

<body>
    <div class="container my-5">

        <x-alert type="danger" name="error"/>


        <div class="row pricing-table">
            @foreach ($plans as $plan)

                <div class="col-md-4">
                    <div class="pricing-card">
                        <h2>{{$plan->name}}</h2>
                        <h3> {{$plan->price}}</h3>
                        <p> {{$plan->description}} </p>
                        
                        <form action="{{route('subscriptions.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <input type="hidden" name="period" value="{{$plan->period}}">

                            <button type="submit" class="btn btn-danger btn-subscribe" data-toggle="modal" data-target="#paymentModal" data-plan="شهري" data-price="100">اشترك الآن</button>
                        </form>
                    </div>
                </div>
                
            @endforeach
                        
        </div>
    </div>



    <!-- رابط مكتبات JavaScript الخاصة بBootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/js.js')}}"></script>
</body>
</html>
