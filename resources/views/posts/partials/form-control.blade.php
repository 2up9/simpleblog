<div class="form-group">
    <img id="preview" src="{{ $post->thumbnail ? $post->takeImage() : asset('storage/images/post/default-bg.png') }}" alt="" class="img-thumbnail mb-3">
    <label for="Thumbnail">Thumbnail</label>
    <input type="file" name="thumbnail" id="inputImage" class="form-control @error('thumbnail') is-invalid @enderror" value="{{ old('thumbnail') ?? $post->thumbnail }}">
    @error('thumbnail')

    <div class="invalid-feedback">
        {{ $message }}
    </div>
        
    @enderror
</div>

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $post->title }}">
    @error('title')

    <div class="invalid-feedback">
        {{ $message }}
    </div>
        
    @enderror
</div>

<div class="form-group">
    <label for="category">Category</label>
    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
        <option disabled selected>Choose One</option>
        @foreach ($categories as $item)

        <option {{ $item->id == $post->category_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
            
        @endforeach
    </select>
    @error('category')

    <div class="invalid-feeback">
        {{ $message }}
    </div>
        
    @enderror
</div>

<div class="form-group">
    <label for="tags">Tag</label>
    <select name="tags[]" id="tags" class="form-control @error('tags') is-invalid @enderror" multiple>

        @foreach ($post->tags as $item)
        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
            
        @endforeach

        @foreach ($tags as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
            
        @endforeach
    
    </select>
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body') ?? $post->body }}</textarea>
    @error('body')

    <div class="invalid-feedback">
        {{ $message }}
    </div>
        
    @enderror
</div>