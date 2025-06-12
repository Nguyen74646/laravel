@extends('trang-chu.layout.master')

@section('title', 'Giới Thiệu')

@section('content') 
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <a href="https://lid.agu.edu.vn" title="https://lid.agu.edu.vn">
      <div class="carousel-item active">
        <img src="{{ asset('storage/image/banner-1.jpg') }}" class="d-block w-100" alt="Banner 1">
      </div>
    </a>
    <a href="https://agu.edu.vn" title="https://agu.edu.vn">
      <div class="carousel-item">
        <img src="{{ asset('storage/image/baner-2.jpg') }}" class="d-block w-100" alt="Banner 2">
      </div>
    </a>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<div id="tin-moi-nhat-container">
    @include('trang-chu.layout.tin_moi_nhat', ['tin_moi_nhat' => $tin_moi_nhat])
</div>

<div id="van-ban-moi-container">
    @include('trang-chu.layout.van-ban-moi', ['van_ban_moi' => $van_ban_moi])
</div>

<div class="container my-4">
  <div class="ratio ratio-16x9 rounded shadow">
    <iframe
      width="600"
      height="450"
      style="border:0;"
      loading="lazy"
      allowfullscreen
      referrerpolicy="no-referrer-when-downgrade"
      src="https://www.google.com/maps?hl=vi&q=10.369487010407688, 105.43263971546703&z=18&output=embed">
    </iframe>
  </div>
</div>

@endsection
