@extends('bis.main.index')

@section('content')

<div class="row">
           
            <div class="col-lg-6">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Current Members</span>
                            <h2 class="font-bold">200</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-university fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Current Organization </span>
                            <h2 class="font-bold">10</h2>
                        </div>
                    </div>
                </div>
            </div>
           
           <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Number of Farmer's in an Organization</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="lineChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
</div>

@stop