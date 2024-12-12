<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">  </li>

    @endsection




    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />

    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th> الاسم </th>
                <th> الوصف </th>
                <th> الصورة </th>
                <th style="width:120px">  </th>
                <th colspan="3">التحكم</th>
            </thead>

            <tbody>
                @foreach ($home_informations as $home_information)
        
                <tr>
                    <td>{{$home_information->id}}</td>
                    <td>{{$home_information->name}}</td>
                    <td>{{$home_information->description}}</td>
                    <td> 
                        <img src="{{asset($home_information->image)}}" alt="" width="80px">
                    </td>

                    @if ($home_information->role == 'introduction')
                        <td> مقدمة الموقع </td>
                    @elseif($home_information->role == 'platform_details')
                        <td>عن المنصة</td>
                    @endif
                    
                    <td>
                        <a href="{{route('dashboard.home.information.edit',$home_information->id)}}">
                            <i class="fas fa-pen text-success fs-4"></i>
                        </a>
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>
    </div>


</x-dashboard-layout>