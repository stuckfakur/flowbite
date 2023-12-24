@props(['editForm', 'titleForm'])
<div>
    <div
        x-data="{ show : false }"
        x-show="show"
        x-on:opencreate-usermodal.window="show = true"
        x-on:close-modal.window="show = false"
        x-transition
        style="display:none;"
        class="fixed z-40 inset-0">
        {{--    Blank   --}}
        <div class="fixed inset-0 bg-gray-300 opacity-40"></div>
        {{--    Form    --}}
        <div class="bg-white rounded-lg m-auto fixed inset-0 max-w-2xl max-h-80 mb-96 mt-12">
            <div class="relative overflow-y-scroll w-full max-w-2xl">
                <form wire:submit.prevent="{{ $editForm ? 'update' : 'store' }}"
                      class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $titleForm ?? 'Create User' }}
                        </h3>
                        <button wire:click="$dispatch('close-modal')" type="button"
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
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-12 md:col-span-12 sm:col-span-12"
                                     x-data="{ label : 'name', placeholder: 'Type your '}">
                                    <label for="name"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <input wire:model="name" type="text" id="name"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           :placeholder="placeholder + label">
                                    <x-input-error :messages="$errors->get('name')"/>
                                </div>
                                <div class="col-span-6 md:col-span-6 sm:col-span-12"
                                     x-data="{ label : 'Start Date', placeholder: 'Type your '}">
                                    <label for="start_date"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>

                                    <div class="relative max-w-sm">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               x-ref="datepicker"
                                               x-init="
                                                            new Pikaday({
                                                                    field: $refs.datepicker,
                                                                    format: 'DD-MM-YYYY',
                                                                    toString(date, format) {
                                                                        const day = String(date.getDate()).padStart(2, 0);
                                                                        const month = String(date.getMonth() + 1).padStart(2, 0);
                                                                        const year = date.getFullYear();
                                                                        return `${year}/${month}/${day}`;
                                                                    },
                                                                    onSelect: function() {
{{--                                                                        console.log(moment(this.getDate()).format('DD-MM-YYYY'));--}}
                                                                        $wire.set('start_date', moment(this.getDate()).format('DD-MM-YYYY'),true);
                                                                    }
                                                                });
                                                                "
                                               wire:model="start_date"
                                               id="datepicker">
                                    </div>

                                    <x-input-error :messages="$errors->get('start_date')"/>
                                </div>
                                <div class="col-span-6 md:col-span-6 sm:col-span-12"
                                     x-data="{ label : 'End Date', placeholder: 'Type your '}">
                                    <label for="end_date"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>

                                    <div class="relative max-w-sm">
                                        <div class="relative max-w-sm">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                     fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <input type="text"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       x-ref="datepicker"
                                                       x-init="
                                                            new Pikaday({
                                                                    field: $refs.datepicker,
                                                                    format: 'DD-MM-YYYY',
                                                                    toString(date, format) {
                                                                        const day = String(date.getDate()).padStart(2, 0);
                                                                        const month = String(date.getMonth() + 1).padStart(2, 0);
                                                                        const year = date.getFullYear();
                                                                        return `${year}/${month}/${day}`;
                                                                    },
                                                                    onSelect: function() {
{{--                                                                        console.log(moment(this.getDate()).format('DD-MM-YYYY'));--}}
                                                                        $wire.set('end_date', moment(this.getDate()).format('DD-MM-YYYY'),true);
                                                                    }
                                                                });
                                                                "
                                                       wire:model="end_date"
                                                       id="datepicker">
                                            </div>


                                        </div>

                                    </div>

                                    <x-input-error :messages="$errors->get('end_date')"/>
                                </div>

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
