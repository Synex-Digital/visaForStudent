<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" data-layout="fill-svg">
    <div>

        <div class="logo-wrapper " style="margin-bottom: 30px;">
            {{-- <p class="text-info fs-5" style="width: 70px; margin: auto; display: flex;" > 45 Degree Education Consultancy</p> --}}
            {{-- <p class="text-white  " style="text-align:center; display: flex;" ></p> --}}

            <a href="{{route('dashboard')}}"><img class="img-fluid" src="{{asset('uploads/logos.png')}}" style="width: 220px; height: 120px; margin: auto; display: flex;" alt=""></a>
            <div class="toggle-sidebar">
                {{-- <svg class="sidebar-toggle">
                    <use href="https://admin.pixelstrap.net/dunzo/assets/svg/icon-sprite.svg#toggle-icon">
                    </use>
                </svg> --}}
            </div>
        </div>
        <div class="logo-icon-wrapper "><a href="index.html"><img class="img-fluid"
                    src="../assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu ">
                <ul class="sidebar-links mt-4" id="simple-bar">
                    <li class="back-btn">
                        <a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-icon.png"
                                alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>

                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav active" href="{{route('dashboard')}}">

                        <svg class="fill-icon">
                            <use href="../assets/svg/icon-sprite.svg#fill-home"></use>
                        </svg><span>Dashboard</span><div class="according-menu"></div></a>
                    </li>
{{--
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="user" class="text-white"></i>
                            <span class="lan-3">Dashboard </span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a class="lan-4" href="index.html">Default</a></li>
                            <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li>
                            <li><a href="dashboard-03.html">Project</a></li>
                        </ul>
                    </li> --}}

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="user" class="text-white"></i>
                            <span>Country </span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a  href="{{ route('country-blog.index') }}">Country list</a></li>
                            <li><a  href="{{ route('country-blog.create') }}">Country Create</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            {{-- <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div> --}}
        </nav>
    </div>
</div>
