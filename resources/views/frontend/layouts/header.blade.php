@php $settings = DB::table('settings')->get(); @endphp

<header class="header shop">

    <!-- ===== Topbar (hidden on mobile via CSS) ===== -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-inner">
                <!-- Left: contact info -->
                <div class="topbar-left">
                    <span><i class="ti-headphone-alt"></i> @foreach($settings as $data) {{$data->phone}} @endforeach</span>
                    <span><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</span>
                </div>
                <!-- Right: auth links -->
                <div class="topbar-right">
                    @auth
                        <a href="{{route('order.track')}}"><i class="fa fa-truck"></i> Track Order</a>
                        @if(Auth::user()->role=='admin')
                            <a href="{{route('admin')}}" target="_blank"><i class="ti-user"></i> Dashboard</a>
                        @else
                            <a href="{{route('user')}}" target="_blank"><i class="ti-user"></i> Dashboard</a>
                        @endif
                        <a href="{{route('user.logout')}}" class="topbar-logout"><i class="ti-power-off"></i> Logout</a>
                    @else
                        <a href="{{route('login.form')}}"><i class="fa fa-sign-in"></i> Login</a>
                        <span class="topbar-divider">/</span>
                        <a href="{{route('register.form')}}">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <!-- ===== End Topbar ===== -->

    <!-- ===== Middle Bar: Logo + Search + Icons ===== -->
    <div class="middle-inner">
        <div class="container">
            <div class="middle-inner-row">

                <!-- Logo -->
                <div class="header-logo">
                    <a href="{{route('home')}}">
                        <img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="Logo">
                    </a>
                </div>

                <!-- Search Bar (hidden on mobile, shown on tablet+) -->
                <div class="header-search">
                    <form method="POST" action="{{route('product.search')}}" class="header-search-form">
                        @csrf
                        <div class="search-category-wrap">
                            <select class="search-category-select">
                                <option>All Categories</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input name="search" type="search" placeholder="Search for products, brands and more...">
                        <button type="submit"><i class="ti-search"></i></button>
                    </form>
                </div>

                <!-- Right Icons -->
                <div class="header-icons">
                    <!-- Mobile menu toggle (visible only on mobile) -->
                    <button class="mobile-menu-toggle d-lg-none" type="button" data-toggle="collapse" data-target="#mobileNavMenu" aria-controls="mobileNavMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-menu"></i>
                    </button>

                    <!-- Wishlist -->
                    <div class="header-icon-item shopping">
                        <a href="{{route('wishlist')}}" class="icon-link" title="Wishlist">
                            <i class="fa fa-heart-o"></i>
                            <span class="icon-badge">{{Helper::wishlistCount()}}</span>
                        </a>
                        @auth
                        <div class="shopping-item">
                            <div class="dropdown-cart-header">
                                <span>{{count(Helper::getAllProductFromWishlist())}} Items</span>
                                <a href="{{route('wishlist')}}">View Wishlist</a>
                            </div>
                            <ul class="shopping-list">
                                @foreach(Helper::getAllProductFromWishlist() as $data)
                                    @php $photo = explode(',', $data->product['photo']); @endphp
                                    <li>
                                        <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                        <p class="quantity">{{$data->quantity}} x <span class="amount">KSh {{number_format($data->price,2)}}</span></p>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="bottom">
                                <div class="total">
                                    <span>Total</span>
                                    <span class="total-amount">KSh {{number_format(Helper::totalWishlistPrice(),2)}}</span>
                                </div>
                                <a href="{{route('cart')}}" class="btn animate">View Cart</a>
                            </div>
                        </div>
                        @endauth
                    </div>

                    <!-- Cart -->
                    <div class="header-icon-item shopping">
                        <a href="{{route('cart')}}" class="icon-link" title="Cart">
                            <i class="ti-bag"></i>
                            <span class="icon-badge">{{Helper::cartCount()}}</span>
                        </a>
                        @auth
                        <div class="shopping-item">
                            <div class="dropdown-cart-header">
                                <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                                <a href="{{route('cart')}}">View Cart</a>
                            </div>
                            <ul class="shopping-list">
                                @foreach(Helper::getAllProductFromCart() as $data)
                                    @php $photo = explode(',', $data->product['photo']); @endphp
                                    <li>
                                        <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                        <p class="quantity">{{$data->quantity}} x <span class="amount">KSh {{number_format($data->price,2)}}</span></p>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="bottom">
                                <div class="total">
                                    <span>Total</span>
                                    <span class="total-amount">KSh {{number_format(Helper::totalCartPrice(),2)}}</span>
                                </div>
                                <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
                <!-- End Right Icons -->

            </div>

            <!-- Mobile Search Bar (visible only on mobile) -->
            <div class="mobile-search-bar d-lg-none">
                <form method="POST" action="{{route('product.search')}}">
                    @csrf
                    <input name="search" type="search" placeholder="Search products...">
                    <button type="submit"><i class="ti-search"></i></button>
                </form>
            </div>

        </div>
    </div>
    <!-- ===== End Middle Bar ===== -->

    <!-- ===== Desktop Nav Bar (hidden on mobile) ===== -->
    <div class="header-inner d-none d-lg-block">
        <div class="container">
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="navbar-collapse" id="mainNavbar">
                    <ul class="nav main-menu menu navbar-nav">
                        <li class="{{Request::path()=='home' ? 'active' : ''}}">
                            <a href="{{route('home')}}"><i class="ti-home nav-icon"></i> Home</a>
                        </li>
                        <li class="{{Request::path()=='about-us' ? 'active' : ''}}">
                            <a href="{{route('about-us')}}">About Us</a>
                        </li>
                        <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists') active @endif">
                            <a href="{{route('product-grids')}}">Products <span class="nav-badge">New</span></a>
                        </li>
                        {{Helper::getHeaderCategory()}}
                        <li class="{{Request::path()=='blog' ? 'active' : ''}}">
                            <a href="{{route('blog')}}">Blog</a>
                        </li>
                        <li class="{{Request::path()=='contact' ? 'active' : ''}}">
                            <a href="{{route('contact')}}">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <!-- Nav right: promo text -->
                <div class="nav-promo">
                    <i class="ti-rocket"></i> Free shipping on orders over <strong>KSh 100</strong>
                </div>
            </nav>
        </div>
    </div>
    <!-- ===== End Desktop Nav Bar ===== -->

    <!-- ===== Mobile Nav Menu (collapsible) ===== -->
    <div class="collapse mobile-nav-collapse" id="mobileNavMenu">
        <div class="container">
            <nav class="mobile-nav">
                <ul class="mobile-menu-list">
                    <li class="{{Request::path()=='home' ? 'active' : ''}}">
                        <a href="{{route('home')}}"><i class="ti-home"></i> Home</a>
                    </li>
                    <li class="{{Request::path()=='about-us' ? 'active' : ''}}">
                        <a href="{{route('about-us')}}">About Us</a>
                    </li>
                    <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists') active @endif">
                        <a href="{{route('product-grids')}}">Products</a>
                    </li>
                    <li class="{{Request::path()=='blog' ? 'active' : ''}}">
                        <a href="{{route('blog')}}">Blog</a>
                    </li>
                    <li class="{{Request::path()=='contact' ? 'active' : ''}}">
                        <a href="{{route('contact')}}">Contact Us</a>
                    </li>
                    @auth
                        <li><a href="{{route('order.track')}}"><i class="fa fa-truck"></i> Track Order</a></li>
                        @if(Auth::user()->role=='admin')
                            <li><a href="{{route('admin')}}"><i class="ti-user"></i> Dashboard</a></li>
                        @else
                            <li><a href="{{route('user')}}"><i class="ti-user"></i> Dashboard</a></li>
                        @endif
                        <li><a href="{{route('user.logout')}}"><i class="ti-power-off"></i> Logout</a></li>
                    @else
                        <li><a href="{{route('login.form')}}"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="{{route('register.form')}}"><i class="ti-user"></i> Register</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>
    <!-- ===== End Mobile Nav Menu ===== -->

</header>
