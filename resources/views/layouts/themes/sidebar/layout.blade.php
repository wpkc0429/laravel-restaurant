<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>{{env('APP_NAME', 'Laravel')}}</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @stack('meta')

  <!-- Bootstrap CSS v5.1.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('css/fontawesome/6.2.0/fontawesome.free.css') }}" />

  <!-- Font href -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- Tagsinput -->
  <link rel="stylesheet" href="{{ URL::asset('css/jquery.tagsinput-revisited.css') }}">
  {{-- select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css">

  {{-- theme style css --}}
  <link rel="stylesheet" href="{{ URL::asset('css/theme/sidebar/style.css') }}" />

  {{-- datepicker,timepicker --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" integrity="sha512-vZpXDvc3snY9J1W8GrnxqDr/+vP1nSTfk8apH1r0wQvOab6fkPhaeqAMlydW68MECAjRR05tu4SOJcwjZgPg5A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* 這樣label比較好點選,沒有gap */
    .form-check.form-check-inline{
      padding-right: 1rem;
      margin-right: 0rem;
    }
  </style>
  @stack('links')
</head>

<body>
  <!-- header -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
      <div class="container-fluid">
        <!-- hamburger -->
        <button class="btn btn-primary shadow-none" href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
          aria-expanded="true" id="menu">
          <span style="font-size:18px;cursor:pointer">☰</span>
        </button>
        <a class="navbar-brand ms-5" href="{{ url('/') }}">{{ env('HTML_LAYOUT_NAV_TITLE', env('APP_NAME', 'Laravel')) }}</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
          aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa-solid fa-gear my-1"></i>
        </button>
        <div class="collapse navbar-collapse text-center me-3" id="navbarScroll">

        </div>
      </div>
    </nav>
  </div>

  <!-- side navbar -->
  @include('layouts/themes/sidebar/menu')
  <div class="p-3" id="right">
    <div id="breadcrumb-section" class="container-fluid">
      <div class="row">
      </div>
    </div>
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script type="text/javascript" src="{{ URL::asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{ asset('js/datepicker-default-setting.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" integrity="sha512-ux1VHIyaPxawuad8d1wr1i9l4mTwukRq5B3s8G3nEmdENnKF5wKfOV6MEUH0k/rNT4mFr/yL+ozoDiwhUQekTg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Tagsinput -->
  <script src="{{ URL::asset('js/jquery.tagsinput-revisited.js') }}"></script>
  {{-- select2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script type="text/javascript" src="{{ URL::asset('js/theme/sidebar/sidebar.js') }}"></script>
  @stack('scripts')

</body>

</html>
