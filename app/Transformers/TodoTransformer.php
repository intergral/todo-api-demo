<?php

namespace App\Transformers;

use App\Todo;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param \App\Todo $todo
     *
     * @return array
     */
    public function transform(Todo $todo)
    {
        return [
            'id' => $todo->id,
            'title' => $todo->name,
            'completed' => (boolean) $todo->completed,
            'due_at' => isset($todo->due_at) ? $todo->due_at->timestamp : null,
        ];
    }
}
