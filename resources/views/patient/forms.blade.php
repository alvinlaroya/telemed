@extends('layouts.patient')

@section('content')

<div class="row">
    <div class="col-12 col-md-12">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2
            mb-3 border-bottom">

            <h1 class="h2">Downloadable Forms</h1>
        </div>
        <div class="contianer">
            <div class="row">
                <div class="col-md-3">
                    <div class="card center" style="padding: 20px">
                        <h6 class="font-weight-bold">Patient Medical History</h6>
                        <img src="https://www.freeiconspng.com/uploads/excel-png-office-xlsx-icon-3.png" alt="" style="height: 150px; width: 150px; margin: auto" id="form1"><br>
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <a class="btn btn-danger btn-block" href="{{ route('patient.view.chief.complaint') }}" target="_blank" disabled>
                                    <span style="font-size: 11px">View</span>
                                </a>
                            </div> --}}
                            <div class="col-md-12">
                                <a class="btn btn-primary btn-block" href="{{ route('patient.download.medical.history') }}">
                                    <span style="font-size: 11px"><i class="fas fa-download"></i>&nbsp;&nbsp;Download</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card center" style="padding: 20px">
                        <h6 class="font-weight-bold">Chief Complaint Form</h6>
                        <img src="https://www.freeiconspng.com/uploads/excel-png-office-xlsx-icon-3.png" alt="" style="height: 150px; width: 150px; margin: auto" id="form1"><br>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-primary btn-block" href="{{ route('patient.download.chief.complaint') }}">
                                    <span style="font-size: 11px"><i class="fas fa-download"></i>&nbsp;&nbsp;Download</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card center" style="padding: 20px">
                        <h6 class="font-weight-bold">Health Declaration Form</h6>
                        <img src="https://www.freeiconspng.com/thumbs/ppt-icon/powerpoint-icon-microsoft-powerpoint-icon-network-powerpoint-icons-and-3.png" alt="" style="height: 150px; width: 150px; margin: auto" id="form1"><br>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-primary btn-block" href="{{ route('patient.download.forms.it') }}">
                                    <span style="font-size: 11px"><i class="fas fa-download"></i>&nbsp;&nbsp;Download</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

