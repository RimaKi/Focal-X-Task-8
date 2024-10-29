<h1>Welcom {{$name}}</h1>
<p>Here is the list of your pending tasks for today:</p>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
