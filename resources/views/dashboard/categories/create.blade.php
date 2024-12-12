<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> الأقسام  </li>
    <li class="breadcrumb-item active"> انشاء قسم </li>
    @endsection

    <form action="{{route('dashboard.category.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.categories._form' , [
        'button' => ' حفظ '])

    </form>



</x-dashboard-layout>