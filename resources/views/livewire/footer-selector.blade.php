@php
    $footers = App\Models\Footer::with(['quicklinks', 'socials', 'currencies'])
        ->orderBy('created_at', 'asc')
        ->get();
@endphp

<div class="bg-white dark:bg-gray-950">
    @foreach ($footers as $footer)
        <div class="bg-[#FACA21] py-5">
            <div class="lg:px-0 px-10 mx-auto max-w-7xl">
                <div class="py-2 px-6 sm:flex sm:justify-between items-center">
                    <!-- 1/3 Section (Quick Links) -->
                    <div class="sm:w-1/4">
                        <h2 class="text-3xl font-bold tracking-tight lg:pb-0 pb-5 text-[#163466] sm:text-4xl">
                            {{ $footer->footer1 }}
                        </h2>
                    </div>
                    <nav class="sm:w-3/4 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <div class="hidden lg:flex lg:gap-x-12">
                            @if ($selectedNavbar == 'top')
                                <ul>
                                    @foreach ($items as $item)
                                        @if ($item->link)
                                            <li>
                                                <a href="{{ $item->link }}" target='_blank'
                                                    class="text-base dark:text-white hover:underline hover:underline-offset-4 font-normal text-white">
                                                    {{ $item->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif

                            @if ($selectedFooter == 'quickLinks')
                                @foreach ($items as $item)
                                    @if ($item->url)
                                        <a href="{{ $item->url }}" target="_blank"
                                            class="flex text-base items-center text-gray-800 font-bold hover:text-gray-900 py-2 px-3">
                                            @if ($item->image_path)
                                                <img src="{{ asset('storage/' . $item->image_path) }}"
                                                    class="w-12 h-12 mr-3" alt="{{ $item->name . ' Image' }}">
                                            @else
                                                <img src="{{ asset('placeholder-image.png') }}" class="w-12 h-12 mr-3"
                                                    alt="Placeholder Image">
                                            @endif
                                            {{ $item->name }}
                                            @if ($item->description)
                                                <span class="text-sm text-gray-600 ml-2">{{ $item->description }}</span>
                                            @endif
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </nav>
                </div>
            </div>
        </div>

        <div class="bg-[#163466]">
            <div class="mx-auto lg:px-0 px-20 max-w-6xl p-6">
                <div class="grid grid-cols-2 mx-auto text-center sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-5">

                    @if ($selectedFooter == 'socials')
                        @foreach ($items as $item)
                            @if ($item->url)
                                <a href="https://www.{{ $item->url }}"
                                    class="flex text-base items-center text-gray-800 font-bold hover:text-gray-900 py-2 px-3">
                                    @if ($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" class="w-12 h-12 mr-3"
                                            alt="{{ $item->name . ' Image' }}">
                                    @else
                                        <img src="{{ asset('placeholder-image.png') }}" class="w-12 h-12 mr-3"
                                            alt="Placeholder Image">
                                    @endif
                                    <h3 class="text-base dark:text-white text-white font-semibold mb-1">
                                        {{ $item->name }}
                                    </h3>
                                    @if ($item->description)
                                        <span class="text-sm text-gray-600 ml-2">{{ $item->description }}</span>
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-6xl lg:px-0 px-10 py-6">
            <div class="flex flex-row justify-center gap-x-20">
                <div class="w-full sm:w-1/2">
                    @if ($selectedFooter == 'columns1')
                        @foreach ($items as $item)
                            <h3 class="text-lg text-[#163466] dark:text-[#FACA21] font-semibold mb-4">
                                {{ $item->column1 }}
                            </h3>
                            <nav class="flex flex-col sm:flex-row justify-between">
                                @foreach ($item->navItem1)
                                    <a href="{{ $item->link }}" target="_blank"
                                        class="text-gray-800 dark:text-white hover:underline hover:underline-offset-4 px-2 py-1">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </nav>
                        @endforeach
                    @endif
                </div>
                <!-- Right Column -->
                <div class="w-full sm:w-1/2 sm:mt-0">
                    @if ($selectedFooter == 'column2')
                        @foreach ($items as $item)
                            <h3 class="text-lg text-[#163466] dark:text-[#FACA21] font-semibold mb-4">
                                {{ $item->column2 }}
                            </h3>
                            <nav class="flex flex-col sm:flex-row justify-between">
                                @foreach ($item->navItem1)
                                    <a href="{{ $item->link }}" target="_blank"
                                        class="text-gray-800 dark:text-white hover:underline hover:underline-offset-4 px-2 py-1">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </nav>
                        @endforeach
                    @endif
                   
                </div>
            </div>
        </div>

        <div class="mx-auto lg:px-0 px-10 max-w-6xl border rounded border-blue-200 dark:border-white">

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

                @if ($selectedFooter == 'currencies')
                    @foreach ($items as $item)
                        <div class="flex items-start text-left p-4">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="Icon 1"
                                class="w-12 h-12 mr-4">
                            <div>
                                <h3 class="text-base dark:text-white font-semibold mb-1">
                                    {{ $item->name }}
                                </h3>
                                <p class="text-base text-[#163466]">
                                    {{ $item->code }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="text-center py-4 dark:text-white text-gray-600">
            <p>&copy; {{ \Carbon\Carbon::now()->format('Y') }} - {{ $footer->footer2 }}</p>
        </div>
    @endforeach
</div>
