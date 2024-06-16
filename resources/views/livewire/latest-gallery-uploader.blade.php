<div class="bg-white bg-center py-12 sm:py-16">
    <div class="mx-auto lg:px-0 px-10 max-w-5xl">
        <div class="mx-auto flex flex-col items-center sm:flex-row sm:justify-between mb-8">
            <h2 class="text-3xl font-bold tracking-tight lg:pb-0 pb-5 text-gray-900 sm:text-3xl">Latest Gallery</h2>
            <a href="{{ url('latest-gallery') }}"
                class="text-gray-900 bg-white hover:bg-[#163466] border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                View More
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        <div class="mx-auto grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-4 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            @foreach ($gallery as $galla)
                <article data-aos="fade-up" data-aos-duration="1500"
                    class="relative isolate flex flex-col transition-transform transform hover:scale-105 justify-end overflow-hidden rounded-2xl bg-gray-900 px-4 pb-8 pt-44 sm:pt-60 lg:pt-48">
                    <a href="{{ $galla->link }}{{ $galla->id }}" class="absolute inset-0 z-10">
                        <span class="sr-only">Go to {{ $galla->title }}</span>
                    </a>
                    <video autoplay muted loop class="absolute inset-0 -z-10 h-full w-full object-cover">
                        <source src="{{ Storage::url($galla->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-black via-gray-900/50"></div>
                    <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    <img src="{{ asset('video.svg') }}"
                        class="absolute text-yellow top-2/3 mb-8 left-1/2 transform -translate-x-1/2 -translate-y-28 h-12 w-12 fill-white"
                        alt="">
                    <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-white">
                        <time datetime="{{ $galla->created_at->format('Y-m-d') }}"
                            class="text-white mr-6">{{ $galla->created_at->format('M d, Y') }}</time>
                        <div class="-ml-4 flex items-center gap-x-2">
                            <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white">
                                <circle cx="1" cy="1" r="1" />
                            </svg>
                            <div class="flex text-white">
                                Views {{ $galla->views ?? '0' }}
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-1 text-sm font-normal leading-6 text-white">
                        <a href="{{ route('gallery.show', $galla->id) }}">
                            <span class="absolute inset-0"></span>
                            {{ $galla->description }}
                        </a>
                    </h3>
                    <div
                        class="flex mt-2 flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">
                        <svg width="16" height="16" class="mr-6" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9843 6.03574L12.9849 6.03637C14.1009 7.1464 14.1 8.94721 12.9856 10.0497L12.9843 10.051L10.0583 12.977C10.0581 12.9772 10.0579 12.9774 10.0578 12.9775C8.94073 14.088 7.13835 14.087 6.02904 12.9777L3.00904 9.95766C2.44299 9.39161 2.14392 8.60986 2.17965 7.80879C2.17965 7.80862 2.17966 7.80845 2.17967 7.80828L2.33958 4.47676C2.33959 4.47664 2.3396 4.47652 2.3396 4.47639C2.39784 3.32107 3.32053 2.39861 4.48166 2.34636L4.48265 2.34632L7.81599 2.18632L7.81739 2.18625C8.61514 2.14457 9.39685 2.44829 9.9643 3.01574L12.9843 6.03574ZM4.08 6.33337C4.08 7.57746 5.08924 8.5867 6.33334 8.5867C7.57743 8.5867 8.58667 7.57746 8.58667 6.33337C8.58667 5.08927 7.57743 4.08003 6.33334 4.08003C5.08924 4.08003 4.08 5.08927 4.08 6.33337Z"
                                fill="#FACA22" stroke="#FACA22" stroke-width="0.666667" />
                        </svg>
                        <div class="-ml-4 flex items-center gap-x-2">
                            <div class="flex text-white gap-x-2">
                                Likes {{ $galla->likes }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button wire:click=""
                            class="text-white bg-{{ $galla->is_featured ? 'yellow' : '' }}-500 hover:bg-{{ $galla->is_featured ? 'yellow' : '' }}-700 font-bold py-2 px-4 rounded">
                            {{ $galla->is_featured ? 'Featured' : '' }}
                        </button>
                    </div>
                    {{-- <div class="mt-2">
                        <button wire:click=" toggleFeatured({{ $galla->id }})"
                            class="text-white bg-{{ $galla->featured ? 'yellow' : 'gray' }}-500 hover:bg-{{ $galla->featured ? 'yellow' : 'gray' }}-700 font-bold py-2 px-4 rounded">
                            {{ $galla->featured ? 'Unfeature' : 'Feature' }}
                        </button>
                    </div> --}}
                </article>
            @endforeach
        </div>
    </div>
</div>
