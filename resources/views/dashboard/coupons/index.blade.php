@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.coupons')
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active"></i> @lang('site.coupons')</li>

            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 10px;">@lang('site.coupons')
                    </h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            @if($coupon_edit)
                                @include('dashboard.coupons.edit' ,  ['coupon' => $coupon])
                            @else
                            @include('dashboard.coupons.create')
                            @endif
                        </div>
                        <div class="col-md-6">
                            @include('dashboard.coupons.show' , ['coupons' => $coupons])
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
