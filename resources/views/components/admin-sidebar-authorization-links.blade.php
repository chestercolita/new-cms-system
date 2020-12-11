<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuth" aria-expanded="true" aria-controls="collapseAuth">
        <i class="fas fa-fw fa-cog"></i>
        <span>Authorizations</span>
    </a>
    <div id="collapseAuth" class="collapse @if(Request::is('admin/auth*')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Authorizations</h6>
            <a class="collapse-item" href="{{route('roles.index')}}">Roles</a>
            <a class="collapse-item" href="{{route('permission.index')}}">Permissions</a>
        </div>
    </div>
</li>
