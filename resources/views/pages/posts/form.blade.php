                        @csrf
                        <div class="form-group">
                            <input type="file" name="thumbnail" id="thumbnail">
                            @error('thumbnail')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $post->title }}">
                            @error('title')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option disabled selected>Choose one!</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ old('category') ?? $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <select name="tag[]" id="tag" class="form-control select2" multiple>
                                @foreach ($post->tags as $tag)
                                    <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tag')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" name="body" id="body" class="form-control">{{ old('body') ?? $post->body }}</textarea>
                            @error('body')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary">{{ $submit ?? 'Update' }}</button>