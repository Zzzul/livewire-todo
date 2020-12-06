<?php

namespace App\Http\Livewire;

use App\Models\Todo as ModelsTodo;
use Livewire\Component;
use Livewire\WithPagination;

class Todo extends Component
{
    use WithPagination;

    public $title, $description, $dueDate, $editId, $titleEdit, $descriptionEdit, $dueDateEdit, $createdAt, $updatedAt, $search;

    public $paginate = 5;
    public $orderBy = 1;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->orderBy == 1) {
            $coloumn = 'created_at';
            $type = 'desc';
        } elseif ($this->orderBy == 2) {
            $coloumn = 'created_at';
            $type = 'asc';
        } elseif ($this->orderBy == 3) {
            $coloumn = 'due_date';
            $type = 'desc';
        } else {
            $coloumn = 'due_date';
            $type = 'asc';
        }

        $todos = ModelsTodo::where('title', 'like', '%' . $this->search . '%')->orWhere('description', 'like', '%' . $this->search . '%')->orderBy($coloumn, $type)->paginate($this->paginate);
        $totalTodo = ModelsTodo::get();
        return view('livewire.todo', compact('todos', 'totalTodo'));
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'dueDate' => 'required',
        ]);

        ModelsTodo::create([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->dueDate,
        ]);

        $this->showAlert('TODO Created Successfully!');

        $this->emptyItem();
    }

    public function edit($id)
    {
        $this->editId = $id;
        // dd($this->editId);
        $todo = ModelsTodo::find($id);
        $this->titleEdit = $todo->title;
        $this->descriptionEdit = $todo->description;
        $this->dueDateEdit = $todo->due_date;
        $this->createdAt = $todo->created_at;
        $this->updatedAt = $todo->updated_at;
    }

    public function update($id)
    {

        $this->validate([
            'titleEdit' => 'required|min:3',
            'descriptionEdit' => 'required',
            'dueDateEdit' => 'required',
        ]);

        $todo = ModelsTodo::find($id);
        $todo->title = $this->titleEdit;
        $todo->description = $this->descriptionEdit;
        $todo->due_date = $this->dueDateEdit;
        $todo->save();

        $this->showAlert('TODO Updated Successfully!');

        $this->emptyEdit();
    }

    public function destroy($id)
    {
        ModelsTodo::destroy($id);
        $this->showAlert('TODO Deleted Successfully!');
    }

    public function done($id)
    {
        $todo = ModelsTodo::find($id);
        $todo->finished_on = date('Y-m-d');
        $todo->save();

        $this->showAlert('Yeayy, Congrats your task is done!');
    }

    public function notFinished($id)
    {
        $todo = ModelsTodo::find($id);
        $todo->finished_on = null;
        $todo->save();

        $this->showAlert('Your task is not finish!');
    }

    public function emptyItem()
    {
        $this->title = '';
        $this->dueDate = '';
        $this->description = '';
    }

    public function emptyEdit()
    {
        $this->validate([
            'titleEdit' => '',
            'descriptionEdit' => '',
            'dueDateEdit' => '',
        ]);

        $this->editId = '';
        $this->createdAt = '';
        $this->updatedAt = '';
        $this->titleEdit = '';
        $this->dueDateEdit = '';
        $this->descriptionEdit = '';
    }

    public function showAlert($message)
    {
        $this->alert('success', $message, [
            'position'          =>  'top',
            'timer'             =>  1500,
            'toast'             =>  true,
            'showCancelButton'  =>  false,
            'showConfirmButton' =>  false
        ]);
    }
}
