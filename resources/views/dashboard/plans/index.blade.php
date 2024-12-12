<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">الاشتراكات</li>

    @endsection


    <!-- Main content -->
    <div class="m-2 row flex-row-reverse justify-content-between">


        <div class="col-md-2">
            <a href="{{route('dashboard.plans.create')}}" class="btn btn-outline-primary" style="width: 100%;"> انشاء اشتراك</a>
        </div>

    </div>



    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />
    <x-alert type="danger" name="danger" />


    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th>الاسم</th>
                <th> الوصف </th>
                <th> السعر </th>
                <th> المدة بالاشهر </th>
                <th colspan="2">التحكم</th>
            </thead>

            <tbody>
                @forelse($plans as $plan)

                    <tr>
                        <td>{{$plan->id}}</td>
                        <td>{{$plan->name}}</td>
                        <td>{{$plan->description}}</td>
                        <td>{{$plan->price}}</td>
                        <td>{{$plan->period}}</td>


                        <td>
                            <a href="{{route('dashboard.plans.edit',$plan->id)}}">
                                <i class="fas fa-pen text-success fs-4"></i>
                            </a>
                        </td>

                        <td>

                            <form action="{{route('dashboard.plans.destroy',$plan->id)}}" method="post">
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
                    <td colspan="8"> لا يوجد اشتراكات. </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>




    <!-- /.content -->



</x-dashboard-layout>