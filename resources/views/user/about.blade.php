@extends('layouts.app')

@section('title', 'Tentang Kami - Tasty Food')
@section('header_class', 'absolute inset-x-0 top-0 bg-transparent text-white')

@section('content')
@php
    // Ganti dengan file di public/images
    $img = fn ($n) => asset("images/about-{$n}.jpg");
@endphp

<x-page-hero title="Tentang Kami" />

{{-- ============ PROFIL ============ --}}
<section class="bg-[#f4f4f4] px-6 py-20 lg:py-32">
    <div class="mx-auto grid w-full max-w-6xl items-center gap-12 lg:grid-cols-2 lg:gap-10">
        <div>
            <h2 class="font-['Montserrat',sans-serif] text-3xl font-bold uppercase">Tasty Food</h2>
            <p class="mt-8 text-sm font-semibold leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
            </p>
            <p class="mt-6 text-sm leading-relaxed text-neutral-700">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <img src="{{ $img(1) }}" alt="Hidangan Tasty Food" class="aspect-[2/3] w-full rounded-2xl object-cover shadow-[0_4px_16px_rgba(0,0,0,0.15)]">
            <img src="{{ $img(2) }}" alt="Koki Tasty Food sedang bekerja" class="aspect-[2/3] w-full rounded-2xl object-cover shadow-[0_4px_16px_rgba(0,0,0,0.15)]">
        </div>
    </div>
</section>

{{-- ============ VISI & MISI ============ --}}
<section class="bg-white px-6 py-20 lg:py-28">
    <div class="mx-auto w-full max-w-6xl space-y-20 lg:space-y-28">

        {{-- Visi --}}
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-10">
            <div class="grid grid-cols-2 gap-3">
                <img src="{{ $img(3) }}" alt="Aneka masakan" class="aspect-square w-full rounded-2xl object-cover shadow-[0_4px_16px_rgba(0,0,0,0.15)]">
                <img src="{{ $img(4) }}" alt="Semangkuk mi dengan telur" class="aspect-square w-full rounded-2xl object-cover shadow-[0_4px_16px_rgba(0,0,0,0.15)]">
            </div>
            <div class="lg:pl-6">
                <h2 class="font-['Montserrat',sans-serif] text-2xl font-bold uppercase">Visi</h2>
                <p class="mt-8 text-sm leading-relaxed text-neutral-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec ex at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat vel leo rutrum lobortis.
                </p>
            </div>
        </div>

        {{-- Misi --}}
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-10">
            <div class="lg:pr-6">
                <h2 class="font-['Montserrat',sans-serif] text-2xl font-bold uppercase">Misi</h2>
                <p class="mt-8 text-sm leading-relaxed text-neutral-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec ex at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat vel leo rutrum lobortis.
                </p>
            </div>
            <img src="{{ $img(5) }}" alt="Bahan makanan segar" class="aspect-[2/1] w-full rounded-2xl object-cover shadow-[0_4px_16px_rgba(0,0,0,0.15)]">
        </div>
    </div>
</section>
@endsection