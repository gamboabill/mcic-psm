<div wire:ignore.self x-data="{ open: @entangle('openUploadModal') }" x-cloak
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="deleteProject" @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openUploadModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <h2 class="text-lg font-bold mb-3">File Uploads</h2>
            <div class="space-y-3">

                <x-inputs.input type="file" name="file" label="File" />

                <div class="w-full">
                    <label for="Category" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                        Category
                    </label>
                    <select wire:model="category" class="w-full px-4 py-2 border text-gray-900 dark:text-gray-100 bg-gray-100
                    dark:bg-gray-700 @error('category') border-red-500 @else border-gray-300 dark:border-gray-600
                    @enderror rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 placeholder-gray-400
                    dark:placeholder-gray-500 transition">
                        <option value="">Select file category</option>
                        <option value="Document">📁 Document</option>
                        <option value="Image">🖼️ Image</option>
                    </select>
                    @error('category') <p class="text-red-500 text-sm"> <i
                            class="fa fa-triangle-exclamation text-xs"></i>
                        {{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4 flex justify-end space-x-2">

                    <x-buttons.button action="$set('openUploadModal', false)" type="outline" label="Cancel" />

                    <x-buttons.button action="uploadFile" type="primary" label="Upload" />

                </div>

            </div>

        </div>
    </div>
</div>