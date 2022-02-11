@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <a href="{{ route('docter.index') }}" class="btn btn-primary btn-rounded mb-3">Back</a>

                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">{{ __('Add Docter') }}</h2>
                    <form action="{{ isset($docter) ? route('docter.update', [$docter->id]) : route('docter.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($docter)
                            @method('PUT')
                        @endisset
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                <label for="name">{{ 'Docter Name' }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-alt fa-fw"></i>
                                    </span>
                                    <input id="name" class="form-control" type="text" name="name"
                                        value="{{ $docter->name ?? '' }}" placeholder="{{ __('Docter Name') }}"
                                        required>
                                </div>
                                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">{{ __('Photo') }}</label>
                                <input class="form-control" type="file" id="image" name="image">
                                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4">
                                <label class="my-1 me-2" for="country">{{ __('Profeciency') }}</label>
                                <select class="form-select" id="proficiency" name="proficiency_id"
                                    aria-label="Default select example">
                                    <option selected="selected">Open this select menu</option>
                                    @foreach ($profeciencies as $profeciency)
                                        <option value="{{ $profeciency->id }}"
                                            {{ isset($docter) ? ($profeciency->id === $docter->proficiency->id ? 'selected' : '') : '' }}>
                                            {{ $profeciency->name }}</option>
                                    @endforeach
                                </select>
                                @error('proficiency_id') <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if ($message = Session::get('success'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ $message }}',
            })
        </script>
    @endif
@endsection
