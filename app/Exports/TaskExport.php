<?php

namespace App\Exports;

use App\Task;
use Maatwebsite\Excel\Concerns\FromCollection;

class TaskExport implements FromCollection
{
    protected $task;

    public function __construct($task)
    {
        return $this->task = $task;
    }

    public function collection()
    {
        return $this->task;
    }
}
