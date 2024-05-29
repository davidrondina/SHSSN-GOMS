@php
    $images = ['images/carousel/01.jpg', 'images/carousel/02.jpg', 'images/carousel/03.jpg'];
@endphp

@push('head')
    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

<section class="bg-black/40 text-base-100">
    {{-- <x-container class="mx-auto flex items-center justify-center flex-col">
        <img class="w-40 aspect-square mb-10 object-cover object-center rounded" alt="hero"
            src="{{ asset('images/shssn-logo.png') }}">
        <header class="text-center lg:w-2/3 w-full flex flex-col gap-y-3">
            <h1 class="font-semibold text-lg uppercase">Senior High School in San Nicolas III, City of Bacoor, Cavite
            </h1>
            <p
                class="font-fs mb-8 text-3xl md:text-4xl tracking-wider font-bold leading-tight md:leading-relaxed uppercase">
                Guidance Office
                Management
                System</p>
            <div class="flex justify-center gap-x-8">
                <a href="{{ route('login') }}" class="btn btn-accent uppercase font-semibold font-fs">Login</a>
                <a href="#" class="btn btn-secondary uppercase font-semibold font-fs">Services</a>
            </div>
        </header>
    </x-container> --}}
    <div class="relative">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide relative h-screen w-full">
                        <img src="{{ asset($image) }}" alt="">
                        <div class="absolute top-0 left-0 w-full h-full bg-black/40"></div>
                    </div>
                @endforeach
                {{-- <div class="swiper-slide">Slide 1</div> --}}
            </div>
            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div> --}}
        </div>
        <div
            class="z-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 container flex flex-col items-center">
            <img class="w-40 aspect-square mb-10 object-cover object-center rounded" alt="hero"
                src="{{ asset('images/shssn-logo.png') }}">
            <header class="text-center w-full flex flex-col gap-y-3">
                <h1 class="font-fs font-semibold text-lg uppercase">Senior High School in San Nicholas III, Bacoor City
                </h1>
                <p
                    class="font-fs mb-8 text-3xl md:text-4xl tracking-wider font-bold leading-tight md:leading-relaxed uppercase">
                    Guidance Office
                    Management
                    System</p>
                <div class="flex justify-center gap-x-8">
                    <a href="{{ route('login') }}" class="btn btn-accent uppercase font-semibold font-fs">Login</a>
                    <a href="#" class="btn btn-secondary uppercase font-semibold font-fs">Services</a>
                </div>
            </header>
        </div>
    </div>
</section>

@push('js')
    <script>
        var swiper = new Swiper(".mySwiper", {
            allowTouchMove: false,
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            // navigation: {
            //     nextEl: ".swiper-button-next",
            //     prevEl: ".swiper-button-prev",
            // },
        });
    </script>
@endpush
