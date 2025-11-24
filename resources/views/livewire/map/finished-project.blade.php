<section>
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

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">No departments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>

        <livewire:map.add-modal />


    </section>
</section>