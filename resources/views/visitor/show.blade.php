@extends('layouts.app2')

@section('contentvisitor')
    <section class="section">
        <div class="section-header">
            <h1>Hallo Selamat Datang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Top Navigation</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Profil Komoditas</h2>
            <div class="row">
                @foreach ($artikel as $art)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <article class="article article-style-c">
                            <a href="{{ route('visitor.detail', $art->slug) }}">
                                <div class="article-header">
                                    <img class="article-image" src="{{ Storage::url($art->path) }}">
                                </div>
                                <div class="article-details">
                                    <div class="article-title" style="width: 100%;">
                                        <div class="article-title-col">
                                            <h6>{{ $art->judul }}</h6>
                                        </div>
                                    </div>
                                    <div class="article-user">
                                        <img alt="image" src="../assets/img/avatar/avatar-1.png">
                                        <div class="article-user-details">
                                            <div class="user-detail-name">
                                                <a href="#">{{ $art->name }}</a>
                                            </div>
                                            <div class="text-job">{{$art->updated_at }}</div>
                                        </div>
                                        <div class="article-cta">
                                            <div class="article-cta">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="col-lg pagination pagination-center justify-content-center">
                {{ $artikel->appends(Request::all())->links() }}
            </div>
        </section>
        @endsection
