<div>
	<!-- Main Page Title -->
	<h1>{{ $page->title }}</h1>

	<!-- Media Upload Form -->
	<form wire:submit.prevent="uploadMedia">
    	<select wire:model="mediaType">
        	<option value="" selected>Select Media Type</option>
        	<option value="page">Page</option>
        	<option value="pagesection">Page Section</option>
        	<option value="pagecontent">Page Content</option>
    	</select>

    	@if($mediaType === 'pagesection')
        	<select wire:model="selectedPagesectionId">
            	<option value="" selected>Select Page Section</option>
            	@foreach($pagesections as $pagesection)
                	<option value="{{ $pagesection->id }}">{{ $pagesection->title }}</option>
            	@endforeach
        	</select>
    	@endif

    	@if($mediaType === 'pagecontent' && $selectedPagesection)
        	<select wire:model="selectedPagecontentId">
            	@foreach($selectedPagesection->pagecontents as $pagecontent)
                	<option value="{{ $pagecontent->id }}">{{ $pagecontent->title }}</option>
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

	<!-- List of Page Sections -->
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
            	<img src="{{ Storage::url($selectedPagesection->pagecontents->first()->media) }}" alt="Page Content Media">
        	@endif
    	@else
        	<p>Select a page section to view its content.</p>
    	@endif
	</div>
</div>

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

