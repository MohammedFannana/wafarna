<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المنتج </li>
    <li class="breadcrumb-item active">تفاصيل المنتج </li>

    @endsection

    <div class="row" style="margin-top:120px">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-3">{{$product->name}}</h4>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> وصف المنتج </strong>
                        <p> {{$product->description}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> القسم </strong>
                        <p> {{$product->category->name}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> السعر </strong>
                        <p> {{$product->price}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> مكان البيع </strong>
                        <p> {{$product->place}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> مالك المنتج </strong>
                        <p> {{$product->user->name}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> رقم الهاتف </strong>
                        <p> {{$product->phone}} :</p>
                    </div>



                </div>

                <div class="col-auto d-none d-sm-block" style="background-color: #77777717">

                    <img src="{{asset('storage/' . $product->image)}}" alt="" width="200" height="250">

                </div>

            </div>
        </div>
    </div>

    <!-- /.content -->

</x-dashboard-layout>