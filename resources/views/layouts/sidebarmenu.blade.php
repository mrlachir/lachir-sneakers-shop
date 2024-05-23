<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ Storage::url('Sneaker-favicon.png') }}" type="image/x-icon">

    <title>LACHIR</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .sidebar {
            width: 160px;
            height: 100vh;
            /* background: #1a202c; */
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            /* padding: 1rem; */
            box-shadow: #1a202c;
        }

        /* .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            margin: 0.5rem 0;
            border-radius: 0.25rem;
        }

        .sidebar a:hover {
            background: #4a5568;
        } */

        .main-content {
            margin-left: 160px;
            /* padding: 1rem; */
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="sidebar shadow-sm">

        <!-- Component Start -->
        <div class="flex flex-col items-center  h-full overflow-hidden text-gray-700 bg-gray-100 ">

            <div class="shrink-0 flex items-center mt-3" >
                <a href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="height: 3rem;" zoomAndPan="magnify" viewBox="0 0 375 149.999998" height="200" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><g/><clipPath id="89d0072c05"><path d="M 71.21875 68.210938 L 303.78125 68.210938 L 303.78125 91.960938 L 71.21875 91.960938 Z M 71.21875 68.210938 " clip-rule="nonzero"/></clipPath></defs><g fill="#231f20" fill-opacity="1"><g transform="translate(5.643099, 113.36378)"><g><path d="M 59.386719 -34.28125 C 49.050781 -14.875 43.355469 -1.898438 33.121094 -1.898438 L 29.640625 -1.898438 L 29.640625 -64.660156 L 35.125 -70.570312 L 35.125 -71.203125 L 3.585938 -71.203125 L 3.585938 -70.570312 L 9.070312 -64.660156 L 9.175781 -6.117188 L 3.480469 -0.632812 L 3.480469 0 L 60.019531 0 L 60.019531 -34.28125 Z M 59.386719 -34.28125 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(65.872334, 113.36378)"><g><path d="M 21.203125 -71.203125 L 21.203125 -70.570312 L 25.738281 -57.804688 L 0.738281 -0.632812 L 0.738281 0 L 27.742188 0 L 27.742188 -0.632812 C 22.996094 -6.011719 20.359375 -14.664062 20.148438 -24.683594 L 37.445312 -24.683594 L 43.777344 -6.117188 L 38.394531 -0.632812 L 38.394531 0 L 66.980469 0 L 66.980469 -0.632812 L 42.933594 -71.203125 Z M 20.148438 -26.582031 C 20.359375 -33.332031 21.625 -40.714844 24.15625 -47.996094 L 26.582031 -54.851562 L 27.214844 -54.851562 L 36.8125 -26.582031 Z M 20.148438 -26.582031 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(130.637235, 113.36378)"><g><path d="M 38.605469 1.160156 C 41.136719 1.160156 56.222656 -10.019531 62.867188 -15.613281 L 62.445312 -16.246094 C 59.175781 -15.085938 56.011719 -14.347656 52.636719 -14.347656 C 27.320312 -14.347656 17.722656 -39.976562 17.722656 -55.167969 C 17.828125 -64.027344 21.835938 -67.507812 25.84375 -67.507812 C 30.378906 -67.507812 39.554688 -63.921875 45.464844 -43.039062 L 46.097656 -42.828125 L 63.394531 -59.808594 C 59.808594 -66.453125 49.894531 -72.679688 36.917969 -72.679688 C 29.535156 -72.679688 2.742188 -65.925781 2.636719 -36.285156 C 2.53125 -13.394531 18.460938 0.421875 38.605469 1.160156 Z M 38.605469 1.160156 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(191.921279, 113.36378)"><g><path d="M 70.886719 -71.203125 L 39.34375 -71.203125 L 39.34375 -70.570312 L 44.832031 -64.660156 L 44.832031 -35.441406 L 29.429688 -35.441406 L 29.429688 -64.660156 L 34.808594 -70.570312 L 34.808594 -71.203125 L 3.375 -71.203125 L 3.375 -70.570312 L 8.753906 -64.660156 L 8.753906 -6.539062 L 3.375 -0.632812 L 3.375 0 L 34.808594 0 L 34.808594 -0.632812 L 29.429688 -6.539062 L 29.429688 -33.542969 L 44.832031 -33.542969 L 44.832031 -6.539062 L 39.34375 -0.632812 L 39.34375 0 L 70.886719 0 L 70.886719 -0.632812 L 65.398438 -6.539062 L 65.398438 -64.660156 L 70.886719 -70.570312 Z M 70.886719 -71.203125 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(262.909528, 113.36378)"><g><path d="M 8.753906 -6.539062 L 3.375 -0.632812 L 3.375 0 L 34.808594 0 L 34.808594 -0.632812 L 29.429688 -6.539062 L 29.429688 -64.660156 L 34.808594 -70.570312 L 34.808594 -71.203125 L 3.375 -71.203125 L 3.375 -70.570312 L 8.753906 -64.660156 Z M 8.753906 -6.539062 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(297.928928, 113.36378)"><g><path d="M 36.8125 -34.175781 L 36.8125 -34.914062 C 59.175781 -37.65625 66.347656 -46.519531 66.347656 -55.378906 C 66.347656 -67.824219 53.058594 -71.203125 37.023438 -71.203125 L 3.480469 -71.203125 L 3.480469 -70.570312 L 9.175781 -65.082031 L 9.070312 -6.539062 L 3.585938 -0.632812 L 3.585938 0 L 35.125 0 L 35.125 -0.632812 L 29.640625 -6.539062 L 29.640625 -34.808594 L 32.066406 -34.808594 L 45.78125 -6.117188 L 40.503906 -0.632812 L 40.503906 0 L 69.933594 0 L 69.933594 -0.949219 L 52.109375 -34.808594 Z M 29.640625 -69.300781 L 33.859375 -69.300781 C 42.828125 -69.300781 44.726562 -62.339844 44.726562 -54.21875 C 44.726562 -46.414062 43.566406 -36.707031 32.804688 -36.707031 L 29.640625 -36.707031 Z M 29.640625 -69.300781 "/></g></g></g><g clip-path="url(#89d0072c05)"><path fill="#fbfaf9" d="M 71.21875 68.210938 L 303.824219 68.210938 L 303.824219 91.960938 L 71.21875 91.960938 Z M 71.21875 68.210938 " fill-opacity="1" fill-rule="nonzero"/></g><g fill="#231f20" fill-opacity="1"><g transform="translate(121.658682, 84.210803)"><g><path d="M 4.84375 0.253906 C 7.183594 0.253906 8.753906 -0.71875 8.753906 -2.160156 C 8.753906 -3.371094 7.789062 -4.015625 5.554688 -4.324219 L 3.792969 -4.566406 C 2.617188 -4.726562 2.121094 -5.023438 2.121094 -5.53125 C 2.121094 -6.222656 3.050781 -6.699219 4.355469 -6.699219 C 5.660156 -6.699219 6.855469 -6.167969 7.4375 -5.414062 L 8.128906 -6.273438 C 7.460938 -7.152344 6.007812 -7.769531 4.34375 -7.769531 C 2.195312 -7.769531 0.667969 -6.886719 0.667969 -5.4375 C 0.667969 -4.269531 1.503906 -3.675781 3.464844 -3.421875 L 5.246094 -3.148438 C 6.6875 -2.945312 7.300781 -2.597656 7.300781 -2.035156 C 7.300781 -1.347656 6.347656 -0.835938 4.917969 -0.835938 C 3.167969 -0.835938 1.558594 -1.578125 1.007812 -2.648438 L 0.210938 -1.800781 C 0.921875 -0.59375 2.753906 0.253906 4.84375 0.253906 Z M 4.84375 0.253906 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(139.101404, 84.210803)"><g><path d="M 0.53125 0 L 1.949219 0 L 1.949219 -6.082031 L 1.960938 -6.082031 L 7.34375 0 L 9.1875 0 L 9.1875 -7.511719 L 7.757812 -7.511719 L 7.757812 -1.441406 L 7.746094 -1.441406 L 2.375 -7.511719 L 0.53125 -7.511719 Z M 0.53125 0 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(157.296289, 84.210803)"><g><path d="M 0.53125 0 L 8.105469 0 L 8.105469 -1.070312 L 1.960938 -1.070312 L 1.960938 -3.371094 L 7.578125 -3.371094 L 7.578125 -4.355469 L 1.960938 -4.355469 L 1.960938 -6.433594 L 8 -6.433594 L 8 -7.511719 L 0.53125 -7.511719 Z M 0.53125 0 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(174.092785, 84.210803)"><g><path d="M 0.0429688 0 L 1.578125 0 L 2.4375 -1.644531 L 7.144531 -1.644531 L 8 0 L 9.546875 0 L 5.667969 -7.511719 L 3.953125 -7.511719 Z M 2.871094 -2.671875 L 4.789062 -6.441406 L 4.8125 -6.441406 L 6.71875 -2.671875 Z M 2.871094 -2.671875 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(192.160539, 84.210803)"><g><path d="M 0.53125 0 L 2.003906 0 L 2.003906 -2.542969 L 3.296875 -3.519531 L 6.730469 0 L 8.617188 0 L 4.34375 -4.34375 L 8.53125 -7.511719 L 6.527344 -7.511719 L 2.011719 -4.089844 L 2.003906 -4.089844 L 2.003906 -7.511719 L 0.53125 -7.511719 Z M 0.53125 0 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(209.253668, 84.210803)"><g><path d="M 0.53125 0 L 8.105469 0 L 8.105469 -1.070312 L 1.960938 -1.070312 L 1.960938 -3.371094 L 7.578125 -3.371094 L 7.578125 -4.355469 L 1.960938 -4.355469 L 1.960938 -6.433594 L 8 -6.433594 L 8 -7.511719 L 0.53125 -7.511719 Z M 0.53125 0 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(226.05016, 84.210803)"><g><path d="M 8.382812 0.210938 C 8.964844 0.210938 9.507812 -0.0742188 9.824219 -0.464844 L 9.378906 -1.164062 C 9.21875 -0.921875 8.988281 -0.753906 8.753906 -0.753906 C 8.46875 -0.753906 8.320312 -0.953125 8.191406 -1.207031 L 7.660156 -2.277344 C 7.480469 -2.679688 7.238281 -2.988281 6.878906 -3.179688 L 6.878906 -3.191406 C 8.253906 -3.339844 9.101562 -4.144531 9.101562 -5.265625 C 9.101562 -6.65625 8.011719 -7.511719 6.253906 -7.511719 L 0.53125 -7.511719 L 0.53125 0 L 2.003906 0 L 2.003906 -2.914062 L 5.066406 -2.914062 C 5.59375 -2.914062 6.039062 -2.585938 6.292969 -2.054688 L 6.867188 -0.835938 C 7.152344 -0.277344 7.585938 0.210938 8.382812 0.210938 Z M 2.003906 -3.933594 L 2.003906 -6.464844 L 5.945312 -6.464844 C 6.972656 -6.464844 7.628906 -5.964844 7.628906 -5.183594 C 7.628906 -4.429688 6.972656 -3.933594 5.945312 -3.933594 Z M 2.003906 -3.933594 "/></g></g></g><g fill="#231f20" fill-opacity="1"><g transform="translate(244.350979, 84.210803)"><g><path d="M 4.84375 0.253906 C 7.183594 0.253906 8.753906 -0.71875 8.753906 -2.160156 C 8.753906 -3.371094 7.789062 -4.015625 5.554688 -4.324219 L 3.792969 -4.566406 C 2.617188 -4.726562 2.121094 -5.023438 2.121094 -5.53125 C 2.121094 -6.222656 3.050781 -6.699219 4.355469 -6.699219 C 5.660156 -6.699219 6.855469 -6.167969 7.4375 -5.414062 L 8.128906 -6.273438 C 7.460938 -7.152344 6.007812 -7.769531 4.34375 -7.769531 C 2.195312 -7.769531 0.667969 -6.886719 0.667969 -5.4375 C 0.667969 -4.269531 1.503906 -3.675781 3.464844 -3.421875 L 5.246094 -3.148438 C 6.6875 -2.945312 7.300781 -2.597656 7.300781 -2.035156 C 7.300781 -1.347656 6.347656 -0.835938 4.917969 -0.835938 C 3.167969 -0.835938 1.558594 -1.578125 1.007812 -2.648438 L 0.210938 -1.800781 C 0.921875 -0.59375 2.753906 0.253906 4.84375 0.253906 Z M 4.84375 0.253906 "/></g></g></g></svg>
                </a>                    
            </div>
            <div class="w-full ">
                <div class="flex flex-col  w-full mt-3 border-t border-gray-300 ">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            Analytics
                        </div>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.slideshows.index')" :active="request()->routeIs('admin.slideshows.index')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            {{ __('Slideshows') }}
                        </div>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.top_categories.index')" :active="request()->routeIs('admin.top_categories.index')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            {{ __('Top categories') }}
                        </div>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.featured_products.index')" :active="request()->routeIs('admin.featured_products.index')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            {{ __('Featured Products') }}
                        </div>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            {{ __('Categories') }}
                        </div>
                    </x-nav-link>
                    
                    <x-nav-link :href="route('admin.brands.index')" :active="request()->routeIs('admin.brands.index')">
                            <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                                {{ __('Brands') }}
                            </div>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.sneakers.index')" :active="request()->routeIs('admin.sneakers.index')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            {{ __('Sneakers') }}
                        </div>
                    </x-nav-link>
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    <div class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300">
                            Store
                        </div>
                    </x-nav-link>
                    
                    













                </div>
                
            </div>
            <a class="flex items-center pl-5 w-full h-10 mt-auto bg-gray-200 hover:bg-gray-300"
                href="{{ route('profile.edit') }}">
                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-2 text-sm font-medium">Account</span>
            </a>
            <a class="flex items-center pl-5 w-full h-10  bg-gray-200 hover:bg-gray-300"
                href="{{ route('logout') }}">
                <span class="ml-2 text-sm font-medium">Log out</span>
            </a>
        </div>
        <!-- Component End  -->

    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>

</html>
