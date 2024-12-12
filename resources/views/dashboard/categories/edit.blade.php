<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> الأقسام </li>
    <li class="breadcrumb-item active"> تعديل القسم </li>
    @endsection

    <!-- invoke component alert components -->
    <div class="m-2 ms-3 me-3">
        <x-alert type="success" name="success" />
    </div>

    <form action="{{route('dashboard.category.update' , $category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.categories._form' , [
        'button' => ' تعديل '])

    </form>



</x-dashboard-layout>