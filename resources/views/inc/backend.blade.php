<nav class="sideNavBackend col-2">
    <div class="person">
        <i class="fas fa-user-circle"></i>
        <div class="loginName">
        </div>
    </div>

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{$username}} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>

    <div class="links">
        <ul >
            <li class="row">
                <div class="col-12">
                    <a href="/admin/backanddashboard" class="" />
                   
                    <p class="navItem"><i class="fas fa-home fa-sidebar"></i> Dashboard</p> 
                    </a>
                </div>
            </li>
            <li class="row">
                <div class="col-12">
                    <a href="/admin/user" class="" />
                  
                    <p class="navItem"><i class="fas fa-users fa-sidebar"></i> Deelnemers</p>
                    </a>
                </div>
            </li>
            <li class="row">
                <div class="col-12">
                    <a href="/admin/user/create/1" class="" />

                    <p class="navItem"><i class="fas fa-users fa-sidebar"></i> Begeleider aanmaken</p>
                    </a>
                </div>
            </li>
            <li class="row">
                <div class="col-12">
                    <a href="/admin/achievement" class="" />
                  
                    <p class="navItem"><i class="fas fa-certificate"></i> Achievements</p>
                    </a>
                </div>
            </li>
            <li class="row">
                <div class="col-12">
                    <a href="/admin/icon" class="" />
                    
                    <p class="navItem"><i class="fas fa-medal fa-sidebar"></i> Iconen</p>
                    </a>
                </div>
            </li>
            <li class="row">
                <div class="col-12">
                    <a href="/admin/goalstemplate" class="" />
                  
                    <p class="navItem">  <i class="fas fa-medal fa-sidebar"></i> Leerdoelen template </p>
                    </a>
                </div>
            </li>
            <li class="row">
                <div class="col-12">
                    <a href="/admin/feedback" class="" />
                    <p class="navItem"> <i class="fas fa-medal fa-sidebar"></i> Feedback overzicht</p>
                    </a>
                </div>
            </li>
        </ul>

        <div class="LogoBackendFooter">
        <div class="col-6">
                <img src="/images/logo-wit-200px.png"/>
               
        </div>
        </div>
    </div>
</nav>