<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Date of birth</th>
            <th>Skype</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Team</th>
            <th>Action</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($list_employee as $employee)
    <?php
        $id_Role = App\User::find($employee->idAccount)->idRole;
        $name_Role = App\Role::where('idRole','=',$id_Role)->first()->Role;
    ?>
    @if ($id_Role != 1)
        <tr>
            <td class="img" style="width: 20px;"><img src="{{ asset('images/personal_images') }}/{{$employee->E_Avatar}}" style="width: 50px;height: 50px;  margin-left:4.5px;" class="img-circle"></td>
            <td>{{$employee->E_Name}}</td>
            <td>{{$employee->E_Sex == 1 ? 'Male' : 'Female'}}</td>
            <td>{{$employee->E_DateofBirth}}</td>
            <td>{{$employee->E_Skype}}</td>
            <td>0{{$employee->E_Phone}}</td>
            <td>{{$name_Role}}</td>
            <td>{{ $employee->Team->count() != 0 ? $employee->Team->first()->TeamName : 'Available'}}</td>
            <td class="text-center"><a href="{{ route('admin.personal-information.edit',$employee->idEmployee) }}" class="glyphicon glyphicon-pencil"></a></td>
            <td class="text-center"><a href="{{ route('admin.personal-information.show',$employee->idEmployee) }}"><i class="fa fa-info" aria-hidden="true"></i></a></td>
        </tr>
    @endif
    @endforeach
    </tbody>
</table>