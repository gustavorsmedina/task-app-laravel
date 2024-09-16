<x-layouts.main-layout pageTitle="Tarefas">
    <div class="h-[calc(100vh-50px)] text-neutral-200 flex justify-center items-center">
        <div class="max-w-4xl w-full grid grid-cols-2 gap-8">
            <div>
                <h2 class="text-xl">Nova Tarefa</h2>
                <form action="{{ route('store_task') }}" method="POST" class="mt-4 flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col">
                        <label for="title" class="text-neutral-300">Título</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                        @error('title')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="description" class="text-neutral-300">Descrição</label>
                        <textarea name="description" id="description" value="{{ old('description') }}" required
                            class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600 resize-none">
                        </textarea>
                        @error('description')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="date" class="text-neutral-300">Data</label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}" required
                            class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                        @error('date')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="time" class="text-neutral-300">Hora</label>
                        <input type="time" name="time" id="time" value="{{ old('time') }}" required
                            class="bg-neutral-800 rounded-2xl text-base p-2 border-[1px] border-solid border-transparent outline-none hover:border-[1px] hover:border-solid hover:border-indigo-600 focus:border-[1px] focus:border-solid focus:border-indigo-600">
                        @error('time')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    @if ($errors->has('task'))
                        <p>{{ $errors->first('task') }}</p>
                    @endif
                    <button type="submit" class="bg-indigo-600 rounded-2xl w-full py-3 mt-4">Criar Tarefa</button>
                </form>
            </div>
            <div>
                @if ($tasks->isEmpty())
                    <span class="text-neutral-500 block text-center">Não há tarefas disponíveis.</span>
                @else
                    <ul class="flex flex-col gap-8">
                        @foreach ($tasks as $task)
                            @php
                                $now = \Carbon\Carbon::now();
                                $taskDateTime = \Carbon\Carbon::createFromFormat(
                                    'Y-m-d H:i:s',
                                    $task->date . ' ' . $task->time,
                                );
                                $isPast = $taskDateTime->lessThan($now);
                            @endphp
                            <li
                                class="p-2 bg-neutral-900 rounded-2xl border-[1px] border-solid {{ $task->status === 'DONE' ? 'border-green-700' : 'border-neutral-700' }}">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl {{ $isPast ? 'text-neutral-500' : 'text-neutral-200' }}">
                                        {{ $task->title }}
                                    </h2>
                                    <span
                                        class="py-1 px-2 rounded-2xl text-sm ml-4 {{ $isPast ? 'text-neutral-500 bg-neutral-900' : 'text-neutral-200 bg-neutral-800' }}">
                                        {{ $task->date }} - {{ $task->time }}
                                    </span>
                                </div>
                                <p class="mt-4 {{ $isPast ? 'text-neutral-600' : 'text-neutral-300' }}">
                                    {{ $task->description }}
                                </p>
                                <div class="mt-4 flex justify-end gap-4">
                                    @if ($task->status === 'PENDING')
                                        <form action="{{ route('mark_task_done', ['task' => $task->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-500">
                                                <img src="{{ asset('/svg/check.svg') }}" alt="Ícone de check">
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('delete_task', ['task' => $task->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">
                                            <img src="{{ asset('/svg/trash.svg') }}" alt="Ícone de lixeira">
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>




        </div>
    </div>
</x-layouts.main-layout>
