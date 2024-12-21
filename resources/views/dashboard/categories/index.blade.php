<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> الأقسام المتوفرة </li>

    @endsection

    <!-- Main content -->
    <div class="mb-3" style="margin-right: 8px;">
        <a href="{{route('dashboard.category.create')}}" class="btn btn-outline-primary" style="width: 150px"> انشاء قسم</a>
    </div>


    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />


    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th>اسم القسم</th>
                <th> الوصف </th>
                <th>الصورة</th>

                <th colspan="2">التحكم</th>
            </thead>

            <tbody>
                @forelse($categories as $category)

                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->discription}}</td>
                    <td> 
                        <img src="{{  $category->image_category_url }}" alt="" width="50" height="50">
                    </td>

                    <td>
                        <a href="{{route('dashboard.category.edit',$category->id)}}">
                            <i class="fas fa-pen text-success fs-4"></i>
                        </a>
                    </td>

                    <td>

                        <form action="{{route('dashboard.category.destroy',$category->id)}}" method="post">
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
                    <td colspan="8"> لا يوجد أقسام متوفرة. </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    <!-- /.content -->

    {{$categories->withQueryString()->links()}}
</x-dashboard-layout>