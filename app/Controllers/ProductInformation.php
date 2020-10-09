<?php

namespace App\Controllers;

use Core\Controller;


class ProductInformation extends Controller
{

    function __construct()
    {

        parent::__construct();

    }

    public function Main($params = array())
    {

        $idProduct        = (isset($params[3])) ? $params[3] : "" ;

        $this->view->setValues(array(
            0 => '{{Host}}',
            1 => '{{FirstPicture}}',
            2 => '{{Description}}',
            3 => '{{Multi}}',
            4 => '{{ProductInformation}}'
        ), array(
            0 => HOST,
            1 => $this->getFullItemInformation($idProduct)['picture'][0],
            2 => nl2br($this->getFullItemInformation($idProduct)['description']),
            3 => $this->getFullItemInformation($idProduct)['Multi Pic'],
            4 => $this->getFullItemInformation($idProduct)['Product Information']
        ));

        return $this->view->setView(
            array(
                'Mail/View.Body'
            )
        );


    }


    public function getFullItemInformation($idRecord){

        $generalFunction = new Index();
        $params = array(
            "filterByFormula" => "AND( {RecordID} = '$idRecord' )",
            //"sort" => array(array('field' => 'Total Units Sold', 'direction' => "desc")),
            "maxRecords" => 1
        );
        $data  = $generalFunction->getAirData('Furniture',$params);


        $pictureContainer = array();
        $itemContainer    = "";
        $itemFullDescription ="";
        foreach ($data as $key => $value){
            $itemPicture                 = $value->fields->Picture;
            $itemName                    = $value->fields->Name;
            $itemDescription             = $value->fields->Description;
            $itemQuantity                = $value->fields->{'Units In Store'};
            $itemType                    = $value->fields->Type;
            $unitCost                    = $value->fields->{'Unit Cost'};

            $itemMaterial                = $value->fields->{'Materials and Finishes'};
            $itemSetting                 = $value->fields->{'Settings'};
            $itemSize                    = $value->fields->{'Size (WxLxH)'};

            $productInformation = array();

            $productInformation['Material'] = implode(', ',$itemMaterial);
            $productInformation['Setting']  = implode(', ',$itemSetting);
            $productInformation['Size']     = $itemSize;


            $countPic = 0;
            foreach ($itemPicture as $k => $v){
                $pictureContainer[$countPic] = $v->url;
                $countPic++;
            }

            $countPic = 0;
            $pictureMailContent = "";
            if (count($itemPicture) > 1){
                foreach ($itemPicture as $k => $v) {
                    $countPic++;
                    $pictureMailContent .= "<!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-color:#f9c1aa;\"><tr><td align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:640px\"><tr class=\"layout-full-width\" style=\"background-color:transparent\"><![endif]-->
                                            <!--[if (mso)|(IE)]><td align=\"center\" width=\"213\" style=\"background-color:transparent;width:213px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;\"><![endif]-->
                                            <div class=\"col num4\" style=\"display: table-cell; vertical-align: top; max-width: 320px; min-width: 212px; width: 213px;\">
                                                <div style=\"width:100% !important;\">
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                    <div style=\"border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;\">
                                                        <!--<![endif]-->
                                                        <div align=\"center\" class=\"img-container center autowidth\" style=\"padding-right: 0px;padding-left: 0px;\">
                                                            <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr style=\"line-height:0px\"><td style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\"><![endif]-->
                                                            <img align=\"center\" alt=\"Soap Product Image\" border=\"0\" class=\"center autowidth\" src=\"$v->url\" style=\"text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 162px; display: block;  mix-blend-mode: multiply;\" title=\"Soap Product Image\" width=\"162\"/>
                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                        </div>
                                                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"divider\" role=\"presentation\" style=\"table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\" valign=\"top\" width=\"100%\">
                                                            <tbody>
                                                            <tr style=\"vertical-align: top;\" valign=\"top\">
                                                                <td class=\"divider_inner\" style=\"word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;\" valign=\"top\">
                                                                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"divider_content\" height=\"20\" role=\"presentation\" style=\"table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid transparent; height: 20px; width: 100%;\" valign=\"top\" width=\"100%\">
                                                                        <tbody>
                                                                        <tr style=\"vertical-align: top;\" valign=\"top\">
                                                                            <td height=\"20\" style=\"word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\" valign=\"top\"><span></span></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px; font-family: Georgia, 'Times New Roman', serif\"><![endif]-->
                                                        <div style=\"color:#393d47;font-family:Georgia, Times, 'Times New Roman', serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;\">
                                                            <div style=\"line-height: 1.2; font-size: 12px; font-family: Georgia, Times, 'Times New Roman', serif; color: #393d47; mso-line-height-alt: 14px;\">
                                                                <p style=\"font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; font-family: Georgia, Times, 'Times New Roman', serif; mso-line-height-alt: 17px; margin: 0;\"><span style=\"color: #2e553a;\"><span style=\"font-size: 20px;\">
                                                                <strong></strong></span></span></p>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <!--<![endif]-->
                                                </div>
                                            </div>";
                    if ($countPic == 3){break;}
                }
            }
            $productInformationText="";
            foreach ($productInformation as $key => $value){


                $productInformationText .= " <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Georgia, 'Times New Roman', serif\"><![endif]-->
                                    <div style=\"color:#393d47;font-family:Georgia, Times, 'Times New Roman', serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;\">
                                        <div style=\"line-height: 1.2; font-size: 12px; font-family: Georgia, Times, 'Times New Roman', serif; color: #393d47; mso-line-height-alt: 14px;\">
                                            <p style=\"font-size: 20px; line-height: 1.2; word-break: break-word; text-align: center; font-family: Georgia, Times, 'Times New Roman', serif; mso-line-height-alt: 24px; margin: 0;\"><span style=\"font-size: 20px;\"><span style=\"color: #2e553a;\"><strong>$key</strong></span></span></p>
                                        </div>
                                    </div>
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 5px; padding-left: 5px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif\"><![endif]-->
                                    <div style=\"color:#393d47;font-family:Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif;line-height:1.2;padding-top:10px;padding-right:5px;padding-bottom:10px;padding-left:5px;\">
                                        <div style=\"line-height: 1.2; font-size: 12px; color: #393d47; font-family: Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif; mso-line-height-alt: 14px;\">
                                            <p style=\"font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;\"><span style=\"color: #2e553a; font-size: 14px;\"><span style=\"\">$value</span></span></p>
                                        </div>
                                    </div>

                                    
                                    <!--[if mso]></td></tr></table><![endif]-->
                                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"divider\" role=\"presentation\" style=\"table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\" valign=\"top\" width=\"100%\">
                                        <tbody>
                                        <tr style=\"vertical-align: top;\" valign=\"top\">
                                            <td class=\"divider_inner\" style=\"word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;\" valign=\"top\">
                                                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"divider_content\" height=\"10\" role=\"presentation\" style=\"table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid transparent; height: 10px; width: 100%;\" valign=\"top\" width=\"100%\">
                                                    <tbody>
                                                    <tr style=\"vertical-align: top;\" valign=\"top\">
                                                        <td height=\"10\" style=\"word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;\" valign=\"top\"><span></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>";
            }






            $productArray = array(  'picture'     => $pictureContainer,
                                    'item'        => $itemContainer,
                                    'description' => $itemName." - ".$itemDescription,
                                    'Multi Pic'   => $pictureMailContent,
                                    'Product Information' => $productInformationText);

            //die(var_dump($value));
            return $productArray;




        }


    }



}


