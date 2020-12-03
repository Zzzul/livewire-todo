<?php

namespace App\Http\Livewire;

use App\Models\Todo as ModelsTodo;
use Livewire\Component;

class Todo extends Component
{
    public $title, $description, $dueDate, $editId, $titleEdit, $descriptionEdit, $dueDateEdit, $createdAt, $updatedAt;

    public function render()
    {
        $todos = ModelsTodo::latest()->get();
        return view('livewire.todo', compact('todos'));
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

        $this->showAlert('Yeayy, Congrats Your task is done!');
    }

    public function notFinished($id)
    {
        $todo = ModelsTodo::find($id);
        $todo->finished_on = null;
        $todo->save();

        $this->showAlert('Your task is not finished!');
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
