@props(['fields' => []])

<div x-data="feedbackForm">
    <div x-cloak x-show="open" class="fixed z-50 inset-0 overflow-y-auto text-neutral">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div x-cloak x-show="open" x-transition.duration.opacity.200ms class="fixed inset-0 transition-opacity"
                aria-hidden="true">
                <div class="absolute inset-0 bg-black/40 opacity-75">
                </div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- CONTAINER -->
            <div x-cloak x-show="open" x-transition.scale.duration.300ms
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-11/12 max-w-lg sm:p-6"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                <div class="sm:flex sm:items-start">
                    {{-- <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10 text-2xl">
                        <i class="fa-regular fa-face-smile"></i>
                    </div> --}}

                    <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <!-- HEADER -->
                        <h3 class="mb-4 flex items-center text-lg leading-6 font-semibold" id="modal-headline">
                            Send Feedback
                        </h3>

                        <!-- BODY -->
                        <div class="mt-2">

                            <form action="{{ route('student.feedback.store') }}" method="post"
                                class="flex flex-col gap-y-4">
                                @csrf

                                <p>Tell us how we can improve your experience.</p>

                                <input type="hidden" name="{{ array_keys($fields)[0] }}" value="{{ $fields['type'] }}">

                                <div x-data="starRating">
                                    <x-form.input-label for="rating" :value="__('Rate your experience')" />

                                    <div class="rating rating-lg mt-1 mx-auto flex justify-center gap-x-2">
                                        <input type="radio" name="rating" value="1" x-model="rating"
                                            class="mask mask-star-2 bg-accent" :checked="rating === 1 ? true : false"
                                            required />
                                        <input type="radio" name="rating" value="2" x-model="rating"
                                            class="mask mask-star-2 bg-accent" :checked="rating === 2 ? true : false"
                                            required />
                                        <input type="radio" name="rating" value="3" x-model="rating"
                                            class="mask mask-star-2 bg-accent" :checked="rating === 3 ? true : false"
                                            required />
                                        <input type="radio" name="rating" value="4" x-model="rating"
                                            class="mask mask-star-2 bg-accent" :checked="rating === 4 ? true : false"
                                            required />
                                        <input type="radio" name="rating" value="5" x-model="rating"
                                            class="mask mask-star-2 bg-accent" :checked="rating === 5 ? true : false"
                                            required />
                                    </div>

                                    <x-form.input-error :messages="$errors->get('rating')" class="mt-2" />
                                </div>

                                <div>
                                    <x-form.input-label for="comment" :value="__('Your comment')" />

                                    <textarea id="comment" name="comment"
                                        class="mt-1 w-full h-[1000px] max-h-[200px] resize-none rounded border border-gray-300 shadow"
                                        placeholder="Write a comment" required></textarea>

                                    <x-form.input-error :messages="$errors->get('comment')" class="mt-2" />
                                </div>


                                {{-- <div>
                                    <x-form.select.select-input name="grade_level" id="grade_level"
                                        class="block mt-1 w-full">
                                        <x-form.select.select-option :disabled="true" :selected="true"
                                            :option_name="__('Select grade level')" required s />

                                        <x-form.select.select-option :value="11" :option_name="__('Gr. 11')" />
                                        <x-form.select.select-option :value="12" :option_name="__('Gr. 12')" />
                                    </x-form.select.select-input>

                                    <x-form.input-error :messages="$errors->get('grade_level')" class="mt-2" />
                                </div> --}}

                                {{-- <div>
                                    <x-form.select.select-input name="strand" id="strand" class="block mt-1 w-full">
                                        <x-form.select.select-option :disabled="true" :selected="true"
                                            :option_name="__('Select a strand')" />

                                        @foreach ($strands as $str)
                                            <x-form.select.select-option :value="$str->id" :option_name="$str->abbr" />
                                        @endforeach
                                    </x-form.select.select-input>
                                </div> --}}

                                <div class="flex justify-end">
                                    <button class="flex btn btn-primary font-poppins uppercase">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="mt-5 sm:mt-4 flex flex-col sm:flex-row-reverse gap-3">
                    @isset($action)
                        {{ $action }}
                    @endisset

                    @if ($showCancelBtn)
                        <button @click="open = false" type="button"
                            class="flex btn uppercase font-poppins font-semibold">Cancel</button>
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>
