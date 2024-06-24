<div>
    <!-- Page Selection -->
    <div>
        <label for="page-select">Select Page:</label>
        <select wire:model="selectedPageId" id="page-select">
            @foreach($pages as $page)
                <option value="{{ $page->id }}">{{ $page->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Page Title -->
    <h1>{{ $page->title }}</h1>

    <!-- Media Upload Form -->
    <form wire:submit.prevent="uploadMedia">
        <select wire:model="mediaType">
            <option value="" selected>Select Media Type</option>
            <option value="page">Page</option>
            <option value="pagesection">Pagesection</option>
            <option value="pagecontent">Pagecontent</option>
        </select>

        @if($mediaType === 'pagesection')
            <select wire:model="selectedPagesectionId">
                <option value="" selected>Select Pagesection</option>
                @foreach($pagesections as $pagesection)
                    <option value="{{ $pagesection->id }}">{{ $pagesection->title }}</option>
                @endforeach
            </select>
        @endif

        @if($mediaType === 'pagecontent' && $selectedPagesection)
            <select wire:model="selectedPagecontentId">
                <option value="" selected>Select Pagecontent</option>
                @foreach($selectedPagesection->pagecontents as $pagecontent)
                    <option value="{{ $pagecontent->id }}">{{ $pagecontent->content }}</option>
                @endforeach
            </select>
        @endif

        <input type="file" wire:model="media">
        @error('media') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Upload Media</button>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ($page->media)
        <img src="{{ Storage::url($page->media) }}" alt="Page Media">
    @endif

    <!-- List of Pagesections -->
    <div class="pagesections">
        <ul>
            @foreach($pagesections as $pagesection)
                <li>
                    <a href="#" wire:click.prevent="updateSelectedPagesection({{ $pagesection->id }})">
                        {{ $pagesection->title }}
                    </a>
                    @if ($pagesection->media)
                        <img src="{{ Storage::url($pagesection->media) }}" alt="Pagesection Media">
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Selected Pagesection Content -->
    <div class="pagesection-content">
        @if($selectedPagesection)
            <h2>{{ $selectedPagesection->title }}</h2>
            <p>{{ optional($selectedPagesection->pagecontents->first())->content ?? 'No content available.' }}</p>
            @if ($selectedPagesection->pagecontents && $selectedPagesection->pagecontents->first()->media)
                <img src="{{ Storage::url($selectedPagesection->pagecontents->first()->media) }}" alt="Pagecontent Media">
            @endif
        @else
            <p>Select a pagesection to view its content.</p>
        @endif
    </div>
</div>

<!-- Optionally, include styles for better presentation -->
<style>
    .pagesections ul {
        list-style-type: none;
        padding: 0;
    }
    .pagesections li {
        display: inline;
        margin-right: 10px;
    }
    .pagesection-content {
        margin-top: 20px;
    }
    .error {
        color: red;
    }
    .alert {
        margin-top: 20px;
        padding: 10px;
        background-color: #4caf50;
        color: white;
    }
</style>

	.alert {
    	margin-top: 20px;
    	padding: 10px;
    	background-color: #4caf50;
    	color: white;
	}
</style>

