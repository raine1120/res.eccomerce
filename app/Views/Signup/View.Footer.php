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
<script src="{{Host}}public/js/swiper.min.js"></script>
<!-- swiper js -->
<script src="{{Host}}public/js/masonry.pkgd.js"></script>
<!-- particles js -->
<script src="{{Host}}public/js/owl.carousel.min.js"></script>
<script src="{{Host}}public/js/jquery.nice-select.min.js"></script>
<!-- slick js -->
<script src="{{Host}}public/js/slick.min.js"></script>
<script src="{{Host}}public/js/jquery.counterup.min.js"></script>
<script src="{{Host}}public/js/jquery.waypoints.min.js"></script>
<script src="{{Host}}public/js/contact.js"></script>
<script src="{{Host}}public/js/jquery.ajaxchimp.min.js"></script>
<script src="{{Host}}public/js/jquery.form.js"></script>
<script src="{{Host}}public/js/jquery.validate.min.js"></script>
<script src="{{Host}}public/js/mail-script.js"></script>
<!-- custom js -->
<script src="{{Host}}public/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>



    $(function (){

        $("#formSignup").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            let form = $(this);
            let url = form.attr('action');

            let firstName       = jQuery('input[name="firstName"]').val();
            let lastName    = jQuery('input[name="lastName"]').val();
            let userName       = jQuery('input[name="userName"]').val();
            let email       = jQuery('input[name="email"]').val();
            let password    = jQuery('input[name="password"]').val();

            //console.log(password);
            $.ajax({
                type: "POST",
                url: url,
                data: {
                        firstName   : firstName,
                        lastName    : lastName,
                        userName    : userName,
                        email       : email,
                        password    : password
                       }, // serializes the form's elements.
                success: function(data)
                {
                    console.log(data);
                    if(data == '300'){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            showConfirmButton: true,
                            text: 'The email already exist, Please Log in with it'
                        });
                    }else{

                        Swal.fire({
                            icon: 'success',
                            title: 'The user has been created.',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function(){
                            //Confirmed
                            loginUser(email,password);

                        });

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
                }
            });


        });

        function loginUser(email,password){
            $.ajax({
                type: "POST",
                url: '{{Host}}Login/Signin',
                data: {email : email , password : password}, // serializes the form's elements.
                success: function(data)
                {
                    console.log(data);
                    if(data == 'fail'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            showConfirmButton: true,
                            text: 'Please verify the user and password!'
                        });
                    }else{

                        $(location).attr('href', '{{Host}}');

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
                }
            });
        }


    })
</script>


</body>

</html>