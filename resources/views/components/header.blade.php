<header class="flex bg-neutral-800 h-[50px]">
    <nav class="w-full px-2">
        <ul class="flex h-full justify-between items-center">
            <li><a href="{{ route('home') }}"><img src="{{ asset('/svg/logo.svg') }}" alt="Logo" class="w-8"></a>
            </li>
            <li>
                <p class="text-neutral-200">Seja bem-vindo(a) {{ Auth::user()->name }}!</p>
            </li>
            <li><a href="{{ route('logout') }}"><img src="{{ asset('/svg/logout.svg') }}" alt="Ícone para deslogar"
                        class="w-8"></a></li>
        </ul>
    </nav>
</header>
