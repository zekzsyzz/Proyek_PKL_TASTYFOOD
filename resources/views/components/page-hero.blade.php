
@props(['title'])

<section class="relative flex min-h-[20rem] items-end overflow-hidden bg-[#10161d] bg-cover bg-center lg:min-h-[33rem]"
         style="background-image: url('{{ asset('asset/Group 70@2x.png') }}');">
    <div class="absolute inset-0 bg-black/45" aria-hidden="true"></div>

    <div class="relative mx-auto w-full max-w-6xl px-6 pb-14 lg:pb-52">
        <h1 class="font-['Montserrat',sans-serif] text-4xl font-extrabold uppercase leading-tight text-white lg:text-5xl">
            {{ $title }}
        </h1>
    </div>
</section>