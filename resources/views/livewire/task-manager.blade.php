<div class="task-manager">
    <div class="header">
        <h1 class="title">My Task Manager</h1>
        <p class="subtitle">Stay organized and productive</p>
    </div>

    <div class="task-form-container">
        <div class="card">
            <h2 class="card-title">{{ $editTaskId ? 'Edit Task' : 'Add New Task' }}</h2>
            <form wire:submit.prevent="{{ $editTaskId ? 'updateTask' : 'addTask' }}" class="task-form">
                <div class="form-group">
                    <label for="title">Task Title</label>
                    <input
                        type="text"
                        wire:model="title"
                        id="title"
                        placeholder="What needs to be done?"
                        class="form-input"
                    >
                    @error('title') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        wire:model="description"
                        id="description"
                        placeholder="Add details..."
                        class="form-textarea"
                    ></textarea>
                </div>

                <button type="submit" class="submit-button">
                    <span>{{ $editTaskId ? 'Update Task' : 'Add Task' }}</span>
                </button>

                @if($editTaskId)
                    <button type="button" wire:click="cancelEdit" class="submit-button" style="background-color: #ccc; margin-left: 10px;">
                        Cancel
                    </button>
                @endif
            </form>
        </div>
    </div>

    <div class="task-list-container">
        <h2 class="section-title">Your Tasks</h2>

        @if(count($tasks) > 0)
            <div class="task-list">
                @foreach($tasks as $task)
                    <div class="task-card">
                        <div class="task-header">
                            <h3 class="task-title">{{ $task->title }}</h3>
                            <div class="task-actions">
                                <button class="icon-button" wire:click="editTask({{ $task->id }})" title="Edit">
                                    ✏️
                                </button>
                                <button class="icon-button" wire:click="deleteTask({{ $task->id }})" title="Delete" onclick="return confirm('Are you sure?')">
                                    🗑️
                                </button>
                            </div>
                        </div>
                        <p class="task-description">{{ $task->description }}</p>
                        <div class="task-footer">
                            <span class="task-date">Created: {{ $task->created_at->timezone('Asia/Karachi')->format('M d, Y h:i A') }}</span>
                        </div>
                        <div class="task-footer">
                            <span class="task-date">updated :{{  \Carbon\Carbon::parse($task->updated_at)->timezone('Asia/Karachi')->format('M d, Y h:i A') }}
                       </span>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                <h3>No tasks yet</h3>
                <p>Add your first task to get started!</p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('taskAdded', function () {
            alert('Task added successfully!');
        });
        Livewire.on('taskUpdated', function () {
            alert('Task updated successfully!');
        });
        Livewire.on('taskDeleted', function () {
            alert('Task deleted successfully!');
        });
    });
</script>
