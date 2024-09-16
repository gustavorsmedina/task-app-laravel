<x-layouts.main-layout pageTitle="Register">
    <div class="h-[calc(100vh-50px)] text-neutral-200 flex justify-center items-center">
        <div class="max-w-sm w-full bg-neutral-900 rounded-2xl p-8">
            <h2 class="text-2xl mb-6 text-center">Registrar</h2>
            <form method="post" action="{{ route('store_user') }}" class="flex flex-col gap-4">
                @csrf

                <div class="flex flex-col">
                    <label for="name" class="text-neutral-300">Nome</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="email" class="text-neutral-300">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="password" class="text-neutral-300">Senha</label>
                    <input type="password" id="password" name="password"
                        class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="password_confirmation" class="text-neutral-300">Confirmação de senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                @if (session('server_error'))
                    <p class="text-red-500 text-sm">{{ session('server_error') }}</p>
                @endif

                <button type="submit" class="bg-indigo-600 rounded-2xl w-full py-3 mt-4">Registrar</button>
            </form>
        </div>
    </div>
</x-layouts.main-layout>
