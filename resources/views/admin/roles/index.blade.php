<x-admin-master>
    @section('content')

        <h1>Roles</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="px-4 py-4">
                    <div class="pb-2">
                        @if(session('message'))
                            <div class="alert alert-danger">{{session('message')}}</div>
                        @elseif(session('role-created-message'))
                            <div class="alert alert-success">{{session('role-created-message')}}</div>
                        @elseif(session('role-updated-message'))
                            <div class="alert alert-success">{{session('role-updated-message')}}</div>
                        @endif
                    </div>
                    <form method="post" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block"> Create </button>

                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="px-4 py-2">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                    </tr>

                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>
                                                <a href="{{ route('roles.edit', $role) }}">{{$role->name}}</a>
                                            </td>
                                            <td>{{$role->slug}}</td>
                                            <td>{{$role->created_at}}</td>
                                            <td>{{$role->updated_at}}</td>
                                            <td>
                                                <form method="post" action="{{ route('roles.destroy', $role->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" @if($role->name == 'Admin') disabled @endif>Delete</button>
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
            </div>
        </div>
    @endsection
</x-admin-master>
