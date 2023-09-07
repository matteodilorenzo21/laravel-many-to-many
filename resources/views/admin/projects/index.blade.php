@extends('layouts.app')

@section('title', 'Projects')

@section('content')


    <section id="projects-index" class="p-0 mx-5">

        <div class="table-actions d-flex justify-content-between align-items-center">
            <h1 class="ms-1">Projects</h1>
            <div class="d-flex align-items-center me-3">
                <span class="fs-4 text-white pb-1">New</span>
                <a id="add-project-btn" class="ms-2 justify-content-end" href="{{ route('admin.projects.create') }}"><i
                        class="bi bi-plus-lg"></i></a>
            </div>
        </div>

        <table id="projects-table" class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Url</th>
                    <th scope="col">Year</th>
                    <th scope="col">Client</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Last update</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="align-middle text-center">
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>
                            @if ($project->category)
                                <span class="label"
                                    style="background-color: {{ $project->category->color }}">{{ $project->category->label }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $project->url }}</td>
                        <td>{{ $project->completion_year }}</td>
                        <td>{{ $project->client }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td id="table-actions">
                            <a href="{{ route('admin.projects.show', $project) }}" id="show-btn"
                                class="project-action d-inline"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.projects.edit', $project) }}" id="edit-btn"
                                class="project-action d-inline ml-2"><i class="bi bi-pen"></i></a>
                            <form class="d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="destroy-btn" class="project-action d-inline ml-2"><i
                                        class="bi bi-x-lg"></i></button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" style="width: 15%;">
                            <h2>Nothing to see here..</h2>
                        </td>
                    </tr>
                @endempty
        </tbody>
    </table>
</section>

@endsection
