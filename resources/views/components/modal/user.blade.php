@props(['editForm', 'titleForm', 'getUserId'])
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
        <div class="bg-white rounded-lg m-auto fixed inset-0 max-w-2xl max-h-80 mb-96 mt-6">
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
                    <div class="p-4 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-2">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3"
                                     x-data="{ label : 'email', placeholder: 'Type your '}">
                                    <label for="email"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <input wire:model="email" type="email" id="email"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           :placeholder="placeholder + label">
                                    <x-input-error :messages="$errors->get('email')"/>
                                </div>
                                <div class="col-span-6 sm:col-span-3"
                                     x-data="{ label : 'password', placeholder: 'Type your '}">
                                    <label for="password"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <input wire:model="password" type="password" id="password"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           :placeholder="placeholder + label">
                                    <x-input-error :messages="$errors->get('password')"/>
                                </div>

                            </div>
                        </div>
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
                                    <input wire:model="street" type="text" id="street"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           :placeholder="placeholder + label">
                                    <x-input-error :messages="$errors->get('street')"/>
                                </div>
                                <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                     x-data="{ label : 'regency', placeholder: 'Type your '}">
                                    <label for="regency"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <select wire:model="regency_id"
                                            id="regency"
                                            data-placeholder="Select a City"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option></option>
                                        @foreach(\App\Models\Regency::orderBy('city')->get() as $regency)
                                            @php
                                                $oldRegencyId = old('regency_id', ($this->idUser ? \App\Models\User::find($this->idUser)->regency_id : ''));
                                                $isSelected = ($oldRegencyId == $regency->id);
                                            @endphp

                                            <option value="{{ $regency->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $regency->name }}, {{ $regency->city }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('regency_id')"/>
                                </div>
                                <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                     x-data="{ label : 'notes', placeholder: 'Type your '}">
                                    <label for="notes"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <textarea id="message" rows="2"
                                              wire:model="notes"
                                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Write your thoughts here...">
                                    </textarea>
                                    <x-input-error :messages="$errors->get('notes')"/>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            <div class="grid grid-cols-12 gap-6"
                                 x-data = "{ show : false }"
                                 x-on:open-formDay.window = " show = true "
                                 x-on:close-formDay.window = " show = false ">
                                <div class="flex items-end col-span-6 md:col-span-6 sm:col-span-3">
                                            <span class="flex items-end">
                                            <input wire:model="subscriber" @click="show = $event.target.checked; if(!$event.target.checked) { $wire.day_id = 0 }" id="bordered-checkbox-1" type="checkbox"
                                                   value="true"
                                                   name="bordered-checkbox"
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="bordered-checkbox-1"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">is
                                                Subscriber?</label>
                                            </span>
                                </div>
                                <div class="col-span-6 md:col-span-6 sm:col-span-3"
                                     id="formDay"
                                     x-data="{ label : 'day', placeholder: 'Type your '}"
                                     x-show="show"
                                     style="display: none;">

                                    <label for="day"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <select wire:model="day_id"
                                            id="day"
                                            data-placeholder="Select a City"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="0" disabled>Select Day Subscribe</option>
                                        @foreach(\App\Models\Day::whereBetween('id', [1,7])->get() as $day)
                                            @php
                                            if ($editForm){
                                                $oldDayId = old('day_id', ($this->idUser ? \App\Models\User::find($this->idUser)->day_id : ''));
                                                $isSelected = ($oldDayId == $day->id);
                                            }
                                            @endphp

                                            <option
                                                value="{{ $day->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $day->name }}
                                            </option>
                                        @endforeach

                                    </select>
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


    <div
        x-data="{ show : false }"
        x-show="show"
        x-on:opendelete-usermodal.window="show = true"
        x-on:close-modal.window="show = false"
        x-on:keydown.escape.window="show = false"
        x-transition
        style="display:none;"
        class="fixed z-50 inset-0">
        {{--    Blank   --}}
        <div class="fixed inset-0 bg-gray-300 opacity-40"></div>
        {{--    Delete   --}}
        <div class="fixed inset-0 m-auto p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button @click="$dispatch('close-modal')" type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete this product?</h3>
                    <button wire:click="delete" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Yes, I'm sure
                    </button>
                    <button @click="$dispatch('close-modal')" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scriptzz')
    <script>

    </script>
@endpush
