<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> التجار </li>

    @endsection


    <!-- Main content -->
    <div class="m-2 row flex-row-reverse justify-content-between">


        <!-- Example single danger button -->
        {{-- <div class="col-md-6">
            <form action="{{route('dashboard.merchants.details')}}" method="get" class="mb-3 d-flex" dir="rtl" style="gap: 5px;">
                <input type="search" name="search" placeholder="ابحث" class="form-control" autocomplete="NULL">
                <button type="submit" class="me-2 btn btn-primary ps-4 pe-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>
        </div> --}}

    </div>



    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />

    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th>الاسم</th>
                <th>رقم الجوال</th>
            </thead>

            <tbody>
                @forelse($product->users as $product)

                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->phone}}</td>

                </tr>
                @empty

                <tr>
                    <td colspan="8"> لا يوجد تجار. </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>




    <!-- /.content -->

    {{-- {{$product->withQueryString()->links()}} --}}

</x-dashboard-layout>