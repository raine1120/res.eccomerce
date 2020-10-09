<?php 

namespace App\Controllers;

use Core\Controller;
use \TANIOS\Airtable\Airtable;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class Index extends Controller {

	function __construct(){

		parent::__construct();

	}

	public function Main($params = array()){



				$this->view->setValues(array(
					0 => '{{Host}}',
                    1 => '{{AwesomeContainer}}',
                    2 => '{{BessSeller}}',
                    3 => '{{MostSeller}}',
                    //4 => '{{Banner}}',
                    5 => '{{CategoriesToShow}}',
                    6 => '{{HearderMenu}}'
				), array(
					0 => HOST,
                    1 => $this->getAwesomeCarousel(),
                    2 => $this->getBestSell(),
                    3 => $this->getMostSellerItem(),
                    //4 => $this->getBanner(),
                    5 => $this->getCategoriesToShow(),
                    6 => $this->getHeaderMenu()
				));

				return $this->view->setView(	
					array( 
						'View.Header', 
						'View.Body',
						'View.Footer'
					)
				);

	}

	public function getAirData($table,$params = ''){
        $airtable = new Airtable(array(
            'api_key' => 'keyiGO6cOjbvPsTza',
            'base'    => 'appzeUDpZOqRjLPaJ'
        ));

        $request = $airtable->getContent($table,$params);

        $data = array();
        do {
            $response = $request->getResponse();
            array_push($data,$response[ 'records' ]);
        }
        while( $request = $response->next() );
        return $data[0];

    }

    public function saveAirData($table,$params){
        $airtable = new Airtable(array(
            'api_key' => 'keyiGO6cOjbvPsTza',
            'base'    => 'appzeUDpZOqRjLPaJ'
        ));
        $content = $airtable->saveContent($table,$params);
    }


    public function getAwesomeCarousel(){

        $data = $this->getAirData('Furniture');

        $carouselHeader     = "<div class=\"single_product_list_slider\">
                                    <div class=\"row align-items-center justify-content-between\">";

        $carouselContainer  = "";

        $carouselFooter     = "     </div>
                                </div>";

        $carouselLimit  = 8;
        $itemQuantity   = 0;
        foreach ($data as $key => $value){

            $recordID       = $value->fields->RecordID;
            $pictureURL    = $value->fields->Picture[0]->url;
            $itemName       = $value->fields->Name;
            $unitCost       = $value->fields->{'Unit Cost'};
            $carouselContainer .= ($itemQuantity == 0) ? $carouselHeader : "" ;
            $carouselContainer .= "<div class=\"col-lg-3 col-sm-6\">
                                        <div class=\"single_product_item\" >
                                            <img src=\"$pictureURL\" style=\"width: 250px; height: 250px; \" alt=\"\"> 
                                            <div class=\"single_product_text\">
                                                <h4>$itemName</h4>
                                                <h3>$ $unitCost</h3>
                                                <a href=\"".HOST."ProductDetail/$recordID\" class=\"feature_btn\">EXPLORE NOW <i class=\"fas fa-play\"></i></a>
                                            </div>
                                        </div>
                                    </div>";
            $itemQuantity++;
            $carouselContainer .= ($itemQuantity == 8) ? $carouselFooter : "" ;



            if (($itemQuantity/$carouselLimit) >= 1) { $itemQuantity   = 0; }

        }

        return $carouselContainer;

    }


    public function getBestSell(){

        $params = array(
            //"filterByFormula" => "AND( {Total Units Sold} = 37 )",
            "sort" => array(array('field' => 'Total Units Sold', 'direction' => "desc")),
            "maxRecords" => 5
        );

        $data = $this->getAirData('Furniture',$params);

        $bessSellerContainer = "";
        foreach ($data as $key => $value){
            $recordID       = $value->fields->RecordID;
            $pictureURL     = $value->fields->Picture[0]->url;
            $itemName       = $value->fields->Name;
            $unitCost       = $value->fields->{'Unit Cost'};
            $bessSellerContainer .= "  <div class=\"single_product_item\" >
                                            <img src=\"$pictureURL\" style=\"width: 250px; height: 250px; alt=\"\">
                                            <div class=\"single_product_text\">
                                                <h4>$itemName</h4>
                                                <h3>$$unitCost</h3>
                                                <a href=\"".HOST."ProductDetail/$recordID\" class=\"feature_btn\">EXPLORE NOW <i class=\"fas fa-play\"></i></a>
                                            </div>
                                        </div>";
        }

        return $bessSellerContainer;

    }

    public function getMostSellerItem(){

        $params = array(
            //"filterByFormula" => "AND( {Total Units Sold} = 37 )",
            "sort" => array(array('field' => 'Total Units Sold', 'direction' => "desc")),
            "maxRecords" => 1
        );

        $data = $this->getAirData('Furniture',$params);
        $MostSellerItemContainer = "";
        foreach ($data as $key => $value){
            $pictureURL    = $value->fields->Picture[0]->url;
            $MostSellerItemContainer .= "<div class='col-lg-6 col-md-6'>
                                            <div class='offer_img'>
                                                <img src='$pictureURL' style='mix-blend-mode: multiply;'>
                                            </div>
                                        </div>";
        }

        return $MostSellerItemContainer;

    }

    public function getBanner(){
        $data = $this->getAirData('Furniture');
        $bannerContainer = "";

        //SHUFFLE FUNCTION FOR GET A RANDOM BANNER
        shuffle($data);


        foreach ($data as $key => $value){

            if ($key >= 5) { break;}

            $pictureURL             = $value->fields->Picture[0]->url;
            $itemName               = $value->fields->Name;
            $itemDescription        = $value->fields->Description;

            $bannerContainer .= "<div class=\"single_banner_slider\">
                                        <div class=\"row\">
                                            <div class=\"col-lg-5 col-md-8\">
                                                <div class=\"banner_text\">
                                                    <div class=\"banner_text_iner\">
                                                        <h1>$itemName</h1>
                                                        <p>aaaa</p>
                                                        <a href=\"#\" class=\"btn_2\">buy now</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=\"banner_img d-none d-lg-block\">
                                                <img src=\"$pictureURL\" style=\"mix-blend-mode: multiply !important;\">
                                            </div>
                                        </div>
                                    </div>";
        }

       return $bannerContainer;
    }

    public function getCategoriesToShow(){
        $data = $this->getAirData('Furniture');

        $categories = array();
        foreach ($data as $key => $value) {
            array_push($categories,$value->fields->Type);
        }

        shuffle($data);
        $categoriesItem = array();
        $count = 0;
        foreach (array_unique($categories) as $key => $value){

                foreach ($data as $k => $v){
                    if ($v->fields->Type == $value){
                        $categoriesItem[$value] = $v;
                    }
                }
                $count++;
        }

        $categoriesContainer    = "";
        $categoriesLimit        = 4;
        foreach ($categoriesItem as $key => $value){
            if ($key == 'Rugs'){continue;}
            $recordID       = $value->fields->RecordID;
            $itemName               = $value->fields->Name;
            $pictureURL             = $value->fields->Picture[0]->url;
            $categoriesContainer.="<div class=\"col-lg-5 col-sm-6\">
                                        <div class=\"single_feature_post_text\">
                                            <p>$key</p>
                                            <h3>$itemName</h3>
                                            <a href=\"".HOST."ProductDetail/$recordID\" class=\"feature_btn\">EXPLORE NOW <i class=\"fas fa-play\"></i></a>
                                              <img src=\"$pictureURL\" style=\"mix-blend-mode: multiply !important;\" alt=\"\">
                                        </div>
                                    </div>";
            $categoriesLimit-- ;
            if($categoriesLimit == 0){ break; }

        }

        return $categoriesContainer;

    }

    public function getHeaderMenu(){

	    $headerVariation = "";
	    if (isset($_SESSION['userName']) && $_SESSION['userName'] != ''){
            $headerVariation.="<li class=\"nav-item dropdown\">
                                    <a class=\"nav-link dropdown-toggle\" id=\"navbarDropdown_2\"
                                       role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                        Account (".$_SESSION['userName'].")
                                    </a>
                                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown_2\">
                                        <a class=\"dropdown-item\" href=\"".HOST."Index/Logout\"> Logout</a>
                                    </div>
                                </li>";
        }else{
            $headerVariation.="<li class=\"nav-item dropdown\">
                                    <a class=\"nav-link dropdown-toggle\" id=\"navbarDropdown_2\"
                                       role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                        Account 
                                    </a>
                                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown_2\">
                                        <a class=\"dropdown-item\" href=\"".HOST."Login\"> Login</a>
                                        <a class=\"dropdown-item\" href=\"".HOST."Signup\">Sign Up</a>
                                    </div>
                                </li>";
        }

	    return $headerVariation;

    }

    public function Logout(){
	    session_destroy();
	    header('location:'.HOST);
    }

    public function sendMail($recipentEmail,$url){
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->IsSMTP();
        $mail->Mailer     = "smtp";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "testporpuse01@gmail.com";
        $mail->Password   = "Raine1120";
        $mail->IsHTML(true);
        //$mail->headerLine( "MIME-Version: 1.0\r\n");
        //$mail->headerLine("Content-Type: text/html; charset=UTF-8\r\n");
        $mail->SetFrom("testporpuse01@gmail.com", "Resonance E-Commerce");

        $mail->AddAddress("raine1120@gmail.com");
        $mail->AddAddress($recipentEmail);
        $mail->AddAddress('techpirates@resonance.nyc');

        //$mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
        //$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
        $mail->Subject = "Resonance E-Commerce";
        $content = file_get_contents($url);// "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";
        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            return 'fail';
            //echo "Error while sending Email.";
            //var_dump($mail);
        } else {
            //echo "Email sent successfully";
            return 'success';
        }
        return 'success';


    }



}