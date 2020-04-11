@extends('layouts.app')

@section('content')

    <h1>Edit Task</h1>

    <div class="row">
        <div class="col-12">
            <div class="container">
                <form action="{{ url('/tasks/update') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Task Name" value="{{ $task->name }}">
                    </div>
                    <div class="form-group">
                        <label for="priority">Task Priority</label>
                        <input min="1" type="number" class="form-control" id="priority" name="priority" placeholder="Task Priority" value="{{ $task->priority }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
