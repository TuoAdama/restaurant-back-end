<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <!-- sidebar-brand  -->
        <div class="sidebar-item sidebar-brand">
            <a href="#">Mon restaurant</a>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-item sidebar-header d-flex flex-nowrap">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="{{asset('assets/img/user.jpg')}}" alt="User picture">
            </div>
            <div class="user-info">
                <span class="user-name">
                    <strong>{{auth()->user()->name}}</strong>
                </span>
                <span class="user-role">Administrateur</span>
            </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-item sidebar-search">
            <div>
                <div class="input-group">
                    <input type="text" class="form-control search-menu" placeholder="Search...">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar-menu  -->
        <div class=" sidebar-item sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('personnels.index')}}">
                        <i class="fa fa-book"></i>
                        <span class="menu-text">Personnels</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('commandes')}}">
                        <i class="fa fa-calendar"></i>
                        <span class="menu-text">Commandes</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('plats.index')}}">
                        <i class="fa fa-folder"></i>
                        <span class="menu-text">Menus</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">
                        <i class="fa fa-folder"></i>
                        <span class="menu-text">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('tableclients.index')}}">
                        <i class="fa fa-folder"></i>
                        <span class="menu-text">Tables</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-footer  -->
    <div class="sidebar-footer">
        <div>
            <a href="{{route('logout')}}">
                <i class="fa fa-power-off"></i>
            </a>
        </div>
        <div class="pinned-footer">
            <a href="#">
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </div>
</nav>