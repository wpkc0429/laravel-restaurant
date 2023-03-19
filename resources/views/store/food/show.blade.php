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
            {{-- 價格 --}}
            <tr>
              <td class="w-25 p-0">
                <label for="unit_price" class="col-form-label">
                  <b>價格</b>
                </label>
              </td>
              <td class="w-75">{{ $model->unit_price }}</td>
            </tr>
            {{-- 備註 --}}
            <tr>
              <td class="w-25 p-0">
                <label for="desc" class="col-form-label">
                  <b>備註</b>
                </label>
              </td>
              <td class="w-75">{{ $model->desc }}</td>
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
