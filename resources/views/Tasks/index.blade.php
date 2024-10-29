<div class="my-5">
    <div class="ml-28 my-5">
        <x-href-button href="{{route('tasks.create')}}">Create Task</x-href-button>
    </div>
    <table class="mx-auto w-11/12">
        <thead>
        <tr class="bg-gray-500/15">
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Toggle Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="border-b-2">
                <td style="text-align: center;">{{ $task->title }}</td>
                <td style="text-align: center;">{{ $task->description }}</td>
                <td style="text-align: center;">{{ $task->due_date }}</td>
                <td style="text-align: center;">{{ $task->status }}</td>
                <td style="text-align: center;">

                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST"
                          style="display: inline-block;">
                        @csrf
                        <button id="toggleButton" type="submit"
                                class="w-14 h-6 {{$task->status == 'completed' ? 'bg-blue-500' : 'bg-gray-300'}} rounded-full relative transition-colors duration-300 focus:outline-none">
                            <span id="toggleIndicator"
                                  class="{{$task->status == 'completed' ? 'translate-x-6' : ''}} absolute left-1 top-1 bg-white w-5 h-4 rounded-full transition-transform duration-300"></span>
                        </button>
                    </form>

                </td>
                <td style="text-align: center;">
                    @can('update',$task)
                        <x-href-button href="{{route('tasks.edit', $task->id)}}">Edit</x-href-button>
                    @endcan
                    @can('delete',$task)
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                              style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 h-auto bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900/50 focus:bg-red-900/50 active:bg-red-900/50">
                                Delete
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
