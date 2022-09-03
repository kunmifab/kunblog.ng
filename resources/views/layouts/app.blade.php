<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('/images/kunblog_logo.PNG')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title')</title>
    @yield('css')

</head>
<body>

        <div class="jumbotron jumbotron-fluid bg-white mb-5 ">
            <div class="container position-relative ">
                <div class="navContainer">
               <div class="row ">
                <nav class="col mb-2">
                    <ul>
                        <li class="logo"><a class="navbar-brand" href="{{route('welcome')}}"><img src="{{asset('/images/kunblog_logo.PNG')}}" width="100px" alt=""></a></li>
                        <li><a class="text-muted" href="{{route('post.index')}}">Posts</a></li>
                        <li><a class="text-muted" href="{{route('category.index')}}">Categories</a></li>
                        <li><a class="text-muted" href="{{route('tag.index')}}">Tags</a></li>
                        @if (auth()->check())
                        @if (auth()->user()->role->id == 1)
                        <li><a class="text-muted" href="{{route('role.index')}}">Roles</a></li>
                        @endif
                        @endif

                        @if (!auth()->check())
                        <li class="float-right mt-4">
                            <a href="{{route('login')}}" id="log-in">Login</a>
                            <a id="log-in" class="btnGet ml-2" href="{{route('register')}}" id="log-in">Sign Up</a>

                        </li>
                        @else
                        @auth

                        {{-- for notification --}}
                        <li class="float-right mt-4 nav-item dropdown" id="notificationBell">
                            <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell @if($newNotifications->count() >= 1) shake @endif">@if($newNotifications->count() >= 1)<sup>{{$newNotifications->count()}}</sup> @endif</i>
                            </a>

                            <div class="dropdown-menu" style="background-color: #3a3053; width: 250px;" aria-labelledby="navbarDropdown">
                              @foreach ($notifications->slice(0,3) as $notification)
                                <a class="dropdown-item text-white" href="{{route('profile.index')}}">
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-center text-center">
                                        @if ($notification->type == 'Post')
                                        <img src="{{asset($notification->post->image_path)}}" width="50px" height="50px" alt="">
                                        @elseif ($notification->type == 'User')
                                        <i class="fas fa-user fa-2x"></i>
                                        @endif

                                    </div>
                                    <div class="col-9">
                                       <p> @if ($notification->type == 'Post')
                                        New Post:
                                        @elseif ($notification->type == 'User')
                                        New User:
                                        @endif
                                        {{substr($notification->content,0,10)}}
                                    </p>
                                       <p><small>
                                        @if (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 60)
                                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at))}} sec(s) ago.

                                        {{-- for 2 to 60 mins --}}
                                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 60 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) < 3600)
                                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/60)}} min(s) ago.

                                        {{-- for 2 to 24 hours --}}
                                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 3600 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 86400)
                                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/3600)}} hour(s) ago.

                                        {{-- for 2 to 31 days --}}
                                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 86400 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 2678400)
                                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/86400)}} day(s) ago.

                                        {{-- for 2 to 12 months --}}
                                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 2678400 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 32140800)
                                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/2678400)}} month(s) ago.

                                        {{-- for years --}}
                                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 32140800)
                                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) / 32140800)}} year(s) ago.
                                        @endif
                                    </small></p>
                                    </div>
                                </div>
                            </a>
                              @endforeach
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item text-white btn border" href="{{route('notification.index')}}"><i class="fas fa-sign-out-alt"></i> All Notifications</a>
                            </div>
                          </li>

                        <li class="float-right mt-4 nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (auth()->user()->profile_picture != null)
                                    <img src="{{asset(auth()->user()->profile_picture)}}" style="border-radius: 50%" width="50px" alt="profile-picture">
                                    @else
                                    <i class="fas fa-user"></i>
                                    @endif
                                    {{Auth::user()->firstname}}
                                </a>
                                <div class="dropdown-menu" style="background-color: #3a3053" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item text-white" href="{{route('profile.index')}}"><i class="far fa-id-badge"></i> Profile</a>

                                  @if (auth()->user()->role->id == 1)
                                  <a class="dropdown-item text-white" href="{{route('user.index')}}"><i class="far fa-id-badge"></i> Registered Users</a>
                                  @endif

                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item text-white" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                </div>
                              </li>


                              @endauth
                        @endif
                    </ul>
                </nav>
                </div>
        </div>

                <!-- for dropdown in small screens -->


                <ul class="logoSmall">
                    <li class="logo"><a class="navbar-brand" href="{{route('welcome')}}"><img src="{{asset('images/kunblog_logo.PNG')}}" width="100px" alt=""></a></li>
                </ul>
                <div class="toggler">
                    <i class="fas fa-bars fa-2x "></i>
                </div>
                    <div class="dropdownContents text-center">
                        <ul>
                            <li><a href="{{route('post.index')}}" class="text-white">Posts</a></li>
                            <li><a href="{{route('category.index')}}" class="text-white">Categories</a></li>
                            <li><a href="{{route('tag.index')}}" class="text-white">Tags</a></li>
                            <br>
                            <hr class="w-75 m-auto bg-white">
                            <br>
                            @if (!auth()->check())
                            <li><a href="{{route('login')}}" class="text-white">Login</a href="{{route('login')}}"></li>
                            <li><a href="{{route('register')}}" class="text-white">Sign up</a></li>
                            @else
                            @auth
                             {{-- for notification --}}
                        <li class="nav-item dropdown" id="notificationBell">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell @if($newNotifications->count() >= 1) shake @endif">@if($newNotifications->count() >= 1)<sup>{{$newNotifications->count()}}</sup> @endif</i>
                            </a>
                            <div class="dropdown-menu" style="background-color: #3a3053" aria-labelledby="navbarDropdown">
                                @foreach ($notifications->slice(0,3) as $notification)
                                <a class="dropdown-item text-white" href="{{route('profile.index')}}">
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-center text-center">
                                        @if ($notification->type == 'Post')
                                        <img src="{{asset($notification->post->image_path)}}" width="50px" height="50px" alt="">
                                        @elseif ($notification->type == 'User')
                                        <i class="far fa-id-badge fa-2x"></i>
                                        @endif

                                    </div>
                                    <div class="col-9">
                                       <p> @if ($notification->type == 'Post')
                                        New Post:
                                        @elseif ($notification->type == 'User')
                                        New User:
                                        @endif
                                        {{substr($notification->content,0,10)}}
                                    </p>
                                       <p>{{date('Y-m-d', strtotime($notification->created_at))}}</p>
                                    </div>
                                </div>
                            </a>
                              @endforeach

                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item text-white btn border" href="{{route('notification.index')}}"><i class="fas fa-sign-out-alt"></i> All Notifications</a>
                            </div>
                          </li>

                            <li class="nav-item dropdown">

                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (auth()->user()->profile_picture != null)
                                        <img src="{{asset(auth()->user()->profile_picture)}}" style="border-radius: 50%" width="50px" alt="profile-picture">
                                        @else
                                        <i class="fas fa-user"></i>
                                        @endif
                                        {{Auth::user()->firstname}}
                                    </a>
                                    <div class="dropdown-menu" style="background-color: #3a3053" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item text-white" href="{{route('dashboard')}}"><i class="far fa-id-badge"></i> Profile</a>
                                      @if (auth()->user()->role->id == 1)
                                      <a class="dropdown-item text-white" href="{{route('user.index')}}"><i class="far fa-id-badge"></i> Registered Users</a>
                                      @endif

                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item text-white" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                    </div>
                                  </li>
                                  @endauth
                            @endif
                        </ul>
                    </div>

                <!-- end of dropdown -->
                {{-- end of header --}}

        {{-- <div class="inputContainer container mt-5">
            <form>
                <div class="text-center row">
                    <div class="col-lg-10 col-md-10 col-sm-12">

                <input id="valueInput" onkeyup="requiredIt()" class="invalidin" placeholder="Shorten a link here...">
                <p class="text-danger text-left invalidp">Please fill out this field.</p>
            </div>

            <br>
            <br>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <button class="shorten">Shorten It!</button>
                </div>
            </div>
            </form>
        </div> --}}


        @yield('content')





        <div class="container-fluid boostContainer" style="background-image: {{asset('images/bg-boost-mobile.svg')}}, background-repeat: none, background-size: cover;">
            <div class="text-center">
            <h3 class="text-white">Shorten your links today</h3>
            <button class="btnGet">Get Started</button>
            </div>
        </div>

        {{-- start footer  --}}

        <footer class="footer" id="bigfooter">
            <div class="jumbotron jumbotron-fluid pt-5 bg-dark">
                <div class="container">
                    <div class="row">
                        <div class=" col mb-sm-3">
                            <h4>KunBlog</h4>
                            <p class="text-muted"><script>document.write(new Date().getFullYear())</script> © KunCommerce</p>
                            <p class="text-muted">Designed & Developed by Kunmi</p>
                        </div>

                        <div class=" col">
                            <p>Features</p>
                            <ul>
                                <li>Link Shortening</li>
                                <li>Branded Links</li>
                                <li>Analytics</li>
                            </ul>
                        </div>

                        <div class=" col">
                            <p>Resources</p>
                            <ul>
                                <li>Blog</li>
                                <li>Developers</li>
                                <li>Support</li>
                            </ul>
                        </div>

                        <div class=" col">
                            <p>Company</p>
                            <ul>
                                <li>About</li>
                                <li>Our Team</li>
                                <li>Careers</li>
                                <li>Contact</li>
                            </ul>
                        </div>

                        <div class=" col ">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{asset('images/icon-facebook.svg')}}" alt="facebook logo">
                                </div>

                                <div class="col-3">
                                    <img src="{{asset('images/icon-twitter.svg')}}" alt="twitter logo">
                                </div>

                                <div class="col-3">
                                    <img src="{{asset('images/icon-pinterest.svg')}}" alt="pinterest logo">
                                </div>

                                <div class="col-3">
                                    <img src="{{asset('images/icon-instagram.svg')}}" alt="instagram logo">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </footer>

