@extends('layouts.app')

@section('content')

    <h1>Tasks</h1>

    <div class="row">
        <div class="col-12">
            <div class="container">
                <form action="{{ url('/tasks/store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Task Name" value="@php if(!empty($task)) { echo $task->name; } @endphp">
                    </div>
                    <div class="form-group">
                        <label for="priority">Task Priority</label>
                        <input min="1" type="number" class="form-control" id="priority" name="priority" placeholder="Task Priority" value="@php if(!empty($task)) { echo $task->priority; } @endphp">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <div class="container">
                @if (count($tasks) > 0 )

                    <div class="row">
                        <div class="col-1">
                            <h4>Priority</h4>
                        </div>
                        <div class="col-7">
                            <h4>Task Name</h4>
                        </div>
                        <div class="col-4">
                            <h4>Actions</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 ui-sortable" id="sortable">

                            @foreach ($tasks as $task)

                                <section class="ui-state-default ui-sortable-handle card mb-5 p-4" data-id="{{ $task->id }}">
                                    <div class="row">
                                        <div class="col-1">
                                            <p class="priority">{{ $task->priority }}</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $task->name }}</p>
                                        </div>
                                        <div class="col-2">
                                            <form action="/tasks/edit" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $task->id }}">
                                                <button id="{{ $task->id }}" type="submit" class="btn btn-secondary">Edit Task</button>
                                            </form>
                                        </div>
                                        <div class="col-2">
                                            <form action="/tasks/delete" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $task->id }}">
                                                <button type="submit" class="btn btn-danger">Delete Task</button>
                                            </form>
                                        </div>
                                    </div>
                                </section>

                            @endforeach

                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            function updateDB(idString) {
                $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});

                $.ajax({
                    url: "{{ url('/tasks/update') }}",
                    method: "POST",
                    data:{ids:idString},
                    success: function(response) {

                        console.log(response);
                    }
                });
            }

            $('#sortable').sortable({
                item:"section",
                cursor:'move',
                opacity: 0.6,
                update: function(e, ui) {
                    var sortData = $('#sortable').sortable('toArray', { attribute: 'data-id'});
                    updateDB(sortData.join(','));
                }
            });
        });
    </script>
@endsection
