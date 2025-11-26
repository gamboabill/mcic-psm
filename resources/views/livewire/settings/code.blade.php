<section class="w-full">
    @include('partials.settings-heading')

    @if(session('success'))
    <x-alert type="success" message="{{ session('success') }}" timeout="5000">
    </x-alert>
    @endif

    @if(session('error'))
    <x-alert type="error" message="{{session('error')}}" timeout="5000">
    </x-alert>
    @endif

    <x-settings.layout>


        @if($count > 0)

        <h1>Code Registered</h1>
        <div class="mt-2">
            <button class=" px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-700 transition duration-200">
                Change
            </button>

            <button wire:click="removeCode({{$id}})"
                class="px-3 py-1 rounded bg-red-500 text-white hover:bg-red-700 transition duration-200">
                Remove
            </button>
        </div>

        @else

        <div>
            <label for="">Delection Code</label>
            <input wire:model="code" type="password" class="w-full border rounded p-2 border-gray-500"
                placeholder="enter deletion code.">
        </div>

        <div>
            <button wire:click="saveCode"
                class=" px-5 py-2 mt-2 rounded-md bg-blue-500 text-white  hover:bg-blue-700 hover:text-white transition duration-200">
                Save</button>
        </div>


        @endif

    </x-settings.layout>

</section>