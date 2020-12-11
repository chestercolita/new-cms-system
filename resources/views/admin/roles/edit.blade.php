<x-admin-master>
    @section('content')
        <h1>Edit a Role: {{ $role->name }}</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="px-4 py-4">
                    <div class="pb-2">

                        <form method="post" action="{{route('roles.update', $role->id)}}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       id="name" value="{{ $role->name }}" @if($role->name == 'Admin') disabled @endif>
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary"> Update </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @if($permissions->isNotEmpty())
                    <div class="px-4 py-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Role Permissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>

                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" @if($role->roleHasPermission($permission->name)) checked @endif onclick="return false">
                                            </td>
                                            <td>{{$permission->id}}</td>
                                            <td>
{{--                                                <a href="{{ route('roles.edit', $role) }}">{{$permission->name}}</a>--}}
                                                {{$permission->name}}
                                            </td>
                                            <td>{{$permission->slug}}</td>
                                            <td>
                                                <form method="post "action="{{ route('roles.permission.attach', $role) }}">
                                                    @method('PUT')
                                                    @csrf

                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button type="submit" class="btn btn-primary text-xs" @if($role->permissions->contains($permission)) disabled @endif>Attach</button>

                                                </form>
                                            </td>
                                            <td>
                                                <form method="post "action="{{ route('roles.permission.detach', $role) }}">
                                                    @method('PUT')
                                                    @csrf

                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button class="btn btn-danger text-xs" @if(!$role->permissions->contains($permission)) disabled @endif>Detach</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endsection
</x-admin-master>
