<div class="px-0 border-end" id="left">
  @foreach ($navbar as $key => $menu)
    <div class="accordion accordion-flush">
      <div class="accordion-item">
        @isset($menu['route'])
          <a class="accordion-button {{ $menu['navStatus'] }}" href="{{ route($menu['route'], $menu['params']) }}">
            <div class="mb-0">{{ $menu['label'] }}</div>
          </a>
        @else
          @if ($menu['navStatus'] == 'active')
            <h2 class="accordion-header text-nowrap" id="{{ 'sidemenu_heading_' . $key }}">
              <button class="accordion-button header-active-style {{ $menu['navStatus'] }}" data-bs-toggle="collapse"
                data-bs-target="#{{ 'sidemenu_' . $key }}" aria-expanded="true"
                aria-controls="{{ 'sidemenu_' . $key }}">
                <div class="d-flex justify-content-center menu-icon"><i class="fa-solid {{ $menu['icon'] }}"></i></div>
                <div class="mb-0">{{ $menu['label'] }}</div>
              </button>
            </h2>
          @else
            <h2 class="accordion-header text-nowrap" id="{{ 'sidemenu_heading_' . $key }}">
              <button class="accordion-button collapsed {{ $menu['navStatus'] }}" data-bs-toggle="collapse"
                data-bs-target="#{{ 'sidemenu_' . $key }}" aria-expanded="true"
                aria-controls="{{ 'sidemenu_' . $key }}">
                <div class="d-flex justify-content-center menu-icon"><i class="fa-solid {{ $menu['icon'] }}"></i></div>
                <div class="mb-0">{{ $menu['label'] }}</div>
              </button>
            </h2>
          @endif
    @endif

    @if (isset($menu['pages']) && count($menu['pages']))
      @if ($menu['navStatus'] == 'active')
        @foreach ($menu['pages'] as $pKey => $page)
          @if (isset($page['display']) && !$page['display'])
          @else
            @isset($page['navStatus'])
              @if ($page['navStatus'] == 'active')
                <div class="accordion-body active-style">
                  <a class="{{ $page['navStatus'] }} rewrite-a-tag"
                    href="{{ route($page['route'], $page['params']) }}">{{ $page['label'] }}</a>
                </div>
              @else
                <div class="accordion-body">
                  <a class="" href="{{ route($page['route'], $page['params']) }}"
                    style="text-decoration: none;">{{ $page['label'] }}</a>
                </div>
              @endif
            @else
              <a class="list-group-item" href="{{ route($page['route'], $page['params']) }}">{{ $page['label'] }}</a>
            @endif
          @endif
        @endforeach
      @else
        @foreach ($menu['pages'] as $pKey => $page)
          @if (isset($page['display']) && !$page['display'])
          @else
            @isset($page['navStatus'])
              <div id="{{ 'sidemenu_' . $key }}" class="text-nowrap accordion-collapse collapse"
                aria-labelledby="{{ 'sidemenu_heading_' . $key }}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <a class="{{ $page['navStatus'] }}" href="{{ route($page['route'], $page['params']) }}"
                    style="text-decoration: none">
                    {{ $page['label'] }}
                  </a>
                </div>
              </div>
            @else
              <div id="{{ 'sidemenu_' . $key }}" class="text-nowrap accordion-collapse collapse"
                aria-labelledby="{{ 'sidemenu_heading_' . $key }}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <a class="" href="{{ route($page['route'], $page['params']) }}">
                    {{ $page['label'] }}
                  </a>
                </div>
              </div>
            @endif
          @endif
        @endforeach
        @endif
        @endif
      </div>

      </div>
      @endforeach
      </div>
