<div>
    <!-- Main Page Title -->
    <h1>{{ $mainPage->title }}</h1>

    <!-- Media Upload Form -->
    <form wire:submit.prevent="uploadMedia">
        <select wire:model="mediaType">
            <option value="" selected>Select Media Type</option>
            <option value="mainPage">Main Page</option>
            <option value="subpage">Subpage</option>
            <option value="pageContent">Page Content</option>
        </select>

        @if ($mediaType === 'subpage')
            <select wire:model="selectedSubpageId">
                <option value="" selected>Select Subpage</option>
                @foreach ($subpages as $subpage)
                    <option value="{{ $subpage->id }}">{{ $subpage->title }}</option>
                @endforeach
            </select>
        @endif

        @if ($mediaType === 'pageContent' && $selectedSubpage)
            <select wire:model="selectedPageContentId">
                <option value="{{ optional($selectedSubpage->pageContent)->id }}">
                    {{ $selectedSubpage->title }} Content
                </option>
            </select>
        @endif

        <input type="file" wire:model="media">
        @error('media')
            <span class="error">{{ $message }}</span>
        @enderror
        <button type="submit">Upload Media</button>
    </form>

    @if ($mainPage->media)
        <img src="{{ Storage::url($mainPage->media) }}" alt="Main Page Media">
    @endif

    <!-- List of Subpages -->
    <div class="subpages">
        <ul>
            @foreach ($subpages as $subpage)
                <li>
                    <a href="#" wire:click.prevent="updateSelectedSubpage({{ $subpage->id }})">
                        {{ $subpage->title }}
                    </a>

                    @if ($subpage->media)
                        <img src="{{ Storage::url($subpage->media) }}" alt="Subpage Media">
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Selected Subpage Content -->
    <div class="subpage-content">
        @if ($selectedSubpage)
            <h2>{{ $selectedSubpage->title }}</h2>
            <p>{{ optional($selectedSubpage->pageContent)->content ?? 'No content available.' }}</p>

            @if ($selectedSubpage->pageContent && $selectedSubpage->pageContent->media)
                <img src="{{ Storage::url($selectedSubpage->pageContent->media) }}" alt="Page Content Media">
            @endif
        @else
            <p>Select a subpage to view its content.</p>
        @endif
    </div>
</div>

<!-- Optionally, include styles for better presentation -->
<style>
    .subpages ul {
        list-style-type: none;
        padding: 0;
    }

    .subpages li {
        display: inline;
        margin-right: 10px;
    }

    .subpage-content {
        margin-top: 20px;
    }

    .error {
        color: red;
    }
</style>
