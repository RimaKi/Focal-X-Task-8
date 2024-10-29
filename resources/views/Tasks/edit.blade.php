<x-app-layout>
    <div class="py-12">
        <div class="max-w-screen-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border border-gray-600/500 p-6 my-6">
                        <h1 class="text-gray-900 font-bold-900 text-2xl my-6">Add Task</h1>

                        <form method="POST" action="{{route('tasks.update',$task->id)}}">
                            @csrf
                            @method('PUT')
                            <!--Title -->
                            <div class="mt-4">
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" class="w-5/6 block mt-1" type="text" name="title" value="{{$task->title}}"
                                              required autocomplete="title"/>
                                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                            </div>

                            <!-- description -->
                            <div class="mt-4">
                                <x-input-label for="description" :value="__('Description')"/>
                                <textarea id="message" rows="3" onchange="this.name = 'description'"
                                          class="block p-2.5 w-5/6 text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Leave a description..." autocomplete="description">{{$task->description}}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

                            <!-- Due Date -->
                            <div class="mt-4">
                                <x-input-label for="due_date" :value="__('Due Date')"/>
                                <x-text-input id="due_date" class="w-1/2 block mt-1" type="date" name="due_date" value="{{$task->due_date}}"
                                              required autocomplete="due_date"/>
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
