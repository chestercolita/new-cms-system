<x-admin-master>
    @section('content')

        <h1>Permissions</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="px-4 py-4">
                    <div class="pb-2">
                        @if(session('message'))
                            <div class="alert alert-danger">{{session('message')}}</div>
                        @elseif(session('permission-created-message'))
                            <div class="alert alert-success">{{session('permission-created-message')}}</div>
                        @elseif(session('permission-updated-message'))
                            <div class="alert alert-success">{{session('permission-updated-message')}}</div>
                        @endif
                    </div>
                    <form method="post" action="/admin/auth/permissions">
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
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{$permission->id}}</td>
                                            <td>
                                                <a href="{{ route('permission.edit', $permission) }}">{{$permission->name}}</a>
                                            </td>
                                            <td>{{$permission->slug}}</td>
                                            <td>{{$permission->created_at}}</td>
                                            <td>{{$permission->updated_at}}</td>
                                            <td>
                                                <form method="post" action="{{ route('permission.destroy', $permission->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
