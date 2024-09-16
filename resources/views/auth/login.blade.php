<x-layouts.main-layout pageTitle="Login">
    <main>
        <form method="post" action={{ route("authenticate") }}>

            @csrf

            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="{{ old("email") }}">
            @error("email")
                <h1>{{ $message }}</h1>
            @enderror
            <label for="password">Senha</label>
            <input type="password" id="password" name="password">
            @error("password")
                <h1>{{ $message }}</h1>
            @enderror

            @if (session("invalid_login"))
                <h1>{{ session("invalid_login") }}</h1>
            @endif

            <button type="submit">Entrar</button>
        </form>
    </main>
  </x-layouts.main-layout>