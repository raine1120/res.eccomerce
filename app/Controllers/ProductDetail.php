<?php

namespace App\Controllers;

use Core\Controller;


class ProductDetail extends Controller
{

    function __construct()
    {

        parent::__construct();

    }

    public function Main($params = array())
    {

        $idProduct        = (isset($params[3])) ? $params[3] : "" ;
        $generalFunctions = new Index();

        $this->view->setValues(array(
            0 => '{{Host}}',
            1 => '{{Container}}',
            2 => '{{Picture}}',
            3 => '{{ItemFullDes}}',
            4 => '{{BessSeller}}',
            6 => '{{HearderMenu}}'
        ), array(
            0 => HOST,
            1 => $this->getItemInformation($idProduct)['item'],
            2 => $this->getItemInformation($idProduct)['picture'],
            3 => $this->getItemInformation($idProduct)['description'],
            4 => $generalFunctions->getBestSell(),
            6 => $generalFunctions->getHeaderMenu()

        ));

        return $this->view->setView(
            array(
                'Product/View.Header',
                'Product/View.Body',
                'Product/View.Footer'
            )
        );


    }

    function charLimiter($str, $n = 500, $end_char = '&#8230;')
    {
        if (strlen($str) < $n)
        {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
        {
            return $str;
        }

        $out = "";
        foreach (explode(' ', trim($str)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $n)
            {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
            }
        }
    }


    public function getItemInformation($idRecord){

        $generalFunction = new Index();
        $params = array(
            "filterByFormula" => "AND( {RecordID} = '$idRecord' )",
            //"sort" => array(array('field' => 'Total Units Sold', 'direction' => "desc")),
            "maxRecords" => 1
        );
        $data  = $generalFunction->getAirData('Furniture',$params);


        $pictureContainer ="";
        $itemContainer = "";
        $itemFullDescription ="";
        foreach ($data as $key => $value){
            $itemPicture                 = $value->fields->Picture;
            $itemName                    = $value->fields->Name;
            $itemDescription             = $value->fields->Description;
            $itemQuantity                = $value->fields->{'Units In Store'};
            $itemType                    = $value->fields->Type;
            $unitCost       = $value->fields->{'Unit Cost'};


            foreach ($itemPicture as $k => $v){
                $pictureContainer.="<div data-thumb=\"$v->url\">
                                        <img src=\"$v->url\" />
                                    </div>";
            }


            $itemContainer.="<div class=\"s_product_text\">
                                        <h3>$itemName</h3>
                                        <h2>$$unitCost</h2>
                                        <ul class=\"list\">
                                            <li>
                                                <a class=\"active\" href=\"#\">
                                                <span>Category</span> : $itemType</a>
                                            </li>
                                            <li>
                                                <a href=\"#\"> <span>Availibility</span> : $itemQuantity  In Stock</a>
                                            </li>
                                        </ul>
                                        <p>
                                            ".$this->charLimiter($itemDescription)."
                                        </p>
                                        <div class=\"card_area d-flex justify-content-between align-items-center\">
                                            <div class=\"product_count\">
                                                <span class=\"inumber-decrement\"> <i class=\"ti-minus\"></i></span>
                                                <input class=\"input-number\" type=\"text\" value=\"1\" min=\"0\" max=\"10\">
                                                <span class=\"number-increment\"> <i class=\"ti-plus\"></i></span>
                                            </div>
                                            <a href=\"#\" class=\"btn_3\">add to cart</a>
                                            <a href=\"#\" class=\"like_us\"> <i class=\"ti-heart\"></i> </a>
                                        </div>
                                        <div class=\"card_area d-flex justify-content-between align-items-center\">    
                                          <form id='formInfo' action='".HOST."ProductDetail/sendInfo' class=\"row\">                      
                                                <div class=\"col-md-12\">
                                                    <div class=\"form-group\">
                                                        <input type=\"email\" id='emailInfo' class=\"form-control\" name=\"email\" placeholder=\"Email Address\" required=\"required\">
                                                    </div>
                                                </div>
                                                <div class=\"col-md-12 text-right\">
                                                    <button type=\"submit\" value=\"submit\" class=\"btn_3\">
                                                        get information
                                                    </button>
                                                </div>
                                          </form>           
                                        </div>
                                    </div>";

            $itemFullDescription .= $itemDescription;

        }

        $productArray = array('picture'     => $pictureContainer,
                              'item'        => $itemContainer,
                              'description' => $itemFullDescription);

        return $productArray;
    }

    public function sendInfo(){

        $generalFunction = new Index();
        $requestorEmail      = $_POST['email'];
        $fullProductInfoURL  = 'http://localhost/E-commerce/ProductInformation/'.$_POST['itemID'];

        $result = $generalFunction->sendMail($requestorEmail,$fullProductInfoURL);
        return $result;
    }

}


