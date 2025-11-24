@section('title', config('app.name').' |'.' '.$title)

<section>

    @if(session('success'))
    <x-alert type="success" message="{{ session('success') }}" timeout="5000">
    </x-alert>
    @endif

    @if(session('error'))
    <x-alert type="error" message="{{session('error')}}" timeout="5000">
    </x-alert>
    @endif

    <div class="flex justify-between item-center mb-4">
        <h1 class="text-2xl font-bold">{{$title}}</h1>
    </div>

    <hr>

    <button wire:click="openAddModal" class="px-2 py-2 mt-4 rounded text-white bg-blue-500 hover:bg-blue-700">
        <i class="fa fa-plus-circle"></i> Add Project Location
    </button>

    <table class="min-w-full border border-gray-300 mt-5">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Project Name</th>
                <th class="border px-4 py-2">Latitude</th>
                <th class="border px-4 py-2">longitude</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2 w-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td class="border px-4 py-2">{{ $projects->firstItem() + $loop->index }}</td>
                <td class="border px-4 py-2">{{ $project->name }}</td>
                <td class="border px-4 py-2">{{ $project->latitude }}</td>
                <td class="border px-4 py-2">{{ $project->longitude }}</td>
                <td class="border px-4 py-2">{{ $project->description }}</td>
                <td class="border px-4 py-2">
                    <center>
                        <div class="flex items-center space-x-2">

                            <div x-data="{ open: false }" class="relative inline-block">
                                <button @mouseenter="open = true" @mouseleave="open = false"
                                    class="px-2 py-1 rounded text-blue-500 bg-transparent hover:bg-blue-700 hover:text-white transition duration-200">
                                    <i class="fa fa-edit justify-center" title="Edit"></i>
                                </button>

                                <div x-show="open" x-transition
                                    class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
                                    Edit
                                </div>
                            </div>

                            <div class="h-5 border-l"></div>

                            <div x-data="{ open: false }" class="relative inline-block">
                                <button wire:click="openFinishModal({{ $project->id }})" @mouseenter="open = true"
                                    @mouseleave="open = false"
                                    class="px-2 py-1 rounded text-green-500 bg-transparent hover:bg-green-700 hover:text-white transition duration-200">
                                    <i class="fa fa-circle-check" title="Finish"></i>
                                </button>
                                <div x-show="open" x-transition
                                    class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
                                    Finish
                                </div>
                            </div>

                            <div class="h-5 border-l"></div>

                            <div x-data="{ open: false }" class="relative inline-block">
                                <button @mouseenter="open = true" @mouseleave="open = false"
                                    class="px-2 py-1 rounded text-red-500 bg-transparent hover:bg-red-700 hover:text-white transition duration-200"
                                    title="Trash">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div x-show="open" x-transition
                                    class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded px-2 py-1">
                                    Delete
                                </div>
                            </div>

                        </div>

                    </center>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="border px-4 py-2 text-center">No departments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>

    <livewire:map.add-modal />

    <livewire:map.finish-modal />


</section>