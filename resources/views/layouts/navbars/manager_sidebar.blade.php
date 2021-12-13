<div class="sidebar" data-color="blue">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="https://www.facebook.com/CV-Ratna-Juwita-234347146739771" class="simple-text logo-mini" target="blank">
      <div class="logo-image-small">
        <img src="{{ asset('assets') }}/img/favicon.png">
      </div>
    </a>
    <a href="home" class="simple-text logo-normal">
      {{ __('SI DISTRIBUSI AMIA') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons business_bank"></i>
          <p>{{ __('Home') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'profile') active @endif">
        <a href="{{ route('profile.edit') }}">
          <i class="now-ui-icons users_single-02"></i>
          <p>{{ __('User Profile') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'sales') active @endif">
        <a href="{{ route('manager.sales.index') }}">
          <i class="now-ui-icons business_chart-bar-32"></i>
          <p>{{ __('Laporan Penjualan') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'distributor') active @endif">
        <a href="{{ route('manager.distributor.index') }}">
          <i class="now-ui-icons shopping_shop"></i>
          <p> {{ __("Laporan Distributor") }} </p>
          </a>
      </li>
      <li class = "@if ($activePage == 'loan') active @endif">
        <a href="{{ route('manager.loan.index') }}">
          <i class="now-ui-icons files_paper"></i>
          <p>{{ __('Laporan Piutang') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
