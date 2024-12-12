<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> التجار</li>
    <li class="breadcrumb-item active">تفاصيل التاجر </li>

    @endsection

    <div class="row" style="margin-top:120px">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-3">{{$merchant->name}}</h4>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> رقم الجوال </strong>
                        <p> {{$merchant->phone}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> البريد الالكتروني </strong>
                        <p> {{$merchant->email}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;">: نوع التجارة  </strong>
                        @foreach ($merchant->categories as $category)
                            <p> , {{$category->name}} </p>
                        @endforeach
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> السجل التجاري </strong>

                        @if($merchant->commercial_register)
                            <p> {{$merchant->commercial_register}} :</p>
                        @else
                            <p> لا معلومات </p>
                        @endif
                    </div>


                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> الوصف</strong>
                        <p>  {{$merchant->discription}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> الموقع الخاص</strong>
                        <p> <a href="{{$merchant->website_link}}"> {{$merchant->website_link}} :</a></p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> حالة الحساب </strong>
                        {{-- <p>نشط</p> --}}
                        <p> {{$merchant->subscriptions->status}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> الحساب صالح حتى </strong>
                        <p> {{$merchant->subscriptions->subscription_end_data }} :</p>
                    </div>

                </div>
                <div class="col-auto d-none d-sm-block" style="background-color: #77777717">
                    @if($merchant->image)
                        <img src="{{$merchant->image}}" alt="" width="200" height="250">
                    @else
                        <img src="{{asset('image/personal.png')}}" alt="" width="200" height="250">
                    @endif
                </div>
            </div>
        </div>
    </div>



    <!-- /.content -->

</x-dashboard-layout>