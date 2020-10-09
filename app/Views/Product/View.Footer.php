<!--::footer_part start::-->
<footer class="footer_part">
    <div class="copyright_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright_text">
                        <P>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </P>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer_icon social_icon">
                        <ul class="list-unstyled">
                            <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--::footer_part end::-->

<!-- jquery plugins here-->
<script src="{{Host}}public/js/jquery-3.5.1.min.js"></script>
<!-- bootstrap js -->
<script src="{{Host}}public/js/bootstrap.min.js"></script>
<!-- easing js -->
<script src="{{Host}}public/js/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="{{Host}}public/js/lightslider.min.js"></script>
<!-- swiper js -->
<script src="{{Host}}public/js/masonry.pkgd.js"></script>
<!-- particles js -->
<script src="{{Host}}public/js/owl.carousel.min.js"></script>
<script src="{{Host}}public/js/jquery.nice-select.min.js"></script>
<!-- slick js -->
<script src="{{Host}}public/js/slick.min.js"></script>
<script src="{{Host}}public/js/swiper.jquery.js"></script>
<script src="{{Host}}public/js/jquery.counterup.min.js"></script>
<script src="{{Host}}public/js/jquery.waypoints.min.js"></script>
<script src="{{Host}}public/js/jquery.ajaxchimp.min.js"></script>
<script src="{{Host}}public/js/jquery.form.js"></script>

<script src="{{Host}}public/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{Host}}public/js/waitMe.min.js"></script>
<script>



    $(function (){

        $("#formInfo").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            let form = $(this);
            let url = form.attr('action');

            let pathArray = window.location.pathname.split('/');

            let itemID = pathArray[3];
            let email = $("#emailInfo").val();


            $.ajax({
                type: "POST",
                url: url,
                data: {email : email , itemID : itemID }, // serializes the form's elements.
                beforeSend: function () {
                    runWaitMe('roundBounce');

                },
                success: function(data)
                {
                    if(data == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'The requested information has been send',
                            showConfirmButton: true,
                            timer: 1500
                        });
                        console.log('Se envio');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            showConfirmButton: true,
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>'
                        })
                    }
                },
                error: function (data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        showConfirmButton: true,
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    });
                },
                complete : function (data){
                    $('#wrapperDiv').waitMe('hide');
                }
            });


        });



        function runWaitMe(effect){
            $('#wrapperDiv').waitMe({

                //none, rotateplane, stretch, orbit, roundBounce, win8,
                //win8_linear, ios, facebook, rotation, timer, pulse,
                //progressBar, bouncePulse or img
                effect: 'bounce',

                //place text under the effect (string).
                text: '',

                //background for container (string).
                bg: 'rgba(255,255,255,0.7)',

                //color for background animation and text (string).
                color: '#000',

                //max size
                maxSize: '',

                //wait time im ms to close
                waitTime: -1,

                //url to image
                source: '',

                //or 'horizontal'
                textPos: 'vertical',

                //font size
                fontSize: '',

                // callback
                onClose: function() {}

            });
        }
    })
</script>
</div>
</body>

</html>