<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{

    public function store_task(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i',
            ],
            [
                'title.required' => 'O título da tarefa é obrigatório.',
                'title.string' => 'O título da tarefa deve ser um texto.',
                'title.max' => 'O título da tarefa deve conter no máximo 255 caracteres.',

                'description.required' => 'A descrição da tarefa é obrigatória.',
                'description.string' => 'A descrição da tarefa deve ser um texto.',
                'description.max' => 'A descrição da tarefa deve conter no máximo 255 caracteres.',

                'date.required' => 'A data da tarefa é obrigatória.',
                'date.date' => 'A data da tarefa deve ser uma data válida.',

                'time.required' => 'A hora da tarefa é obrigatória.',
                'time.date_format' => 'A hora da tarefa deve estar no formato HH:MM.',
            ]
        );

        $taskDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);

        if ($taskDateTime <= Carbon::now()) {
            return redirect()->back()
                ->withErrors(['task' => 'A data e hora da tarefa não podem ser antes do dia de hoje.'])
                ->withInput();
        }

        $taskDateExists = Task::where("user_id", Auth::id())
            ->where("date", $request->date)
            ->where("time", $request->time)
            ->first();

        if ($taskDateExists) {
            return redirect()->back()
                ->withErrors(['task' => 'Já existe uma tarefa agendada para esse dia e horário.'])
                ->withInput();
        }

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->date = $request->date;
        $task->time = $request->time;
        $task->user_id = Auth::id();

        $task->save();

        return redirect()->route('home');
    }

    public function destroy(int $id): RedirectResponse
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $task->delete();

        return redirect()->route('home')->with('success', 'Tarefa excluída com sucesso.');
    }

    public function task_done(int $id): RedirectResponse
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $task->status = 'DONE';
        $task->save();

        return redirect()->route('home')->with('success', 'Tarefa marcada como concluída.');
    }
}
