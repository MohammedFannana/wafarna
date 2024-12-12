<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> الطلبات المنتظرة </li>
    <li class="breadcrumb-item active">تفاصيل الطلبات المنتظرة </li>

    @endsection

    <div class="row" style="margin-top:120px">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-3">{{$product->name}}</h4>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> وصف السلعة المنتظرة </strong>
                        <p> {{$product->description}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> القسم </strong>
                        <p> {{$product->category->name}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> صاحب الطلب </strong>
                        <p> {{$product->user->name}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> حالة الطلب </strong>
                        <p> {{$product->status}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> فترة الانتظار بالايام </strong>
                        <p> {{$product->day_count}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> تاريخ اضافة الطلب </strong>
                        <p> {{$product->created_at}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 160px;"> تاريخ انتهاء الطلب </strong>
                        <p> {{$product->end_date}} :</p>
                    </div>



                </div>


            </div>
        </div>
    </div>

    <!-- /.content -->

</x-dashboard-layout>