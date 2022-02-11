@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow">
        <div class="card-body">
            <a href="{{ route('docter.create') }}" class="btn btn-primary d-inline-flex align-items-center mb-3"><svg
                    xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                    <line x1="12" y1="9" x2="12" y2="15"></line>
                </svg> Add Docter </a>
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Photo</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Proficiency</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                        @foreach ($docters as $docter)
                            <tr>
                                <td class="border-0">
                                    <img class="me-2 image image-md" alt="Image placeholder"
                                        src="{{ asset($docter->image) }}">
                                </td>
                                <td class="border-0 fw-bold"><span class="h6">{{ $docter->name }}</span></td>
                                <td class="border-0 text-danger">
                                    {{ $docter->proficiency->name }}
                                </td>
                                <td>
                                    <a href="{{ route('docter.edit', [$docter->id]) }}" class="btn btn-info mb-2 mr-2"><i
                                            class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('docter.destroy', [$docter->id]) }}"
                                        id="{{ 'form-' . $docter->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a onclick="confirm('{{ 'form-' . $docter->id }}')" class="btn btn-danger"><i
                                                class="fas fa-trash"></i>
                                        </a>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        <!-- End of Item -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
