@extends('layouts.app')

@section('title', 'home')

@section('content')
<main class="tasty-home-container">

    {{-- HERO SECTION --}}
    <section class="hero-section">
        <div class="hero-content">
            <span class="hero-subtitle-line"></span>
            <h1 class="hero-title">HEALTHY<br><strong>TASTY FOOD</strong></h1>
            <p class="hero-desc">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut ante a urna interdum auctor. Duis imperdiet gravida risus, sit amet placerat nisi vehicula sed.
            </p>
            <a href="#tentang" class="btn-primary-custom">TENTANG KAMI</a>
        </div>
        <div class="hero-image-wrapper">
            <div class="hero-image-card">
                {{-- Ganti path asset sesuai folder publik kamu --}}
                <img src="{{ asset('asset/img-4-2000x2000.png') }}" alt="Healthy Tasty Food">
            </div>
        </div>
    </section>

    {{-- TENTANG KAMI SECTION (Ringkasan di Home) --}}
    <section class="home-about-section">
        <div class="section-header text-center">
            <h2>TENTANG KAMI</h2>
            <div class="divider-line"></div>
            <p class="about-summary-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut ante a urna interdum auctor. Duis imperdiet gravida risus, sit amet placerat nisi vehicula sed. Aliquam erat volutpat.
            </p>
        </div>

        {{-- 4 GRID CARDS (LOREM IPSUM) --}}
        <div class="features-grid">
            @for ($i = 1; $i <= 4; $i++)
            <div class="feature-card">
                <div class="feature-img-wrapper">
                    <img src="{{ asset('images/food-circle-'. $i .'.jpg') }}" alt="Food Item">
                </div>
                <h3>LOREM IPSUM</h3>
                <p class="about-summary-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut ante a urna.
                </p>
            </div>
            @endfor
        </div>
    </section>

    <section class="home-news-section">
        <div class="section-header text-center">
            <h2>BERITA KAMI</h2>
            <div class="divider-line"></div>
        </div>

        <div class="news-layout-grid">
            {{-- Berita Utama (Besar di Kiri) --}}
            <div class="news-featured-card">
                <div class="news-featured-img">
                    <img src="{{ asset('images/news-main.jpg') }}" alt="Berita Utama">
                </div>
                <div class="news-featured-content">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut ante a urna interdum auctor. Duis imperdiet gravida risus, sit amet placerat nisi vehicula sed. Aliquam erat volutpat.</p>
                    <a href="#" class="read-more-link">Baca selengkapnya →</a>
                </div>
            </div>

            {{-- Berita Kecil (Grid 4 di Kanan/Bawah) --}}
            <div class="news-small-grid">
                @for ($i = 1; $i <= 4; $i++)
                <div class="news-card-sm">
                    <div class="news-sm-img">
                        <img src="{{ asset('images/news-sm-'. $i .'.jpg') }}" alt="News">
                    </div>
                    <div class="news-sm-body">
                        <h4>Lorem ipsum</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <a href="#" class="read-more-sm">Baca selengkapnya</a>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- GALERI KAMI SECTION --}}
    <section class="home-gallery-section">
        <div class="section-header text-center">
            <h2>GALERI KAMI</h2>
            <div class="divider-line"></div>
        </div>

        <div class="gallery-grid-6">
            @for ($i = 1; $i <= 6; $i++)
            <div class="gallery-item">
                <img src="{{ asset('images/gallery-'. $i .'.jpg') }}" alt="Gallery Tasty Food">
                <div class="gallery-overlay">
                    <span><i class="fas fa-search"></i> Lihat</span>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-40">
            <a href="#" class="btn-dark-custom">LIHAT LEBIH BANYAK</a>
        </div>
    </section>

</main>
@endsection