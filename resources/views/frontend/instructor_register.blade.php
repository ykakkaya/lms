@extends('frontend.layout.master')
@section('frontend_content')
@include('frontend.partial.login_breadcrumb');
@include('frontend.partial.index_feature');
@include('frontend.partial.index_funfact');

<!--======================================
        START REGISTER AREA
======================================-->
<section class="register-area section--padding dot-bg overflow-hidden">
    <div class="container">
        <div class="register-heading-content-wrap text-center">
            <div class="section-heading">
                <h2 class="section__title">Eğitmen Olmak İçin Formu Doldurunuz</h2>
            </div><!-- end section-heading -->
        </div>
        <div class="row pt-50px">
            <div class="col-lg-10 mx-auto">
                <div class="card card-item">
                    <div class="card-body">
                        <form method="post" action="{{route('frontend.instructor.store')}}" class="row">
                            @csrf
                            <div class="input-box col-lg-6">
                                <label class="label-text">Kullanıcı Adı</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('name') is-invalid @enderror" type="text" name="name" placeholder="e.g. Smith">
                                    <span class="la la-user input-icon"></span>
                                </div>
                                @error('name')
                                <span class="text-danger">
                                   {{ $message }}
                                </span>
                                @enderror
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email </label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('email') is-invalid @enderror" type="email" name="email" placeholder="e.g. alexsmith@gmail.com">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            @error('email')
                            <span class="text-danger">
                               {{ $message }}
                            </span>
                            @enderror

                            <div class="input-box col-lg-12">
                                <label class="label-text">Telefon Numarası</label>
                                <div class="form-group">
                                    <input id="phone" class="form-control form--control @error('phone') is-invalid @enderror " type="text" name="phone">
                                    <span class="la la-phone input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            @error('phone')
                            <span class="text-danger">
                               {{ $message }}
                            </span>
                            @enderror

                            <div class="input-box col-lg-6">
                                <label class="label-text">Yaşadığınız Şehir</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('address') is-invalid @enderror" type="text" name="address" placeholder="Şehir">
                                    <span class="la la-map input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            @error('address')
                            <span class="text-danger">
                               {{ $message }}
                            </span>
                            @enderror

                            <div class="input-box col-lg-6">
                                <label class="label-text">Parola</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('password') is-invalid @enderror" type="password" name="password" placeholder="password">
                                    <span class="la la-key input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            @error('password')
                            <span class="text-danger">
                               {{ $message }}
                            </span>
                            @enderror

                            <div class="btn-box col-lg-12">
                                <div class="custom-control custom-checkbox mb-4 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required>
                                    <label class="custom-control-label custom--control-label" for="agreeCheckbox">by signing i agree to the
                                        <a href="terms-and-conditions.html" class="text-color hover-underline">terms and conditions</a> and
                                        <a href="privacy-policy.html" class="text-color hover-underline">privacy policy</a>
                                    </label>
                                </div><!-- end custom-control -->
                                <button class="btn theme-btn" type="submit">Eğitmen Ol <i class="la la-arrow-right icon ml-1"></i></button>
                            </div><!-- end btn-box -->
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end register-area -->
<!--======================================
        END REGISTER AREA
======================================-->

@endsection
