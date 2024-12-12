<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المنتجات </li>

    @endsection


    <!-- Main content -->
    <div class="m-2 row flex-row-reverse justify-content-between">


        <!-- Example single danger button -->
        <div class="col-md-6">
            <form action="{{route('dashboard.product.index')}}" method="get" class="mb-3 d-flex" dir="rtl" style="gap: 5px;">
                <input type="search" name="search" placeholder="ابحث" class="form-control" autocomplete="NULL">
                <button type="submit" class="me-2 btn btn-primary ps-4 pe-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="col-md-2">
            <a href="{{route('dashboard.product.create')}}" class="btn btn-outline-primary" style="width: 100%;"> انشاء منتج</a>
        </div>

    </div>



    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />

    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th>الاسم</th>
                <th>الوصف</th>
                <th>القسم</th>
                <th>مالك المنتج</th>
                <th>السعر</th>
                <th colspan="3">التحكم</th>
            </thead>

            <tbody>
                @forelse($products as $product)

                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->user->name}}</td>
                    <td>{{$product->price}}</td>


                    <td>
                        <a href="{{route('dashboard.product.show',$product->id)}}" title="عرض المزيد">
                            <i class="fas fa-info-circle text-success fs-4"></i>
                        </a>
                    </td>

                    <td>
                        <a href="{{route('dashboard.product.edit',$product->id)}}">
                            <i class="fas fa-pen text-success fs-4"></i>
                        </a>
                    </td>

                    <td>

                        <form action="{{route('dashboard.product.destroy',$product->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" style="border: none; background-color: transparent;">
                                <i class="fas fa-trash-alt fs-4 text-danger"></i>
                            </button>
                        </form>

                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="8"> لا يوجد منتجات. </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>




    <!-- /.content -->

    {{$products->withQueryString()->links()}}

</x-dashboard-layout>