<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المنتجات </li>
    <li class="breadcrumb-item active"> تسجيل منتج جديد </li>
    @endsection

    <x-alert type="error" name="error" />

    <form action="{{route('dashboard.product.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.products._form' , [
        'button' => ' حفظ '])

    </form>



</x-dashboard-layout>

