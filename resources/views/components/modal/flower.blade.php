@props(['editForm', 'titleForm', 'typeFlower'])
<div>
    <div
        x-data="{ show : false }"
        x-show="show"
        x-on:opencreate-usermodal.window="show = true"
        x-on:close-modal.window="show = false"
        x-transition
        style="display:none;"
        class="fixed z-50 inset-0">
        {{--    Blank   --}}
        <div class="fixed inset-0 bg-gray-300 opacity-40"></div>
        {{--    Form    --}}
        <div class="bg-white rounded-lg m-auto fixed inset-0 max-w-2xl max-h-80 mb-96">
            <div class="relative w-full max-w-2xl h-auto">
                <form wire:submit.prevent="{{ $editForm ? 'update' : 'store' }}"
                      class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $titleForm ?? 'Create User' }}
                        </h3>
                        <button wire:click="close" @click="$dispatch('close-modal')" type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3"
                                 x-data="{ name : 'code', placeholder: 'Type your '}">
                                <label for="code"
                                       x-text="name.charAt(0).toUpperCase() + name.slice(1)"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                <input wire:model="code" type="text" id="code"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :placeholder="placeholder">
                                <x-input-error :messages="$errors->get('code')"/>
                            </div>
                            <div class="col-span-6 sm:col-span-3"
                                 x-data="{ name : 'name', placeholder: 'Type your '}">
                                <label for="code"
                                       x-text="name.charAt(0).toUpperCase() + name.slice(1)"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                <input wire:model="name" type="text" id="code"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :placeholder="placeholder">
                                <x-input-error :messages="$errors->get('name')"/>
                            </div>
                            <div class="col-span-6 sm:col-span-3"
                                 x-data="{ name : 'price', placeholder: 'Type your '}">
                                <label for="code"
                                       x-text="name.charAt(0).toUpperCase() + name.slice(1)"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                <input wire:model="price" type="text" id="code"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :placeholder="placeholder">
                                <x-input-error :messages="$errors->get('price')"/>
                            </div>
                            <div class="col-span-6 sm:col-span-3"
                                 x-data="{ name : 'type', placeholder: 'Type your '}">
                                <label for="code"
                                       x-text="name.charAt(0).toUpperCase() + name.slice(1)"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                @php
                                    $options = [
                                                ['name' => 'normal'],
                                                ['name' => 'additional'],
                                               ];
                                @endphp
                                <x-simple-select
                                    wire:model="type"
                                    name="type"
                                    id="type"
                                    :options="$options"
                                    value-field='name'
                                    text-field='name'
                                    placeholder="Select Type"
                                    search-input-placeholder="Search Type"
                                    :searchable="true"
                                    class="form-select">
                                </x-simple-select>

                                <x-input-error :messages="$errors->get('type')"/>
                            </div>

                        </div>
                    </div>
                    <div
                        class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            @if($editForm)
                                Save
                            @else
                                Create
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
