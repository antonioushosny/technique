
<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard.home') }}">
          <i class="nav-icon icon-home"></i> {{ __('admin::lang.home') }}
        </a>
      </li>
 
      
      {{-- About Company Links --}}
      @canany(['view infos'])

        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon fa fa-arrow-circle-down"></i> {{ __('admin::lang.aboutProject') }}</a>
          <ul class="nav-dropdown-items">

            {{-- Infos Link --}}
            @can('view infos')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.infos.show', [1, 'activeLocale' => $locale]) }}">
                  {{ __('admin::lang.infos') }}</a>
              </li>
            @endcan

         

            {{-- Infos Link --}}
            @can('view infos')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.infos.show', [2, 'activeLocale' => $locale]) }}">
                  {{ __('admin::lang.privacyPolicy') }}</a>
              </li>
            @endcan

            {{-- Infos Link --}}
            @can('view infos')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.infos.show', [3, 'activeLocale' => $locale]) }}">
                  {{ __('admin::lang.termsConditions') }}</a>
              </li>
            @endcan
 
          </ul>
        </li>
      @endcanany
  
 
   
      {{-- Admins Links --}}
      @canany(['view admins', 'view roles'])
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-people"></i> {{ __('admin::lang.users') }}</a>
          <ul class="nav-dropdown-items">

            @can('view admins')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.admins.index') }}">
                  <i class="nav-icon icon-people"></i> {{ __('admin::lang.admins') }}</a>
              </li>
            @endcan
            @can('view roles')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                  <i class="nav-icon fa fa-user-plus"></i> {{ __('admin::lang.permissions') }}</a>
              </li>
            @endcan
          </ul>
        </li>
      @endcanany
      
      
      {{-- MetaTags Link --}}
      @canany(['view metatags'])
        <li class="nav-item">
            @can('view metatags')
              <a class="nav-link" href="{{ route('admin.metatags.index') }}" >
                <i class="nav-icon fa fa-globe"></i> {{ __('admin::lang.metatagsLink') }}
              </a>
            @endcan
        </li>
      @endcanany

      {{-- MetaTags Link --}}
      @canany(['view settings'])
        <li class="nav-item">
            @can('view settings')
              <a class="nav-link" href="{{ route('admin.settings.index') }}" >
                <i class="nav-icon fa fa-cogs"></i> {{ __('admin::lang.settings') }}
              </a>
            @endcan
        </li>
      @endcanany

      
       
    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
