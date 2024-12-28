@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <h3 class="font-bold text-2xl text-center md:text-start mb-3 text-[--primary-container]">Daftar Hotel</h3>
            <hr>
        </section>
        @livewire('admin-hotel')
    </div>
@endsection

@push('customjs')
    @session('title')
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    text: 'text-semibold text-[--on-primary]',
                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                },
            })
        </script>
    @endsession
@endpush
