@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <a href="{{ route('schedule.index') }}" class="btn btn-primary btn-rounded mb-3">Back</a>
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">{{ isset($schedule) ? __('Edit Schdule') : __('Add Schdule') }}</h2>

                    <form
                        action="{{ isset($schedule) ? route('schedule.update', [$schedule->id]) : route('schedule.store') }}"
                        method="POST">
                        @isset($schedule)
                            @method('PUT')
                        @endisset
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                <label for="name">{{ 'Docter Name' }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-alt fa-fw"></i>
                                    </span>
                                    <select class="form-select" id="proficiency" name="docter_id"
                                        aria-label="Default select example">
                                        @foreach ($docters as $docter)
                                            <option value="{{ $docter->id }}"
                                                {{ isset($schedule) ? ($docter->id == $schedule->docter_id ? 'selected' : '') : '' }}>
                                                {{ $docter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="col-md-12 mb-3" id="schedule">

                                <button onclick="addSchdule()"
                                    class="btn btn-secondary d-inline-flex align-items-center me-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-plus mr-2"></i> Add Jadwal
                                </button>

                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('Submit') }}</button>
                        </div>
                    </form>
                    @if (isset($schedule))
                        <input type="hidden" name="days" id="days"
                            value="{{ implode(',', json_decode($schedule->day)) }}">
                        <input type="hidden" name="times" id="times"
                            value="{{ implode(',', json_decode($schedule->time)) }}">
                    @endif
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


    <script>
        let day = document.getElementById('days').value.split(',')
        let time = document.getElementById('times').value.split(',')
        if (day != '') {
            for (let i = 0; i < day.length; i++) {
                addSchdule(day[i], time[i]);
            }
        }

        function addSchdule(day = '', time = '') {
            let dayList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jummat', 'Sabtu', 'Minggu'];
            let r = (Math.random() + 1).toString(36).substring(7)
            let option = '';
            let check = time == 'By Appoinment' ? true : false;
            for (let i = 0; i < dayList.length; i++) {
                option += `<option value="${dayList[i]}" ${day == dayList[i] ? 'selected':''}>${dayList[i]}</option>`;
            }
            let html = `<div class="row mt-2" id="${r}">
                        <div class="col-md-8">
                            <select class="form-select" name="day[]">
                                ${option}
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button onclick="remove('${r}')"
                                class="btn btn-secondary d-inline-flex align-items-center me-2 dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-trash mr-2"></i>
                            </button>
                        </div>
                        <div class="col-md-5 mt-2">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <input type="text" class="form-control" name="time[]" value="${!check ? time:''}" ${check? 'disabled':''} id="time-${r}">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  value="By Appoinment" ${check? 'checked':''}  name="time[]" id="check-${r}" onChange="appoinment('${r}')">
                                <label class="form-check-label">By Appointment</label>
                            </div>
                        </div>
                    </div>`;
            let schedule = document.getElementById('schedule');
            schedule.insertAdjacentHTML("beforeEnd", html);
        }

        function remove(id) {
            document.getElementById(id).remove();
        }

        function appoinment(id) {
            let time = document.getElementById('time-' + id);
            let check = document.getElementById('check-' + id);
            if (check.checked) return time.setAttribute("disabled", 'disabled');
            else return time.removeAttribute("disabled");
        }
    </script>
@endsection
