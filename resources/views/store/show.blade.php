@extends("layouts/layout")

{{-- Content --}}
@section('content')
<div class="row mb-3">
  <div class="col-12">
    <a href="{{ $previous_url }}">
      <i class="fa-solid fa-arrow-left"></i>&ensp;<b>返回</b>
    </a>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-lg-10 col-md-12">
    <a class="btn btn-primary mb-3" href="{{ $food_url }}" class="text-underline-hover text-nowrap">
      <i class="fa-solid fa-eye"></i>&ensp;<b>餐點資訊</b>
    </a>
    <div class="card text-center">
      <ul class="list-group list-group-flush mx-5 mt-3 table-responsive">
        <table class="table table-bordered" style="table-layout: fixed;">
          <tbody class="align-middle">
            {{-- 名稱 --}}
            <tr>
              <td class="w-25 p-0 table-primary">
                <label for="name" class="col-form-label">
                  <b>名稱</b>
                </label>
              </td>
              <td class="w-75 table-primary">{{ $model->name }}</td>
            </tr>
            {{-- 電話 --}}
            <tr>
              <td class="w-25 p-0">
                <label for="phone" class="col-form-label">
                  <b>電話</b>
                </label>
              </td>
              <td class="w-75">{{ $model->phone }}</td>
            </tr>
            {{-- 營業時間 --}}
            <tr>
              <td class="w-25 p-0">
                <label for="business_time" class="col-form-label">
                  <b>營業時間</b>
                </label>
              </td>
              <td class="w-75">{{ $model->business_time }}</td>
            </tr>
            {{-- 座標 --}}
            <tr>
              <td class="w-25 p-0">
                <label for="latlng_mask" class="col-form-label">
                  <b>座標</b>
                </label>
              </td>
              <td class="w-75">{{ $model->latlng_mask }}</td>
            </tr>
          </tbody>
        </table>
      </ul>
    </div>
  </div>
</div>
@endsection

{{-- Script --}}
@push('scripts')

@endpush
