{{-- For submenu --}}
<ul class="menu-content">
    @if (isset($menu))
        @foreach ($menu as $submenu)
            <li @class(['active' => request()->is($submenu->slug)])>
                <a href="{{ isset($submenu->url) ? route($submenu->url) : 'javascript:void(0)' }}"
                    class="d-flex align-items-center"
                    target="{{ isset($submenu->newTab) && $submenu->newTab === true ? '_blank' : '_self' }}">
                    @if (isset($submenu->icon))
                        <i data-feather="{{ $submenu->icon }}"></i>
                    @endif
                    <span class="menu-item text-truncate">{{ __('locale.' . $submenu->name) }}</span>
                </a>
                @if (isset($submenu->submenu))
                    @include('layouts.admin.partials.submenu', ['menu' => $submenu->submenu])
                @endif
            </li>
        @endforeach
    @endif
</ul>
