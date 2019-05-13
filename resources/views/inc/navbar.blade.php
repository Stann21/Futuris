<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <div class="navbar-divider nav-top justify-content-between">
                <div class="logo-arrow-container d-flex">
                    <?php if(strpos($_SERVER['REQUEST_URI'], 'goal') !== false):?>
                    <span class="nav-backarrow">
                        <a href="/overview"><i class="fas fa-arrow-left"></i></a>
                    </span>
                        <?php elseif(strpos($_SERVER['REQUEST_URI'], 'achievementDetail') !== false):?>
                        <span class="nav-backarrow">
                            <a href="/achievements"><i class="fas fa-arrow-left"></i></a>
                        </span>
                         <?php elseif(strpos($_SERVER['REQUEST_URI'], 'feedbackDetail') !== false):?>
                        <span class="nav-backarrow">
                            <a href="/feedback"><i class="fas fa-arrow-left"></i></a>
                        </span>
                        <?php else: ?>
                    <?php endif; ?>

                        <a class="navbar-brand" href="/overview">
                            <img src="/images/logo-wit-200px.png"/>
                        </a>
                </div> <!-- End navar-divider -->

                <div class="navbar-content-right">
                    <ul class="nav navbar-nav">
                        <li class="nav-link"><a href="/overview">Overzicht</a></li>
                        <li class="nav-link"><a href="/feedback">Feedback</a></li>
                        <li class="nav-link"><a href="/achievements">Achievements</a></li>
                    </ul>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i>{{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/settings">Instellingen</a>
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

                    <script>
                        $(document).ready(function () {
                            $(function(){
                                var current = location.pathname;
                                $('.nav-link a').each(function(){
                                    var $this = $(this);
                                    // if the current path is like this link, make it active
                                    if($this.attr('href').indexOf(current) !== -1){
                                        $this.addClass('active');
                                    }
                                })
                            });

                            $("#menuToggle").click(function () {
                                var mobileUl = $("#mobile_ul");
                                 if(mobileUl.hasClass("hidden")){
                                     mobileUl.animate({top: '0'}, "fast").removeClass("hidden");
                                     $("html").css("overflow", "hidden");
                                 } else {
                                     mobileUl.animate({top: '-100%'}, "fast").addClass("hidden");
                                     $("html").css("overflow", "visible");
                                 }
                            });
                        });
                    </script>

                    <section id="menu">
                        <div id="menuToggle">
                            <!-- A fake / hidden checkbox is used as click reciever, so you can use the :checked selector on it. -->
                            <input id="menubutton" type="checkbox" />
                            <!--Some spans to act as a hamburger.-->
                            <div>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div id="extraatje"></div>
                        </div> <!-- End menuToggle -->
                    </section>

                    <ul id="mobile_ul" class="hidden">
                        <li class="nav-link"><a href="/overview">Overzicht</a></li>
                        <li class="nav-link"><a href="/feedback">Feedback</a></li>
                        <li class="nav-link"><a href="/achievements">Achievements</a></li>
                        <li class="nav-link"><a href="/settings">Instellingen</a></li>
                        <li class="nav-link"><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                            
                </div>
            </div>
    </div> <!-- End container -->
    @endguest
</nav>