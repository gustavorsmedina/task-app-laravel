<x-layouts.main-layout pageTitle="Register">
    <main>
        <form method="post" action={{ route("store_user") }}>

            @csrf

            <label for="name">Nome</label>
            <input type="text" id="name" name="name">
            @error("name")
                <h1>{{ $message }}</h1>
            @enderror

            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            @error("email")
                <h1>{{ $message }}</h1>
            @enderror

            <label for="password">Senha</label>
            <input type="password" id="password" name="password">
            @error("password")
                <h1>{{ $message }}</h1>
            @enderror

            <label for="password_confirmation">Confirmação de senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            @error("password_confirmation")
                <h1>{{ $message }}</h1>
            @enderror

            @if (session("server_error"))
                <h1>{{ session("server_error") }}</h1>
            @endif

            <button type="submit">Entrar</button>
        </form>
    </main>
  </x-layouts.main-layout>