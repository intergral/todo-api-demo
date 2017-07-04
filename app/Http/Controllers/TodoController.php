<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Transformers\TodoTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $collection = Todo::all();

        return fractal()->collection($collection)->transformWith(TodoTransformer::class)->respond();
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'due_at' => 'numeric'
        ]);

        $todo = new Todo;
        $todo->completed = false;
        $todo->name = request()->get('name');

        if(request()->has('due_at')) {
            $todo->due_at = Carbon::createFromTimestampUTC(request()->get('due_at'));
        }

        $todo->save();

        return fractal()->item($todo)->transformWith(TodoTransformer::class)->respond(201);
    }

    public function show($todo)
    {
        $item = Todo::find($todo);

        return fractal()->item($item)->transformWith(TodoTransformer::class)->respond();
    }

    public function update($todo)
    {

    }

    public function destroy($todo)
    {

    }
}
