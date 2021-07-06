@extends('platform::app')


@section('body-right')


<div class="form-signin container h-full p-0 px-sm-5 py-5 my-sm-5">

  <a class="d-flex justify-content-center mb-4" href="{{Dashboard::prefix()}}">
    @includeFirst([config('platform.template.header'), 'platform::header'])
  </a>

  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">

      <div class="bg-white p-4 p-sm-5 rounded shadow-sm">
        @yield('content')
      </div>

      <div class="mt-4 text-center">
        @includeFirst([config('platform.template.footer'), 'platform::footer'])
      </div>
    </div>
  </div>
</div>

<label class="form-label text-center">
  <h6>Мы на карте</h6>
</label>

<iframe class="uk-padding-small" style="border: 0px none; float: left;"
src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2670.0631267450062!2d37.80024411505164!3d47.99316716918779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40e090f8c857425d%3A0x20244e4445b13f11!2z0JTQvtC90J3QotCjIOKEljU!5e0!3m2!1sru!2sua!4v1620380276131!5m2!1sru!2sua"
width="100%" height="400px" frameborder="0" allowfullscreen="allowfullscreen">
</iframe>

@endsection
