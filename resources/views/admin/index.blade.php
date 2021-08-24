@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2">Dashboard</h1>

</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <h5 class="card-header customCardHeader">Center Transactions This Month</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="box">
                            <div class="number">
                                <span id="numOfTrans">{{ number_format($noOfTransactions)}}</span>
                            </div>
                            <div class="label-holder">
                                <span>No. of Transactions</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <div class="number">
                                <span id="completeTrans">{{ number_format($completedTransactions) }}</span>
                            </div>
                            <div class="label-holder">
                                <span>Completed Transactions</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <div class="number price">
                                &#8369;<span id="monthTotal">{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="label-holder">
                                <span>Total Amount</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
