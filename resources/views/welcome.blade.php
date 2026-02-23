@extends('layouts.guest')

@section('content')
<!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="carousel-text">
                            <h1 class="display-1 text-uppercase mb-3">Together for a Better Tomorrow</h1>
                            <p class="fs-5 mb-5">We believe in creating opportunities and empowering communities through
                                education, healthcare, and sustainable development.</p>
                            <div class="d-flex">
                                <a class="btn btn-primary py-3 px-4 me-3" href="#!">Donate Now</a>
                                <a class="btn btn-secondary py-3 px-4" href="#!">Join Us Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="carousel-img">
                            <img class="w-100" src="{{ asset('charitize/img/carousel-1.jpg') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="carousel-text">
                            <h1 class="display-1 text-uppercase mb-3">Together, We Can End Hunger</h1>
                            <p class="fs-5 mb-5">No one should go to bed hungry. Your support helps us bring smiles,
                                hope, and a brighter future to those in need.</p>
                            <div class="d-flex mt-4">
                                <a class="btn btn-primary py-3 px-4 me-3" href="#!">Donate Now</a>
                                <a class="btn btn-secondary py-3 px-4" href="#!">Join Us Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="carousel-img">
                            <img class="w-100" src="{{ asset('charitize/img/carousel-2.jpg') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                    <div class="about-img">
                        <img class="img-fluid w-100" src="{{ asset('charitize/img/about.jpg') }}" alt="Image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="section-title bg-white text-start text-primary pe-3">About Us</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Join Hands, Change the World</h1>
                    <p class="mb-4 wow fadeIn" data-wow-delay="0.3s">Every hand extended in kindness brings us closer to
                        a world free from suffering. Be part of a global movement dedicated to building a future where
                        equality and compassion thrive.</p>
                    <div class="row g-4 pt-2">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="h-100">
                                <h3>Our Mission</h3>
                                <p>Our mission is to uplift underprivileged communities by providing resources,
                                    education, and tools for growth.</p>
                                <p class="text-dark"><i class="fa fa-check text-primary me-2"></i>No one should go to
                                    bed hungry.</p>
                                <p class="text-dark"><i class="fa fa-check text-primary me-2"></i>We spread kindness and
                                    support.</p>
                                <p class="text-dark mb-0"><i class="fa fa-check text-primary me-2"></i>We can change
                                    someone’s life.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100 bg-primary p-4 text-center">
                                <p class="fs-5 text-dark">Through your donations, we spread kindness and support to
                                    children and families.</p>
                                <a class="btn btn-secondary py-2 px-4" href="#!">Donate Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-12 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="service-title">
                        <h1 class="display-6 mb-4">What We Do for Those in Need.</h1>
                        <p class="fs-5 mb-0">We work to bring smiles, hope, and a brighter future to those in need.</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="row g-5">
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4">
                                    <i class="fa fa-droplet fa-2x text-secondary"></i>
                                </div>
                                <h3>Pure Water</h3>
                                <p class="mb-2">We’re creating programs that address urgent needs while fostering
                                    long-term solutions for sustainable change.</p>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4">
                                    <i class="fa fa-hospital fa-2x text-secondary"></i>
                                </div>
                                <h3>Health Care</h3>
                                <p class="mb-2">We’re creating programs that address urgent needs while fostering
                                    long-term solutions for sustainable change.</p>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4">
                                    <i class="fa fa-hands-holding-child fa-2x text-secondary"></i>
                                </div>
                                <h3>Social Care</h3>
                                <p class="mb-2">We’re creating programs that address urgent needs while fostering
                                    long-term solutions for sustainable change.</p>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4">
                                    <i class="fa fa-bowl-food fa-2x text-secondary"></i>
                                </div>
                                <h3>Healthy Food</h3>
                                <p class="mb-2">We’re creating programs that address urgent needs while fostering
                                    long-term solutions for sustainable change.</p>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4">
                                    <i class="fa fa-school-flag fa-2x text-secondary"></i>
                                </div>
                                <h3>Primary Education</h3>
                                <p class="mb-2">We’re creating programs that address urgent needs while fostering
                                    long-term solutions for sustainable change.</p>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4">
                                    <i class="fa fa-home fa-2x text-secondary"></i>
                                </div>
                                <h3>Residence Facilities</h3>
                                <p class="mb-2">We’re creating programs that address urgent needs while fostering
                                    long-term solutions for sustainable change.</p>
                                <a href="#!">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Features Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="rounded overflow-hidden">
                        <div class="row g-0">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="text-center bg-primary py-5 px-4 h-100">
                                    <i class="fa fa-users fa-3x text-secondary mb-3"></i>
                                    <h1 class="display-5 mb-0" data-toggle="counter-up">500</h1>
                                    <span class="text-dark">Team Members</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="text-center bg-secondary py-5 px-4 h-100">
                                    <i class="fa fa-award fa-3x text-primary mb-3"></i>
                                    <h1 class="display-5 text-white mb-0" data-toggle="counter-up">70</h1>
                                    <span class="text-white">Award Winning</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="text-center bg-secondary py-5 px-4 h-100">
                                    <i class="fa fa-list-check fa-3x text-primary mb-3"></i>
                                    <h1 class="display-5 text-white mb-0" data-toggle="counter-up">3000</h1>
                                    <span class="text-white">Total Projects</span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <div class="text-center bg-primary py-5 px-4 h-100">
                                    <i class="fa fa-comments fa-3x text-secondary mb-3"></i>
                                    <h1 class="display-5 mb-0" data-toggle="counter-up">7000</h1>
                                    <span class="text-dark">Client's Review</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="section-title bg-white text-start text-primary pe-3">Why Us!</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Few Reasons Why People Choosing Us!</h1>
                    <p class="mb-4 wow fadeIn" data-wow-delay="0.3s">We believe in creating opportunities and empowering
                        communities through education, healthcare, and sustainable development. Your support helps us
                        bring smiles, hope, and a brighter future to those in need.</p>
                    <p class="text-dark wow fadeIn" data-wow-delay="0.4s"><i
                            class="fa fa-check text-primary me-2"></i>Justo magna erat amet</p>
                    <p class="text-dark wow fadeIn" data-wow-delay="0.5s"><i
                            class="fa fa-check text-primary me-2"></i>Aliqu diam amet diam et eos</p>
                    <p class="text-dark wow fadeIn" data-wow-delay="0.6s"><i
                            class="fa fa-check text-primary me-2"></i>Clita erat ipsum et lorem et sit</p>
                    <div class="d-flex mt-4 wow fadeIn" data-wow-delay="0.7s">
                        <a class="btn btn-primary py-3 px-4 me-3" href="#!">Donate Now</a>
                        <a class="btn btn-secondary py-3 px-4" href="#!">Join Us Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Banner Start -->
    <div class="container-fluid banner py-5">
        <div class="container">
            <div class="banner-inner bg-light p-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="row justify-content-center">
                    <div class="col-lg-8 py-5 text-center">
                        <h1 class="display-6 wow fadeIn" data-wow-delay="0.3s">Our Door Are Always Open to More People
                            Who Want to Support Each Others!</h1>
                        <p class="fs-5 mb-4 wow fadeIn" data-wow-delay="0.5s">Through your donations and volunteer work,
                            we spread kindness and support to children, families, and communities struggling to find
                            stability.</p>
                        <div class="d-flex justify-content-center wow fadeIn" data-wow-delay="0.7s">
                            <a class="btn btn-primary py-3 px-4 me-3" href="#!">Donate Now</a>
                            <a class="btn btn-secondary py-3 px-4" href="#!">Join Us Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Our Team</p>
                <h1 class="display-6 mb-4">Meet Our Dedicated Team Members</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="team-item d-flex h-100 p-4">
                        <div class="team-detail pe-4">
                            <img class="img-fluid mb-4" src="{{ asset('charitize/img/team-1.jpg') }}" alt="">
                            <h3>Boris Johnson</h3>
                            <span>Founder & CEO</span>
                        </div>
                        <div class="team-social bg-light d-flex flex-column justify-content-center flex-shrink-0 p-4">
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-x-twitter"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="team-item d-flex h-100 p-4">
                        <div class="team-detail pe-4">
                            <img class="img-fluid mb-4" src="{{ asset('charitize/img/team-2.jpg') }}" alt="">
                            <h3>Donald Pakura</h3>
                            <span>Project Manager</span>
                        </div>
                        <div class="team-social bg-light d-flex flex-column justify-content-center flex-shrink-0 p-4">
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-x-twitter"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="team-item d-flex h-100 p-4">
                        <div class="team-detail pe-4">
                            <img class="img-fluid mb-4" src="{{ asset('charitize/img/team-3.jpg') }}" alt="">
                            <h3>Alexander Bell</h3>
                            <span>Volunteer</span>
                        </div>
                        <div class="team-social bg-light d-flex flex-column justify-content-center flex-shrink-0 p-4">
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-x-twitter"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square btn-primary my-2" href="#!"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-12 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="testimonial-title">
                        <h1 class="display-6 mb-4">What People Say About Our Activities.</h1>
                        <p class="fs-5 mb-0">We work to bring smiles, hope, and a brighter future to those in need.</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.3s">
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="{{ asset('charitize/img/testimonial-1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <div class="mb-2">
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                        </div>
                                        <p class="fs-5">Education is the foundation of change. By funding schools,
                                            scholarships, and training programs, we can help children and adults unlock
                                            their potential for a better future.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="btn-lg-square bg-light text-secondary flex-shrink-0">
                                                <i class="fa fa-quote-right fa-2x"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h5 class="mb-0">Alexander Bell</h5>
                                                <span>CEO, Founder</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="{{ asset('charitize/img/testimonial-2.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <div class="mb-2">
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                        </div>
                                        <p class="fs-5">Every hand extended in kindness brings us closer to a world free
                                            from suffering. Be part of a global movement dedicated to building a future
                                            where equality and compassion thrive.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="btn-lg-square bg-light text-secondary flex-shrink-0">
                                                <i class="fa fa-quote-right fa-2x"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h5 class="mb-0">Donald Pakura</h5>
                                                <span>CEO, Founder</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="row g-5 align-items-center">
                                <div class="col-md-6">
                                    <div class="testimonial-img">
                                        <img class="img-fluid" src="{{ asset('charitize/img/testimonial-3.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-text pb-5 pb-md-0">
                                        <div class="mb-2">
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                            <i class="fa fa-star text-primary"></i>
                                        </div>
                                        <p class="fs-5">Love and compassion have the power to heal. Through your
                                            donations and volunteer work, we can spread kindness and support to
                                            children, families, and communities struggling to find stability.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="btn-lg-square bg-light text-secondary flex-shrink-0">
                                                <i class="fa fa-quote-right fa-2x"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h5 class="mb-0">Boris Johnson</h5>
                                                <span>CEO, Founder</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Newsletter Start -->
    <div class="container-fluid bg-primary py-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-6 mb-4">Subscribe the Newsletter</h1>
                    <div class="position-relative w-100 mb-2">
                        <input class="form-control border-0 w-100 ps-4 pe-5" type="text" placeholder="Enter Your Email"
                            style="height: 60px;">
                        <button type="button"
                            class="btn btn-lg-square shadow-none position-absolute top-0 end-0 mt-2 me-2"><i
                                class="fa fa-paper-plane text-primary fs-4"></i></button>
                    </div>
                    <p class="mb-0">Don't worry, we won't spam you with emails.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->
@endsection
