@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <div class="dropdown">
                <button class="btn btn-secondary d-inline-flex align-items-center me-2 dropdown-toggle"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg> New
                </button>
                <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('schedule.create') }}">
                        <svg class="icon icon-xs mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Schedule
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('schedule.index') }}" method="GET">
        <div class="input-group me-2 me-lg-3 fmxw-400 mb-3">
            <span class="input-group-text">
                <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                placeholder="Search Docter">
        </div>
    </form>
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                @if (isset($schedules))
                    @foreach ($schedules as $schedule)
                        @if ($schedule->docters->isNotEmpty())
                            <h4 class="mt-2">{{ $schedule->name }}</h4>
                            <table class="table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-0 rounded-start">Nama Dokter</th>
                                        <th class="border-0">Hari</th>
                                        <th class="border-0">Waktu</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule->docters as $docter)
                                        @foreach ($docter->schedule as $sc)
                                            <?php $day = json_decode($sc->day);
                                            $time = json_decode($sc->time);
                                            ?>
                                            <tr>
                                                <td rowspan="{{ count($day) }}" class="w-50">
                                                    <div class="d-flex align-items-center">
                                                        <img class="me-2 image image-md flex-row" alt="Image placeholder"
                                                            src="{{ asset($docter->image) }}">
                                                        <div><span class="h6">{{ $docter->name }}</span></div>
                                                    </div>
                                                </td>
                                                <td class="fw-bold" rowspan="1">
                                                    {{ $day[0] }}
                                                </td>
                                                <td class="fw-bold" rowspan="1">
                                                    {{ $time[0] }}
                                                </td>
                                                <td rowspan="{{ count($day) }}">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <a href="{{ route('schedule.edit', [$sc->id]) }}"
                                                            class="btn btn-info mb-2"><i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('schedule.destroy', [$sc->id]) }}"
                                                            id="{{ 'form-' . $sc->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a onclick="confirm('{{ 'form-' . $sc->id }}')"
                                                                class="btn btn-danger"><i class="fas fa-trash"></i>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @for ($i = 1; $i < count($day); $i++)
                                                <tr>
                                                    <td class="fw-bold" rowspan="1">
                                                        {{ $day[$i] }}
                                                    </td>
                                                    <td class="" rowspan="1">
                                                        {{ $time[$i] }}
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="d-flex mt-2">
                {!! $schedules->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ $message }}',
            })
        </script>
    @endif
    <script>
        function confirm(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(id).submit();
                }
            })
        }
    </script>
@endsection
