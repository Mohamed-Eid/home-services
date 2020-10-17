<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>                                    
                    {{ auth()->user()->first_name .' '. auth()->user()->last_name }}
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            @if(auth()->user()->hasPermission('read_users'))
            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif

            @if(auth()->user()->hasPermission('read_cities'))
            <li><a href="{{ route('dashboard.cities.index') }}"><i class="fa fa-truck"></i><span>@lang('site.cities')</span></a></li>
            @endif

            @if(auth()->user()->hasPermission('read_categories'))
            <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa  fa-cube"></i><span>@lang('site.categories')</span></a></li>
            @endif
            

            @if(auth()->user()->hasPermission('read_coupons'))
            <li><a href="{{ route('dashboard.coupons.index') }}"><i class="fa fa-ticket"></i><span>@lang('site.coupons')</span></a></li>
            @endif 
            


            @if(auth()->user()->hasPermission('read_banks'))
            <li><a href="{{ route('dashboard.banks.index') }}"><i class="fa fa-bank"></i><span>@lang('site.banks')</span></a></li>
            @endif        
            
            @if(auth()->user()->hasPermission('update_terms'))
            <li><a href="{{ route('dashboard.terms') }}"><i class="fa  fa-bars"></i><span>@lang('site.terms')</span></a></li>
            @endif 
            
            @if(auth()->user()->hasPermission('update_about_us'))
            <li><a href="{{ route('dashboard.abouts') }}"><i class="fa fa-registered"></i><span>@lang('site.about_us')</span></a></li>
            @endif 
        </ul>

    </section>

</aside>

