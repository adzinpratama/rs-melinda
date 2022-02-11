@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">{{ __('Soal 2 ') }}</h2>


                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-alt fa-fw"></i>
                                </span>
                                <input onkeypress="allowNumericAndComma(event)" class="form-control ncallow" type="text"
                                    name="box1" id="box1">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-alt fa-fw"></i>
                                </span>
                                <input onkeypress="allowNumericAndComma(event)" class="form-control ncallow" type="text"
                                    name="box2" id="box2">
                            </div>
                        </div>

                    </div>
                    <div class="mt-3">
                        <button onclick="submit()" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">{{ __('Result ') }}</h2>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3" id="baris1">

                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3" id="baris2">

                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3" id="baris3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function allowNumericAndComma(e) {
            if (window.event) {
                if ((e.keyCode < 48 || e.keyCode > 57) & e.keyCode != 8 && e.keyCode != 44) {
                    event.returnValue = false;
                    return false;
                }
            } else {
                if ((e.which < 48 || e.which > 57) & e.which != 8 && e.which != 44) {
                    e.preventDefault();
                    return false;
                }
            }
        }

        function submit() {
            Swal.showLoading();
            let box1 = document.getElementById('box1').value.split(',').map(function(i) {
                return parseInt(i);
            })
            let box2 = document.getElementById('box2').value.split(',').map(function(i) {
                return parseInt(i);
            })

            let baris1 = [...box1, ...box2].sort((i, j) => {
                return i - j
            })
            let min = Math.min.apply(null, baris1)
            let max = Math.max.apply(null, baris1)
            let baris2 = min * max

            let sum = baris1.reduce((a, b) => {
                return a + b
            });
            let baris3 = max - sum
            viewResult(baris1, baris2, baris3);
            Swal.close();
        }

        function viewResult(baris1, baris2, baris3) {
            document.getElementById('baris1').innerHTML = baris1
            document.getElementById('baris2').innerHTML = baris2
            document.getElementById('baris3').innerHTML = baris3
        }
    </script>
@endsection
