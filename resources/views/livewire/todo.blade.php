<div class="container">
    <div class="row justify-content-md-center">

        <div class="col-md-6">
            {{-- form create --}}
            <form wire:submit.prevent="store">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="Learn Livewire">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror"
                        rows="6" id="description" placeholder="Make Simple TODO using laravel + livewire"></textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="due-date">Due Date</label>
                    <input wire:model="dueDate" type="date" id="due-date"
                        class="form-control @error('dueDate') is-invalid @enderror" placeholder="Due Date">
                    @error('dueDate')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-primary btn-block" type="submit">
                    <i class="fas fa-plus mr-1"></i>
                    Submit
                </button>
            </form>

            <hr class="my-4 shadow-sm">

            <h4 class="text-center my-4 font-weight-bold">Todo List</h4>

            {{-- search --}}
            <form class="mb-4">
                <div class="form-group row">
                    <div class="col-md-9">
                        <label for="order-by">Order By</label>
                        <select class="form-control" wire:model="orderBy" id="order-by">
                            <option value="1">Created At (DESC)</option>
                            <option value="2">Created At (ASC)</option>
                            <option value="3">Due Date (DESC)</option>
                            <option value="4">Due Date (ASC)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="paginate">Paginate</label>
                        <select class="form-control" wire:model="paginate" id="paginate">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input wire:model="search" type="text" class="form-control" placeholder="Search..">
                </div>
            </form>

            {{-- edit --}}
            @forelse ($todos as $todo)
            <form wire:submit.prevent="update('{{ $editId }}')">
                <div class="card mb-3 shadow-sm my-card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-md-9">
                                {{-- show form on edit icon click --}}
                                @if ($editId == $todo->id)
                                <div class="form-group">
                                    <input wire:model="titleEdit" type="text"
                                        class="form-control float-left mb-0 @error('titleEdit') is-invalid @enderror"
                                        id="title" placeholder="Title">
                                    @error('titleEdit')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @else
                                <h5 class="card-title float-left mb-0"
                                    style="{{ $todo->finished_on ?  "text-decoration : line-through;": 'none' }}">
                                    {{ $todo->title }}</h5>
                                @endif
                            </div>

                            {{-- button action --}}
                            <div class=" col-md-3">
                                <div class="float-right mb-0">
                                    @if ($todo->finished_on)
                                    <i wire:click="notFinished('{{ $todo->id }}')"
                                        class="fas fa-backspace text-warning mr-2" style="cursor: pointer"></i>
                                    @else
                                    {{-- <i class="fas fa-spinner text-primary mr-2" style="cursor: pointer"></i> --}}
                                    <i wire:click="done('{{ $todo->id }}')" class="fas fa-check text-success mr-2"
                                        style="cursor: pointer"></i>
                                    @endif
                                    <i wire:click="edit('{{ $todo->id }}')" class="fas fa-pencil-alt text-info mr-2"
                                        style="cursor: pointer"></i>
                                    <i wire:click="destroy('{{ $todo->id }}')" class="far fa-trash-alt text-danger mr-2"
                                        style="cursor: pointer"></i>
                                </div>
                            </div>
                        </div>
                        {{-- end of row --}}
                    </div>
                    {{-- end of card-header --}}
                    <div class="card-body">
                        @if ($editId == $todo->id)
                        {{-- edit form --}}
                        <div class="form-group">
                            <textarea wire:model="descriptionEdit"
                                class="form-control @error('descriptionEdit') is-invalid @enderror" rows="6"
                                id="description" placeholder="Description"></textarea>
                            @error('descriptionEdit')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input wire:model="dueDateEdit" type="date" id="due-date"
                                class="form-control @error('dueDateEdit') is-invalid @enderror">
                            @error('dueDateEdit')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="float-left">
                            <small class="text-secondary">
                                Created At : {{ $createdAt->diffForHumans() }}
                            </small>
                            <br>
                            <small class="text-secondary">
                                Updated At : {{ $updatedAt->diffForHumans() }}
                            </small>
                        </div>
                        <div class="float-right">
                            <button wire:click="emptyEdit" class="btn btn-dark" type="button">
                                <i class="far fa-times-circle mr-1"></i>
                                Cancel
                            </button>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save mr-1"></i>
                                Update
                            </button>
                        </div>

                        @else
                        <p style="{{ $todo->finished_on ?  "text-decoration : line-through;": 'none' }}">
                            {{-- {!! nl2br($todo->description) !!} --}}
                            {{ $todo->description }}
                        </p>
                        <small class="text-secondary float-left">
                            Due Date : {{ date('d F Y', strtotime($todo->due_date)) }}
                        </small>
                        @if ($todo->finished_on)
                        <small class="text-secondary float-right">
                            Finished At : {{ date('d F Y', strtotime($todo->finished_on)) }}
                        </small>
                        @endif
                        @endif

                    </div>
                    {{-- end of card-body --}}
                </div>
                {{-- end of card--}}
                @empty
                <h4 class="text-center text-secondary">No Tasks..</h4>
                @endforelse
            </form>
            <div class="d-flex justify-content-between mt-4 mb-0">
                <div>
                    Showing {{ count($todos) }} of {{ count($totalTodo) }} entries
                </div>
                {{ $todos->links() }}
            </div>
        </div>
        {{-- end of col --}}
    </div>
</div>
