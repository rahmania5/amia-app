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
    <a href="https://www.facebook.com/CV-Ratna-Juwita-234347146739771" class="simple-text logo-normal" target="blank">
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
      <li>
        <a data-toggle="collapse" href="#users">
          <i class="now-ui-icons users_single-02"></i>
          <p>
            {{ __("Pengelolaan User") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse hide" id="users">
          <ul class="nav">
            <li class="@if ($activePage == 'profile') active @endif">
              <a href="{{ route('profile.edit') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("User Profile") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'users') active @endif">
              <a href="{{ route('user.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("User Management") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="@if ($activePage == 'sales_transaction') active @endif">
        <a href="{{ route('admin.sales_transaction.index') }}">
          <i class="now-ui-icons education_paper"></i>
          <p>{{ __('Pengelolaan Transaksi') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'payment') active @endif">
        <a href="{{ route('admin.payment.index') }}">
          <i class="now-ui-icons business_money-coins"></i>
          <p>{{ __('Pengelolaan Pembayaran') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'loan') active @endif">
        <a href="{{ route('admin.loan.index') }}">
          <i class="now-ui-icons files_paper"></i>
          <p>{{ __('Pengelolaan Piutang') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'deliveries') active @endif">
        <a href="{{ route('delivery.index') }}">
          <i class="now-ui-icons shopping_delivery-fast"></i>
          <p>{{ __('Pengelolaan Pengantaran') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'returns') active @endif">
        <a href="{{ route('admin.return.index') }}">
          <i class="now-ui-icons shopping_box"></i>
          <p>{{ __('Pengelolaan Return') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'goods') active @endif">
        <a href="{{ route('goods.index') }}">
          <i class="now-ui-icons shopping_tag-content"></i>
          <p>{{ __('Pengelolaan Barang') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'stocks') active @endif">
        <a href="{{ route('production.index') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Pengelolaan Stok') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'driver') active @endif">
        <a href="{{ route('driver.index') }}">
          <i class="now-ui-icons business_badge"></i>
          <p>{{ __('Pengelolaan Driver') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'vehicles') active @endif">
        <a href="{{ route('vehicle.index') }}">
          <i class="now-ui-icons transportation_bus-front-12"></i>
          <p>{{ __('Pengelolaan Kendaraan') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
