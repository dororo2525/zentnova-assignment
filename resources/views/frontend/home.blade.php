@extends('layouts.home')

@section('css')

@endsection

@section('content')
<!-- ============================ Hero Banner  Start================================== -->
<div class="image-cover hero-banner" style="background:#eff6ff no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11 col-sm-12">
                <div class="inner-banner-text text-center">
                    {{-- <p class="lead-i">Amet consectetur adipisicing <span class="badge badge-success">New</span></p> --}}
                    <h2><span class="font-normal">CREATE YOUR</span> "SHORTEN LINK"</h2>
                </div>
                <div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard mt-5">
                    <div class="hero-search-content">
                        <div class="row">
                            <form action="{{ route('trial-url') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-10 px-xl-2 px-lg-2 px-md-2 elio">
                                        <div class="form-group borders">
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" name="url" placeholder="Enter link here...">
                                                {{-- <img src="assets/img/pin.svg" width="20"></i> --}}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-3 col-sm-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm search-btn">CREATE</button>
                                        </div>
                                    </div>
                                </div>
                            </form>       
                        </div>
                        @if(session('success'))
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <div class="alert alert-success alert-dismissible fade show">SHORTEN URL : <b>{{ session('success') }}</b> is expired in 12 hours</div>
                            </div>
                        </div>
                        @elseif($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach                                   
                            <script>
                                // Automatically close the alert after 3 seconds
                                setTimeout(function() {
                                    $(".alert").alert('close');
                                }, 5000);
                            </script>
                @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- ============================ Hero Banner End ================================== -->

<!-- ============================ Price Table Start ================================== -->
<section>
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 text-center">
                <div class="sec-heading center">
                    <h2>See our packages</h2>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
                </div>
            </div>
        </div>
        
        <div class="row">
        
            <!-- Single Package -->
            <div class="col-lg-4 col-md-4">
                <div class="pricing-wrap basic-pr">
                    
                    <div class="pricing-header">
                        <h4 class="pr-value"><sup>฿</sup>0</h4>
                        <h4 class="pr-title">Free Package</h4>
                    </div>
                    <div class="pricing-body">
                        <ul>
                            <li class="available">3 Links</li>
                            <li class="available">Contact With Agent</li>
                            <li>3 Month Validity</li>
                            <li>7x24 Fully Support</li>
                        </ul>
                    </div>
                    <div class="pricing-bottom">
                        <a href="{{ route('register' , ['package' => 1]) }}" class="btn-pricing">Choose Plan</a>
                    </div>
                    
                </div>
            </div>
            
            <!-- Single Package -->
            <div class="col-lg-4 col-md-4">
                <div class="pricing-wrap platinum-pr">
                    
                    <div class="pricing-header">
                        <h4 class="pr-value"><sup>฿</sup>300</h4>
                        <h4 class="pr-title">Basic Package</h4>
                    </div>
                    <div class="pricing-body">
                        <ul>
                            <li class="available">20 Links</li>
                            <li class="available">Contact With Agent</li>
                            <li class="available">3 Month Validity</li>
                            <li>7x24 Fully Support</li>
                        </ul>
                    </div>
                    <div class="pricing-bottom">
                        <a href="{{ route('register' , ['package' => 2]) }}" class="btn-pricing">Choose Plan</a>
                    </div>
                    
                </div>
            </div>
            
            <!-- Single Package -->
            <div class="col-lg-4 col-md-4">
                <div class="pricing-wrap standard-pr">
                    
                    <div class="pricing-header">
                        <h4 class="pr-value"><sup>฿</sup>1,000</h4>
                        <h4 class="pr-title">Premium Package</h4>
                    </div>
                    <div class="pricing-body">
                        <ul>
                            <li class="available">Unlimited</li>
                            <li class="available">Contact With Agent</li>
                            <li class="available">3 Month Validity</li>
                            <li class="available">7x24 Fully Support</li>
                        </ul>
                    </div>
                    <div class="pricing-bottom">
                        <a href="{{ route('register' , ['package' => 3]) }}" class="btn-pricing">Choose Plan</a>
                    </div>
                    
                </div>
            </div>
            
        </div>
        
    </div>	
</section>
<!-- ============================ Price Table End ================================== -->

<!-- ============================ Smart Testimonials ================================== -->
<section class="bg-orange">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 text-center">
                <div class="sec-heading center">
                    <h2>Good Reviews by Customers</h2>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            
            <div class="col-lg-12 col-md-12">
                
                <div class="smart-textimonials smart-center" id="smart-textimonials">
                    
                    <!-- Single Item -->
                    <div class="item">
                        <div class="item-box">
                            <div class="smart-tes-author">
                                <div class="st-author-box">
                                    <div class="st-author-thumb">
                                        <div class="quotes bg-blue"><i class="ti-quote-right"></i></div>
                                        <img src="https://placehold.co/600x550?text=AW" class="img-fluid" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="smart-tes-content">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</p>
                            </div>
                            
                            <div class="st-author-info">
                                <h4 class="st-author-title">Adam Williams</h4>
                                <span class="st-author-subtitle">CEO Of Microwoft</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Item -->
                    <div class="item">
                        <div class="item-box">
                            <div class="smart-tes-author">
                                <div class="st-author-box">
                                    <div class="st-author-thumb">
                                        <div class="quotes bg-inverse"><i class="ti-quote-right"></i></div>
                                        <img src="https://placehold.co/600x550?text=RD" class="img-fluid" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="smart-tes-content">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</p>
                            </div>
                            
                            <div class="st-author-info">
                                <h4 class="st-author-title">Retha Deowalim</h4>
                                <span class="st-author-subtitle">CEO Of Apple</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Item -->
                    <div class="item">
                        <div class="item-box">
                            <div class="smart-tes-author">
                                <div class="st-author-box">
                                    <div class="st-author-thumb">
                                        <div class="quotes bg-purple"><i class="ti-quote-right"></i></div>
                                        <img src="https://placehold.co/600x550?text=SW" class="img-fluid" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="smart-tes-content">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</p>
                            </div>
                            
                            <div class="st-author-info">
                                <h4 class="st-author-title">Sam J. Wasim</h4>
                                <span class="st-author-subtitle">Pio Founder</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Item -->
                    <div class="item">
                        <div class="item-box">
                            <div class="smart-tes-author">
                                <div class="st-author-box">
                                    <div class="st-author-thumb">
                                        <div class="quotes bg-primary"><i class="ti-quote-right"></i></div>
                                        <img src="https://placehold.co/600x550?text=UG" class="img-fluid" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="smart-tes-content">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</p>
                            </div>
                            
                            <div class="st-author-info">
                                <h4 class="st-author-title">Usan Gulwarm</h4>
                                <span class="st-author-subtitle">CEO Of Facewarm</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Item -->
                    <div class="item">
                        <div class="item-box">
                            <div class="smart-tes-author">
                                <div class="st-author-box">
                                    <div class="st-author-thumb">
                                        <div class="quotes bg-success"><i class="ti-quote-right"></i></div>
                                        <img src="https://placehold.co/600x550?text=SS" class="img-fluid" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="smart-tes-content">
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.</p>
                            </div>
                            
                            <div class="st-author-info">
                                <h4 class="st-author-title">Shilpa Shethy</h4>
                                <span class="st-author-subtitle">CEO Of Zapple</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- ============================ Smart Testimonials End ================================== -->

<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call-to-act-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="call-to-act">
                    <div class="call-to-act-head">
                        <h3>Want to Become a Real Estate Agent?</h3>
                        <span>We'll help you to grow your career and growth.</span>
                    </div>
                    <a href="#" class="btn btn-call-to-act">SignUp Today</a>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Call To Action End ================================== -->
@endsection

@section('js')

@endsection