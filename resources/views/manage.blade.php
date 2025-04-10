<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <div class="p-3 col-md-3 col-lg-2 bg-light border-end">
                <h5 class="mb-4">Menu</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            🏠 Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manage') }}" class="nav-link {{ request()->routeIs('manage') ? 'active fw-bold text-primary' : '' }}">
                            🛠️ Manage
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Main content --}}
            <div class="p-4 col-md-9 col-lg-10">
                <livewire:note-manage :onlyMine="true" :editable="true" />
                <livewire:note-form />
            </div>
        </div>
    </div>
</x-app-layout>
