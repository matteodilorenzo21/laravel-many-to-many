@extends('layouts.app')

@section('title', 'Create a new Project')

@section('content')

    <div class="container">
        @include('components.forms.error-alert')
    </div>

    <section id="project-create" class="p-0 text-white">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h2>New Project</h2>
            </div>
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row fw-bold">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="title" class="form-label @error('title') is-invalid @enderror">Titolo</label>
                            <input type="text" class="form-control border border-secondary" id="title" name="title"
                                value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description"
                                class="form-label @error('description') is-invalid @enderror">Descrizione</label>
                            <textarea rows="1" class="form-control border border-secondary" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category"
                                class="form-label @error('category_id') is-invalid @enderror">Categoria</label>
                            <select class="form-select" id="category" name="category_id">
                                <option value="">- Seleziona una categoria -</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="file"
                                class="form-control border border-secondary @error('image') is-invalid @enderror"
                                id="image" name="image" oninput="updatePreviewImage()" value="{{ old('image') }}"
                                accept="image/*">
                        </div>
                        <div>
                            <img class="border border-secondary"
                                src="{{ old('image') ? asset('public/images/' . old('image')) : 'https://i1.wp.com/potafiori.com/wp-content/uploads/2020/04/placeholder.png?ssl=1' }}"
                                alt="preview" id="image-preview">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control border border-secondary" id="url" name="url"
                                value="{{ old('url') }}">
                        </div>
                        <div class="mb-4">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control border border-secondary" id="slug" name="slug"
                                value="{{ Str::slug(old('title'), '-') }}" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="completion_year" class="form-label">Anno di Completamento</label>
                            <input type="text" class="form-control border border-secondary" id="completion_year"
                                name="completion_year" value="{{ old('completion_year') }}">
                        </div>
                        <div class="mb-3">
                            <label for="technologies" class="form-label">Tecnologie Utilizzate</label>
                            <input type="text" class="form-control border border-secondary" id="technologies"
                                name="technologies" value="{{ old('technologies') }}">
                        </div>
                        <div class="mb-4">
                            <label for="client" class="form-label">Cliente</label>
                            <input type="text" class="form-control border border-secondary" id="client" name="client"
                                value="{{ old('client') }}">
                        </div>
                        <div class="mb-3">
                            <label for="project_duration" class="form-label">Durata del Progetto</label>
                            <input type="text" class="form-control border border-secondary" id="project_duration"
                                name="project_duration" value="{{ old('project_duration') }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.projects.index') }}" id="create-back-btn">Index<i
                            class="bi bi-arrow-counterclockwise"></i></a>
                    <button type="reset" id="create-reset-btn" class="mx-2">Reset<i
                            class="bi bi-arrow-repeat"></i></button>
                    <button type="submit" id="create-create-btn">Create<i class="bi bi-plus-lg"></i></button>
                </div>
            </form>
        </div>
    </section>

    <script>
        const placeholder = "https://i1.wp.com/potafiori.com/wp-content/uploads/2020/04/placeholder.png?ssl=1";
        const imageInput = document.getElementById("image");
        const previewImage = document.getElementById("image-preview");

        // Dynamic preview image update
        function updatePreviewImage() {
            if (imageInput.files.length > 0) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                previewImage.src = placeholder;
            }
        }

        const titleInput = document.getElementById("title");
        const slugInput = document.getElementById("slug");

        // Dynamic slug based on title input
        function updateSlug() {
            const titleValue = titleInput.value.trim();
            const slugValue = titleValue.toLowerCase().replace(/[^a-zA-Z0-9]+/g, "-");
            slugInput.value = slugValue;
        }

        // Title event listener
        titleInput.addEventListener("input", updateSlug);
    </script>

@endsection
