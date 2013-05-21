@extends('layouts.scaffold')

@section('main')

<h1>Show Todo</h1>

<p>{{ link_to_route('todos.index', 'Return to all todos') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Title</th>
				<th>Done</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $todo->title }}</td>
					<td>{{ $todo->done }}</td>
                    <td>{{ link_to_route('todos.edit', 'Edit', array($todo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('todos.destroy', $todo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
        </tr>
    </tbody>
</table>

@stop