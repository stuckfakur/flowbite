@props(['model'])

<div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
    <div class="container mx-auto">
        <div class="mb-5 w-64">
            <label for="datepicker" class="font-bold mb-1 text-gray-700 block">Select Date</label>
            <div class="relative">
                <input wire:model="$model" type="hidden" name="date" x-ref="date" :value="datepickerValue"/>
                <input wire:model="$model" type="text" x-on:click="showDatepicker = !showDatepicker" x-model="datepickerValue"
                       x-on:keydown.escape="showDatepicker = false"
                       class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
                       placeholder="Select date" readonly/>

                <div class="absolute top-0 right-0 px-3 py-2">
                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <!-- <div x-text="no_of_days.length"></div>
                  <div x-text="32 - new Date(year, month, 32).getDate()"></div>
                  <div x-text="new Date(year, month).getDay()"></div> -->

                <div class="bg-white z-50 mt-12 rounded-lg shadow p-4 absolute top-0 left-0" style="width: 17rem"
                     x-show.transition="showDatepicker" @click.away="showDatepicker = false">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div>
                            <button type="button"
                                    class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                    @click="if (month == 0) {
                        year--;
                        month = 12;
                      } month--; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button type="button"
                                    class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                    @click="if (month == 11) {
                        month = 0;
                        year++;
                      } else {
                        month++;
                      } getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-3 -mx-1">
                        <template x-for="(day, index) in DAYS" :key="index">
                            <div style="width: 14.26%" class="px-0.5">
                                <div x-text="day" class="text-gray-800 font-medium text-center text-xs"></div>
                            </div>
                        </template>
                    </div>

                    <div class="flex flex-wrap -mx-1">
                        <template x-for="blankday in blankdays">
                            <div style="width: 14.28%"
                                 class="text-center border p-1 border-transparent text-sm"></div>
                        </template>
                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                            <div style="width: 14.28%" class="p-1 mb-1">
                                <div @click="getDateValue(date)" x-text="date"
                                     class="cursor-pointer text-center text-sm p-2 rounded leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                     :class="{
                      'bg-indigo-200': isToday(date) == true,
                      'text-gray-600 hover:bg-indigo-200': isToday(date) == false && isSelectedDate(date) == false,
                      'bg-indigo-500 text-white hover:bg-opacity-75': isSelectedDate(date) == true
                    }"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
