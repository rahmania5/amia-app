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
      <li class="@if ($activePage == 'profile') active @endif">
        <a href="{{ route('profile.edit') }}">
          <i class="now-ui-icons users_single-02"></i>
          <p>{{ __('User Profile') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'order') active @endif">
        <a href="{{ route('distributor.sales_transaction.index') }}">
          <i class="now-ui-icons shopping_cart-simple"></i>
          <p>{{ __('Pemesanan Barang') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'payment') active @endif">
        <a href="{{ route('distributor.payment.index') }}">
          <i class="now-ui-icons business_money-coins"></i>
          <p>{{ __('Pembayaran Tagihan') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'return') active @endif">
        <a href="{{ route('distributor.return.index') }}">
          <i class="now-ui-icons shopping_box"></i>
          <p>{{ __('Return Barang') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
