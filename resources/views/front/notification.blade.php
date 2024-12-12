<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاشعارات</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
           <!-- Bootstrap CSS -->
           <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
           <link  rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
           <link rel="stylesheet" href="{{asset('css/bootstrap.min.css.map')}}">
           <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
           <link rel="stylesheet" href="{{asset('css/notification.css')}}">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"> ({{$unreadCount}}) الإشعارات </h1>
                <div class="mt-4">
                

                    @forelse ($notifications as $notification )

                        @if ($notification->type === 'App\Notifications\CreateWaitingProductNotification')

                            <a href="{{$notification->data['link']}}?nid={{$notification->id}}" class="card text-decoration-none notification-card-link">
                                <div class="card-body d-flex flex-row-reverse justify-content-between align-items-center">
                                    <div>
                                        <p class="card-text"> {{$notification->data['body']}} </p>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    تم الإرسال في: <span> {{$notification->created_at}} </span>
                                </div>
                            </a>
            
                        @else
                            <div class="card notification-card">
                                <div class="card-body d-flex flex-row-reverse justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title"> {{$notification->data['title']}} </h5>
                                        <p class="card-text"> {{$notification->data['body']}} </p>
                                    </div>

                                    
                                    <a type="button" class="btn btn-danger" href="{{$notification->data['link']}}?nid={{$notification->id}}"> طلب المنتج </a>
                                    
                                </div>
                                <div class="card-footer text-muted">
                                    تم الإرسال في: <span> {{$notification->created_at}} </span>
                                </div>
                            </div>

                        @endif

                    @empty

                        <p class="bg-danger text-white text-center p-2 fs-4"> لا توجد رسائل لعرضها </p>

                    @endforelse
                    
                    {{$notifications->withQueryString()->links()}}

        
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
