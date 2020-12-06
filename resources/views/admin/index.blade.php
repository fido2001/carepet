@extends('layouts.master')

@section('header')
    {{ auth()->user()->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-store"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Petshop</h4>
                </div>
                <div class="card-body">
                    {{ $jml_petshop }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Petowner</h4>
                </div>
                <div class="card-body">
                    {{ $jml_petowner }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-bone"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Produk</h4>
                </div>
                <div class="card-body">
                    {{ $jml_produk }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-tag"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Service Packages</h4>
                </div>
                <div class="card-body">
                    {{ $jml_paket }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection