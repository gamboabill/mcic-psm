<div>
    <div x-data="{ open: @entangle('openAddModal') }" x-cloak @keyup.escape.window="open = false">

        <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

            <div @click.outside="$wire.set('openAddModal', false)" x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-50 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-50 translate-y-8"
                class="bg-white p-6 rounded-lg w-full max-w-lg">

                <h2 class="text-xl font-bold mb-4">Add Department</h2>
                <div class="fakefiller-allow">
                    <div class="space-y-3">
                        <div>
                            <label>Project Name</label>
                            <input type="text" wire:model="name"
                                class="w-full border rounded p-2 @error('name') border-red-600 @else border-gray-300 @enderror transition duration-200 ">
                            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label>latitude</label>
                            <input type="text" wire:model="latitude"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                class="w-full border rounded p-2 @error('latitude') border-red-600 @else border-gray-300 @enderror transition duration-200">
                            @error('latitude') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label>longitude</label>
                            <input type="text" wire:model="longitude"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                class="w-full border rounded p-2 @error('longitude') border-red-600 @else border-gray-300 @enderror transition duration-200">
                            @error('longitude') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label>Description</label>
                            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-5 flex justify-end gap-3">

                    <button wire:click="$set('openAddModal', false)"
                        class="px-3 py-2 rounded text-white bg-gray-500 hover:bg-gray-700 transition duration-200">Cancel</button>

                    <button wire:click="saveProject"
                        class="px-3 py-2 rounded text-white bg-blue-500 hover:bg-blue-700 transition duration-200">Add
                        Project</button>

                </div>
            </div>
        </div>

    </div>
</div>