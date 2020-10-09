<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="banner_slider owl-carousel">

                    <div class="single_banner_slider">
                        <div class="row">
                            <div class="col-lg-5 col-md-8">
                                <div class="banner_text">
                                    <div class="banner_text_iner">
                                        <h1>Sit and order with us</h1>
                                        <p>Buying has never been so simple</p>
                                        <!--<a href="" class="btn_2">buy now</a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="banner_img d-none d-lg-block">
                                <img src="{{Host}}public/img/banner_img.png" alt="">
                            </div>
                        </div>
                    </div>


                </div>
                <!--<div class="slider-counter"></div>-->
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->

<!-- feature_part start-->
<section class="feature_part padding_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section_tittle text-center">
                    <h2>Featured Category</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">


            {{CategoriesToShow}}

            <!--<div class="col-lg-7 col-sm-6">
                <div class="single_feature_post_text">
                    <p>Premium Quality</p>
                    <h3>Latest foam Sofa</h3>
                    <a href="#" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>
                    <img src="{{Host}}public/img/feature/feature_1.png" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-sm-6">
                <div class="single_feature_post_text">
                    <p>Premium Quality</p>
                    <h3>Latest foam Sofa</h3>
                    <a href="#" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>
                    <img src="{{Host}}public/img/feature/feature_2.png" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-sm-6">
                <div class="single_feature_post_text">
                    <p>Premium Quality</p>
                    <h3>Latest foam Sofa</h3>
                    <a href="#" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>
                    <img src="{{Host}}public/img/feature/feature_3.png" alt="">
                </div>
            </div>


            <div class="col-lg-7 col-sm-6">
                <div class="single_feature_post_text">
                    <p>Premium Quality</p>
                    <h3>Latest foam Sofa</h3>
                    <a href="#" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>
                    <img src="{{Host}}public/img/feature/feature_4.png" alt="">
                </div>
            </div>-->


        </div>
    </div>
</section>
<!-- upcoming_event part start-->

<!-- product_list start-->
<section class="product_list section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>awesome <span>shop</span></h2>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-12">
                <div class="product_list_slider owl-carousel">

                    {{AwesomeContainer}}

                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_list part start-->

<!-- awesome_shop start-->
<section class="our_offer section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            {{MostSeller}}
            <div class="col-lg-6 col-md-6">
                <div class="offer_text">
                    <h2>The most seller item</h2>
                    <!--<div class="date_countdown">
                        <div id="timer">
                            <div id="days" class="date"></div>
                            <div id="hours" class="date"></div>
                            <div id="minutes" class="date"></div>
                            <div id="seconds" class="date"></div>
                        </div>
                    </div>-->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="enter email address"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <a href="#" class="input-group-text btn_2" id="basic-addon2">Get Info</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- awesome_shop part start-->

<!-- product_list part start-->
<section class="product_list best_seller section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Best Sellers <span>shop</span></h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-12">
                <div class="best_product_slider owl-carousel">


                    {{BessSeller}}


                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_list part end-->
