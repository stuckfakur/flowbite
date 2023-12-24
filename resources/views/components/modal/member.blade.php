@props(['editForm', 'openSelect', 'dayOptions', 'regencyOptions','titleForm', 'getUserId'])
<div>

    <div
            x-data="{ show : false }"
            x-show="show"
            x-on:opencreate-membermodal.window="show = true"
            x-on:close-modal.window="show = false"
            x-transition
            style="display:none;"
            class="fixed z-50 inset-0">

        {{--    Blank   --}}
        <div class="fixed inset-0 bg-gray-300 opacity-40"></div>
        {{--    Form    --}}
        <div class="rounded-lg m-auto fixed inset-0 max-w-2xl max-h-80 mb-96 mt-6">
            <div class="relative overflow-y-scroll w-full max-w-2xl">
                <form wire:submit.prevent="{{ $editForm ? 'update' : 'store' }}"
                      class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-2 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $titleForm ?? 'Create User' }}
                        </h3>
                        <button wire:click="close"
                                @click="$dispatch('close-modal')"
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 space-y-2">
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-12 md:col-span-6 sm:col-span-12"
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

                                <div class="col-span-12 md:col-span-6 sm:col-span-"
                                     x-data="{ label : 'phone', placeholder: 'Type your '}">
                                    <label for="phone"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <input wire:model="phone" type="text" id="phone"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           :placeholder="placeholder + label">
                                    <x-input-error :messages="$errors->get('phone')"/>
                                </div>
                                <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                     x-data="{ label : 'street', placeholder: 'Type your '}">
                                    <label for="street"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <textarea id="street" rows="1"
                                              wire:model="street"
                                              class="block h-auto p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Write the address here ...">
                                    </textarea>
                                    <x-input-error :messages="$errors->get('street')"/>
                                </div>
                                <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                     id="myModal"
                                     x-data="{ label : 'regency', placeholder: 'Type your '}">
                                    <label for="regency"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <div class="mt-1">
                                        <x-simple-select
                                            wire:model="regency_id"
                                            name="regency"
                                            id="regency"
                                            :options="$regencyOptions"
                                            value-field='id'
                                            text-field='name'
                                            placeholder="Select Regency"
                                            search-input-placeholder="Search Regency"
                                            :searchable="true"
                                            class="form-select">
                                            <x-slot name="customOption">
                                                <span class="float-left mr-2 " x-text="option.city"></span>
                                                <span>-</span>
                                                <span x-text="option.name"></span>
                                            </x-slot>
                                        </x-simple-select>
                                    </div>
                                    <x-input-error :messages="$errors->get('regency_id')"/>
                                </div>

                                <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                     x-data="{ label : 'notes', placeholder: 'Type your '}">
                                    <label for="notes"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <textarea id="notes" rows="1"
                                              wire:model="notes"
                                              class="block h-auto p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Write the notes here ...">
                                    </textarea>
                                    <x-input-error :messages="$errors->get('notes')"/>
                                </div>
                            </div>

                        </div>
                        <div class="bg-white shadow-lg rounded-lg px-4 py-1">
                            <div class="grid grid-cols-12 gap-6"
                                 x-data="{ show : false }"
                                 x-on:open-formDay.window=" show = true "
                                 x-on:close-formDay.window=" show = false ">
                                <div class="flex items-end col-span-6 md:col-span-6 sm:col-span-3">
                                    <div class="flex items-end">
                                        <input
                                                @if($editForm)
                                                    :checked="{{\App\Models\Member::find($this->idUser)->subscriber}}"
                                                @endif
                                                wire:model.lazy="subscriber"
                                                @click="show = $event.target.checked; if(!$event.target.checked) { $wire.day_id = 8 }"
                                                id="checked-checkbox" type="checkbox" value="true"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checked-checkbox"
                                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            is Subscribe?
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 md:col-span-6 sm:col-span-3"
                                     id="formDay"
                                     x-data="{ label : 'day', placeholder: 'Type your '}"
                                     @if($editForm)
                                         x-show="show {{\App\Models\Member::find($this->idUser)->subscriber ? '= true' : ''}}"
                                    @endif
                                    @if($openSelect)
                                        x-show="show"
                                    @endif
                                >
                                    <label for="day"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <x-simple-select
                                        wire:model="day_id"
                                        name="day_id"
                                        id="day_id"
                                        :options="$dayOptions"
                                        value-field='id'
                                        text-field='name'
                                        placeholder="Select Day"
                                        search-input-placeholder="Search Day"
                                        :searchable="true"
                                        class="form-select"/>
                                    <x-input-error :messages="$errors->get('day_id')"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                            class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                                @click="$dispatch('close-formDay')"
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

@push('script')
    <script>
        function selectRegency() {

            $('#regency').select2({
                placeholder: "Select an options",
            })
            $('#regency').on('change', function(e) {
                @this.set('regency_id', e.target.value);
            });
        }
    </script>
    <script>
        var streetTextarea = document.querySelector('#street');
        var notesTextarea = document.querySelector('#notes');

        notesTextarea.addEventListener('keydown', autosize);
        streetTextarea.addEventListener('keydown', autosize);

        function autosize() {
            var el = this;
            setTimeout(function () {
                el.style.cssText = 'height:auto; padding-top: 16px; padding-bottom: 8px';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
            }, 0);
        }
    </script>


@endpush
