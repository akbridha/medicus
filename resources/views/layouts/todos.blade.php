
@extends('header')

@section('content')
<div class="container">
    <h1>To-Do List</h1>

    <!-- Add Task Form -->
    <form action="{{ route('todos.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="title" class="form-control" placeholder="New task..." required>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>

    <!-- Task List -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Task</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->is_completed ? 'Completed' : 'Pending' }}</td>
                <td>
                    <!-- Update Task Status -->
                    <form action="{{ route('todos.update', $todo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $todo->is_completed ? 'btn-secondary' : 'btn-success' }}">
                            {{ $todo->is_completed ? 'Undo' : 'Complete' }}
                        </button>
                    </form>

                    <!-- Delete Task -->
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No tasks found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
