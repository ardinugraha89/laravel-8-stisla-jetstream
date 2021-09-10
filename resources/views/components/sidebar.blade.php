@php
if (Auth::user()->is_admin) {
    $links = [
        [
            'href' => 'dashboard',
            'text' => 'Dashboard',
            'is_multi' => false,
        ],
        [
            'href' => [
                [
                    'section_text' => 'User',
                    'section_list' => [['href' => 'user', 'text' => 'Data User'], ['href' => 'pangkat.user', 'text' => 'Info Pangkat'], ['href' => 'jabatan.user', 'text' => 'Info Jabatan'], ['href' => 'kgb', 'text' => 'Kenaikan Gaji Berkala'], ['href' => 'mutasi', 'text' => 'Catatan Mutasi'], ['href' => 'lampiran', 'text' => 'Lampiran'], ['href' => 'user.new', 'text' => 'Buat User']],
                    'section_icon' => 'fas fa-user',
                ],
            ],
            'text' => 'User',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Pendidikan',
                    'section_list' => [['href' => 'edu', 'text' => 'Data Pendidikan'], ['href' => 'edu.new', 'text' => 'Tambah Data Pendidikan']],
                    'section_icon' => 'fas fa-user-graduate',
                ],
            ],
            'text' => 'Pendidikan',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Pelatihan/Diklat',
                    'section_list' => [['href' => 'pelatihan', 'text' => 'Data Pelatihan'], ['href' => 'pelatihan.new', 'text' => 'Tambah Data Pelatihan']],
                    'section_icon' => 'fas fa-certificate',
                ],
            ],
            'text' => 'Pelatihan/Diklat',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Jabatan',
                    'section_list' => [['href' => 'jabatan', 'text' => 'Info Jabatan'], ['href' => 'jabatan.new', 'text' => 'Tambah Data Jabatan']],
                    'section_icon' => 'fas fa-briefcase',
                ],
            ],
            'text' => 'Jabatan',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Pangkat dan Golongan',
                    'section_list' => [['href' => 'pangkat', 'text' => 'Data Pangkat'], ['href' => 'pangkat.new', 'text' => 'Tambah Data Pangkat']],
                    'section_icon' => 'fas fa-id-card-alt',
                ],
            ],
            'text' => 'Pangkat dan Golongan',
            'is_multi' => true,
        ],
    ];
} else {
    $links = [
        [
            'href' => 'dashboard',
            'text' => 'Dashboard',
            'is_multi' => false,
        ],
        [
            'href' => [
                [
                    'section_text' => 'User',
                    'section_list' => [['href' => 'user', 'text' => 'Data User'], ['href' => 'pangkat.user', 'text' => 'Info Pangkat'], ['href' => 'jabatan.user', 'text' => 'Info Jabatan'], ['href' => 'kgb', 'text' => 'Kenaikan Gaji Berkala'], ['href' => 'mutasi', 'text' => 'Catatan Mutasi'], ['href' => 'lampiran', 'text' => 'Lampiran']],
                    'section_icon' => 'fas fa-user',
                ],
            ],
            'text' => 'User',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Pendidikan',
                    'section_list' => [['href' => 'edu', 'text' => 'Data Pendidikan'], ['href' => 'edu.new', 'text' => 'Tambah Data Pendidikan']],
                    'section_icon' => 'fas fa-user-graduate',
                ],
            ],
            'text' => 'Pendidikan',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Pelatihan/Diklat',
                    'section_list' => [['href' => 'pelatihan', 'text' => 'Data Pelatihan'], ['href' => 'pelatihan.new', 'text' => 'Tambah Data Pelatihan']],
                    'section_icon' => 'fas fa-certificate',
                ],
            ],
            'text' => 'Pelatihan/Diklat',
            'is_multi' => true,
        ],
    ];
}
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="{{ asset('storage/img/logo_bappeda.png') }}" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
            <ul class="sidebar-menu">
                <li class="menu-header">{{ $link->text }}</li>
                @if (!$link->is_multi)
                    <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route($link->href) }}"><i
                                class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>
                @else
                    @foreach ($link->href as $section)
                        @php
                            $routes = collect($section->section_list)
                                ->map(function ($child) {
                                    return Request::routeIs($child->href);
                                })
                                ->toArray();
                            
                            $is_active = in_array(true, $routes);
                        @endphp

                        <li class="dropdown {{ $is_active ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="{{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                            <ul class="dropdown-menu">
                                @foreach ($section->section_list as $child)
                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                            class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
            </ul>
        @endforeach
    </aside>
</div>