<!-- footer for smaller screens -->
<footer class="footer" id="smallfooter">
    <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container textcenter">

                <div>
                    <h4>KunBlog</h4>
                </div>
                <div class="col">
                    <p>Features</p>
                    <ul>
                        <li>Link Shortening</li>
                        <li>Branded Links</li>
                        <li>Analytics</li>
                    </ul>
                </div>

                <div class="col">
                    <p>Resources</p>
                    <ul>
                        <li>Blog</li>
                        <li>Developers</li>
                        <li>Support</li>
                    </ul>
                </div>

                <div class=" col">
                    <p>Company</p>
                    <ul>
                        <li>About</li>
                        <li>Our Team</li>
                        <li>Careers</li>
                        <li>Contact</li>
                    </ul>
                </div>

                <div class=" col-10 m-auto">
                    <div class="row">
                        <span class="m-1">
                            <img src="{{asset('images/icon-facebook.svg')}}" alt="facebook logo">
                        </span>

                        <span class="m-1">
                            <img src="{{asset('images/icon-twitter.svg')}}" alt="twitter logo">
                        </span>

                        <span class="m-1">
                            <img src="{{asset('images/icon-pinterest.svg')}}" alt="pinterest logo">
                        </span>

                        <span class="m-1">
                            <img src="{{asset('images/icon-instagram.svg')}}" alt="instagram logo">
                        </span>
                    </div>
                </div>

                <div class="p-3">
                    <script>document.write(new Date().getFullYear())</script> © KunBlog
                  </div>
                  <div>
                        Designed & Developed by Kunmi
                    </div>

            </div>



    </div>
</footer>

<!-- end of footer for smaller screens -->

   {{-- end footer  --}}




    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
